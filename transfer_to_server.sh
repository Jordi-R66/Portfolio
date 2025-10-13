#!/bin/bash

# Compression
rm portfolio_web.tar.xz
tar -cJf portfolio_web.tar.xz site/

# Transfert sur le VPS
ssh vps_paris 'mkdir -p serv_web_temp/portfolio && rm -rf serv_web_temp/portfolio/*'
scp portfolio_web.tar.xz vps_paris:serv_web_temp/portfolio/

# Décompression
ssh vps_paris <<'REMOTE'
cd serv_web_temp/portfolio/
ls -l
pwd
tar -xJf portfolio_web.tar.xz site/
mv site/* .
rm -rf site/ *.tar.xz