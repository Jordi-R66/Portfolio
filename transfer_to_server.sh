#!/bin/bash

# Compression
rm portfolio_web.tar.xz
tar -cJf portfolio_web.tar.xz site/

# Transfert sur le VPS
ssh vpn_courant 'mkdir -p serv_web_temp/portfolio && rm -rf serv_web_temp/portfolio/*'
scp portfolio_web.tar.xz vpn_courant:serv_web_temp/portfolio/

# Décompression
ssh vpn_courant <<'REMOTE'
cd serv_web_temp/portfolio/
ls -l
pwd
tar -xJf portfolio_web.tar.xz site/
mv site/* .
rm -rf site/ *.tar.xz