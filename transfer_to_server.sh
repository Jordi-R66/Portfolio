#!/bin/bash

# Nom d'interface VPN typique (peut varier, vérifiez la vôtre avec 'ip a')
VPN_INTERFACE="tun0"

# Hôtes pour le transfert
VPS_PARIS="vps_paris"
VPN_COURANT="vpn_courant"

# --- Détection de la connexion VPN ---

# Vérifie si l'interface VPN est active.
# 'ip a show $VPN_INTERFACE' retourne un code de sortie de 0 si l'interface existe et est "UP".
if ip a show $VPN_INTERFACE &> /dev/null; then
    REMOTE_HOST="$VPN_COURANT"
    echo "🟢 VPN détecté : Utilisation de l'hôte $REMOTE_HOST"
else
    REMOTE_HOST="$VPS_PARIS"
    echo "🔴 VPN non détecté : Utilisation de l'hôte $REMOTE_HOST"
fi

# --- Processus de Déploiement ---

echo "1. Compression du site..."
# Compression
rm -f portfolio_web.tar.xz
tar -cJf portfolio_web.tar.xz site/

if [ $? -ne 0 ]; then
    echo "❌ Erreur lors de la compression. Abandon."
    exit 1
fi

echo "2. Préparation et Transfert sur le VPS ($REMOTE_HOST)..."
# Création du dossier temporaire et nettoyage sur le VPS
ssh "$REMOTE_HOST" "mkdir -p serv_web_temp/portfolio && rm -rf serv_web_temp/portfolio/*"

# Transfert sur le VPS
scp portfolio_web.tar.xz "$REMOTE_HOST":serv_web_temp/portfolio/

if [ $? -ne 0 ]; then
    echo "❌ Erreur lors du transfert SCP. Abandon."
    exit 1
fi

echo "3. Décompression et Mise en place à distance..."
# Décompression et nettoyage à distance
ssh "$REMOTE_HOST" <<'REMOTE'
cd serv_web_temp/portfolio/ || exit 1

# On extrait en retirant le premier dossier parent ("site/")
# Cela dépose tout (y compris les fichiers cachés) directement dans le dossier courant
tar -xJf portfolio_web.tar.xz --strip-components=1

# Plus besoin de 'mv' ni de nettoyage complexe
rm -f portfolio_web.tar.xz

# (Optionnel) Vérification que le fichier caché est bien là
if [ -d ".well-known" ]; then
    echo "✅ Dossier .well-known bien extrait."
else
    echo "⚠️ Attention : .well-known absent (vérifiez qu'il existe sur votre PC local)."
fi

echo "Déploiement terminé sur le VPS." && exit
REMOTE

echo "4. Nettoyage local..."
# Nettoyage local
rm -f portfolio_web.tar.xz

echo "✅ Script de déploiement terminé."