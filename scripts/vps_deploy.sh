#!/bin/bash

# ==========================================================================
# vps_deploy.sh - NTBK Store Tasikmalaya
# Digunakan untuk deploy aplikasi ke direktori /var/www/ntbk-store
# ==========================================================================

GREEN='\033[0;32m'
NC='\033[0m'

DOMAIN="pos.ntbkstoretsm.web.id"
REPO_URL="https://github.com/KanaNatsume/poscabangnvt.git"
DEST_DIR="/var/www/ntbk-store"

echo -e "${GREEN}>>> 1. Cloning Repository...${NC}"
if [ -d "$DEST_DIR" ]; then
    echo "Direktori sudah ada. Melakukan pull terbaru..."
    cd $DEST_DIR
    sudo git pull origin main
else
    sudo git clone $REPO_URL $DEST_DIR
    cd $DEST_DIR
fi

echo -e "${GREEN}>>> 2. Menginstall PHP Dependencies...${NC}"
sudo composer install --no-dev --optimize-autoloader

echo -e "${GREEN}>>> 3. Konfigurasi .env...${NC}"
if [ ! -f ".env" ]; then
    sudo cp .env.example .env
    sudo php artisan key:generate
fi

# Update .env settings (Gunakan sed untuk mengganti nilai)
sudo sed -i "s|APP_ENV=.*|APP_ENV=production|" .env
sudo sed -i "s|APP_DEBUG=.*|APP_DEBUG=false|" .env
sudo sed -i "s|APP_URL=.*|APP_URL=https://$DOMAIN|" .env
sudo sed -i "s|DB_DATABASE=.*|DB_DATABASE=pos_ntbk|" .env
sudo sed -i "s|DB_USERNAME=.*|DB_USERNAME=ntbk_user|" .env
sudo sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=NtbkStore123!|" .env

echo -e "${GREEN}>>> 4. Setting Permissions...${NC}"
sudo chown -R www-data:www-data $DEST_DIR
sudo chmod -R 755 $DEST_DIR
sudo chmod -R 775 $DEST_DIR/storage $DEST_DIR/bootstrap/cache

echo -e "${GREEN}>>> 5. Konfigurasi Nginx...${NC}"
NGINX_CONF="/etc/nginx/sites-available/$DOMAIN"
sudo bash -c "cat > $NGINX_CONF <<EOF
server {
    listen 80;
    server_name $DOMAIN;
    root $DEST_DIR/public;

    add_header X-Frame-Options \"SAMEORIGIN\";
    add_header X-XSS-Protection \"1; mode=block\";
    add_header X-Content-Type-Options \"nosniff\";

    index index.php;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF"

sudo ln -sf $NGINX_CONF /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx

echo -e "${GREEN}>>> 6. Optimasi Laravel...${NC}"
sudo php artisan storage:link
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache

echo -e "${GREEN}====================================================${NC}"
echo -e "${GREEN}DEPLOY BERHASIL!${NC}"
echo -e "${GREEN}Buka: https://$DOMAIN${NC}"
echo -e "${GREEN}Jangan lupa import database pos-rash.sql secara manual!${NC}"
echo -e "${GREEN}====================================================${NC}"
