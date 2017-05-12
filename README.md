# PPIL-Laravel
Projet PPIL - L3 Informatique - FST

## Setup avec Docker/laradock
* (Installer docker)
* Cloner le projet
* Pull https://github.com/laradock/laradock à la racine du projet
* Dans laradock/
    * ```cp env-example .env``` : On renome env-example en .env
    * ```docker-compose up -d nginx mysql phpmyadmin``` : On start les containers
* A la racine du projet
    * ``` composer update ``` : Download des dépendances
    * ``` php artisan key:generate ```
    * ```sudo chmod 777 -R storage/ ```
* Le serveur nginx est dispo sur le port 80 (par défaut). Aller sur http://localhost pour voir si ça marche 
* Phpmyadmin est dispo sur le port 8080 (par défaut). Aller sur http://localhost:8080 pour voir si ça marche
* Pour se connecter à Php my admin :
    * Serveur : l'IP / nom de domaine de la machine hôte 
    * Login : root
    * Password : root / root (A modifier dans laradock/.env si ça convient pas)
* Se connecter en root (Password : root) sur php my admin pour créer la base 
* Créer une base appelée PPIL (Fin appelles là comme tu veux on s'en fou enfaite)
* On revient dans le dossier du projet
* Dans le .env (Du dossier racine hein, pas celui de laradock OK??)
* S'assurer d'avoir qqc qui ressemble à ça
    * DB_CONNECTION=mysql
    * DB_HOST=192.168.1.53 (IP / Nom de domaine de la machine hôte)
    * DB_PORT=3306
    * DB_DATABASE=PPIL (Le nom que t'as donné à la base)
    * DB_USERNAME=root 
    * DB_PASSWORD=root (#ultrasécu)
    
# Persistence de la base entre les reboots
Petit détail très léger, le dossier où est stocké la base est par défaut /tmp..... (Sérieusement quoi...) 
Pour changer ça :
* A la racine du projet, créer un dossier app-data
* Dans le .env du dossier laradock
    * Remplacer DATA_SAVE_PATH=/tmp par DATA_SAVE_PATH=../app-data
    
## Si vous voulez un IP fixe pour phpmyadmin et pour le .env
* Sur Mac
    * sudo ifconfig nomdel'interface alias IP/Masque
    * Ex : sudo ifconfig en0 alias 10.200.10.1/24
* Sur linux
    * sudo ifconfig nomdel'interface:0 IP up
    * Ex : sudo ifconfig enp1s0:0 10.200.10.1 up
    * Ex : sudo ifconfig wlan0:0 10.200.10.1 up

## Infos
* Les routes sont dans routes/web.php
* Créer un Controller : php artisan make:controller -> app/Http/Controllers
* Créer un Model avec fichier de migration : php artisan make:model User -m 
    * -> Classe User dans app/
    * -> fichier de migration create_users_table dans database/migrations/