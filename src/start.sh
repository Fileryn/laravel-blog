#!/bin/bash

# Générer la clé si pas présente
php artisan key:generate --force

# Lancer les migrations
php artisan migrate --force

# Créer le lien storage
php artisan storage:link

# Optimiser
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer le serveur
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
