#!/bin/bash

# ==========================================================================
# vps_deploy.sh - NTBK Store Tasikmalaya
# Digunakan untuk deploy aplikasi ke direktori /var/www/ntbk-store
# ==========================================================================

# Pastikan script berhenti jika ada error
set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

DOMAIN="pos.ntbkstoretsm.web.id"
REPO_URL="https://github.com/KanaNatsume/poscabangnvt.git"
DEST_DIR="/var/www/ntbk-store"

echo -e "${GREEN}>>> 1. Syncing Repository...${NC}"
if [ -d "$DEST_DIR" ]; then
    echo -e "${YELLOW}Direktori sudah ada. Mengambil update terbaru...${NC}"
    cd "$DEST_DIR" || exit
    
    # Simpan perubahan .env jika ada (walaupun seharusnya di-ignore)
    # Gunakan fetch dan reset untuk memastikan server sama persis dengan GitHub
    sudo git fetch --all
    sudo git reset --hard origin/main
else
    echo -e "${YELLOW}Cloning repository untuk pertama kali...${NC}"
    sudo git clone "$REPO_URL" "$DEST_DIR"
    cd "$DEST_DIR" || exit
fi

echo -e "${GREEN}>>> 2. Menginstall PHP Dependencies...${NC}"
sudo composer install --no-dev --optimize-autoloader

echo -e "${GREEN}>>> 3. Konfigurasi .env...${NC}"
if [ ! -f ".env" ]; then
    echo -e "${YELLOW}Membuat file .env baru...${NC}"
    sudo cp .env.example .env
    sudo php artisan key:generate
fi

# Update .env settings dengan aman
update_env() {
    local key=$1
    local value=$2
    if grep -q "^${key}=" .env; then
        sudo sed -i "s|^${key}=.*|${key}=${value}|" .env
    else
        echo "${key}=${value}" | sudo tee -a .env > /dev/null
    fi
}

update_env "APP_ENV" "production"
update_env "APP_DEBUG" "false"
update_env "APP_URL" "https://$DOMAIN"
update_env "DB_DATABASE" "pos_ntbk"
update_env "DB_USERNAME" "ntbk_user"
update_env "DB_PASSWORD" "NtbkStore123!"

echo -e "${GREEN}>>> 4. Setting Permissions...${NC}"
sudo chown -R www-data:www-data "$DEST_DIR"
sudo chmod -R 755 "$DEST_DIR"
sudo chmod -R 775 "$DEST_DIR/storage" "$DEST_DIR/bootstrap/cache"

echo -e "${GREEN}>>> 5. Konfigurasi Nginx...${NC}"
NGINX_CONF="/etc/nginx/sites-available/$DOMAIN"

sudo tee "$NGINX_CONF" > /dev/null <<'EOF'
server {
    listen 80;
    server_name pos.ntbkstoretsm.web.id;
    root /var/www/ntbk-store/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

sudo ln -sf "$NGINX_CONF" /etc/nginx/sites-enabled/
if sudo nginx -t; then
    sudo systemctl reload nginx
else
    echo -e "${RED}Konfigurasi Nginx error! Silakan cek manual.${NC}"
fi

echo -e "${GREEN}>>> 6. Optimasi Laravel...${NC}"
sudo php artisan storage:link || true # Avoid error if already exists
sudo php artisan optimize:clear
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache

echo -e "${GREEN}====================================================${NC}"
echo -e "${GREEN}DEPLOY BERHASIL!${NC}"
echo -e "${GREEN}Buka: https://$DOMAIN${NC}"
echo -e "${YELLOW}Catatan:${NC}"
echo -e "1. Jika Anda mengubah CSS/JS, pastikan sudah menjalankan 'npm run prod' secara lokal."
echo -e "2. Pastikan database sudah dimigrasi jika ada perubahan struktur."
echo -e "${GREEN}====================================================${NC}"

