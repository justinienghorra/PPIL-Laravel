# PPIL-Laravel
Projet PPIL - L3 Informatique - FST

## Setup avec Docker/laradock
* (Installer docker)
* Pull https://github.com/laradock/laradock à la racine du projet
* Dans laradock/
    * cp env-exmample .env
    * Dans le .env, changer le MDP de MYSQL (ligne 106)
    * docker-compose up -d nginx mysql phpmyadmin
    * Aller sur http://localhost pour voir si ça marche 
