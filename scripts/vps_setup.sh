#!/bin/bash

# ==========================================================================
# setup_vps.sh - NTBK Store Tasikmalaya
# Digunakan untuk instalasi awal server Ubuntu 24.04
# ==========================================================================

# Warna untuk output
GREEN='\033[0;32m'
NC='\033[0m' # No Color

echo -e "${GREEN}>>> 1. Update System...${NC}"
sudo apt update && sudo apt upgrade -y

echo -e "${GREEN}>>> 2. Menambahkan Repository PHP...${NC}"
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

echo -e "${GREEN}>>> 3. Menginstall PHP 8.1 & Ekstensi...${NC}"
sudo apt install -y php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring \
  php8.1-curl php8.1-zip php8.1-gd php8.1-bcmath php8.1-intl php8.1-tokenizer

echo -e "${GREEN}>>> 4. Menginstall Nginx, MySQL & Git...${NC}"
sudo apt install -y nginx mysql-server git unzip

echo -e "${GREEN}>>> 5. Menginstall Composer...${NC}"
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

echo -e "${GREEN}>>> 6. Konfigurasi MySQL Dasar...${NC}"
# Membuat Database dan User
# Catatan: Di Ubuntu 22/24, MySQL root bisa login tanpa password via socket sudo
sudo mysql -e "CREATE DATABASE IF NOT EXISTS pos_ntbk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'ntbk_user'@'localhost' IDENTIFIED BY 'NtbkStore123!';"
sudo mysql -e "GRANT ALL PRIVILEGES ON pos_ntbk.* TO 'ntbk_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

echo -e "${GREEN}====================================================${NC}"
echo -e "${GREEN}SETUP VPS BERHASIL SELESAI!${NC}"
echo -e "${GREEN}Silakan lanjut jalankan vps_deploy.sh${NC}"
echo -e "${GREEN}====================================================${NC}"
