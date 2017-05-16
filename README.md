# PPIL-Laravel
Projet PPIL - L3 Informatique - FST

## Infos pour le frontend
* ```php artisan migrate:refresh --seed ``` pour mettre à jour la base
* Après ça, deux utilisateur sont créés :
    * Le resp DI : jean.dupont@gmail.com | password
    * Un utilisateur lambda : utilisateur.lambda@gmail.com | password
    * Un respo UE : respoue@gmail.com | password
* La vue du login est dispo sur /login - elle a été générée par Laravel (A modifier)
* La vue register est dispo sur /register - elle a été générée par Laravel (A modifier)
* + la vue sur /en_attente
* La vue journal est dispo sur /di/journal (Quand on est loggé en resp DI)
* La vue annuaire est dispo sur /di/annuaire (Quand on est loggé en resp DI)
* La vue profil est dispo sur /profil
* La vue mesUE est dispo sur /respoUE (Quand on est loggé en resp UE)
* Les vues de la partie modélisation sont dispo sur /conception/xxxxxx

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
    
## Serveur SMTP
Dans le .env du dossier racine
* MAIL_DRIVER=smtp
* MAIL_HOST=smtp.mailtrap.io
* MAIL_PORT=2525
* MAIL_USERNAME=2604e9773d3819
* MAIL_PASSWORD=b43c493b95c203
* MAIL_ENCRYPTION=null

## Infos
* Les routes sont dans routes/web.php
* Créer un Controller : php artisan make:controller -> app/Http/Controllers
* Créer un Model avec fichier de migration : php artisan make:model User -m 
    * -> Classe User dans app/
    * -> fichier de migration create_users_table dans database/migrations/