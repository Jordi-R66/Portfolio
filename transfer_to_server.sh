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
echo "Contenu du dossier avant décompression :"
ls -l
pwd
tar -xJf portfolio_web.tar.xz site/
mv site/* .
rm -rf site/ *.tar.xz
echo "Déploiement terminé sur le VPS." && exit
REMOTE

echo "4. Nettoyage local..."
# Nettoyage local
rm -f portfolio_web.tar.xz

echo "✅ Script de déploiement terminé."