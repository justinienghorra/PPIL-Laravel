# PPIL-Laravel
Projet PPIL - L3 Informatique - FST

## Setup avec Docker/laradock
* (Installer docker)
* Pull https://github.com/laradock/laradock à la racine du projet
* Dans laradock/
    * ```cp env-example .env```
    * Dans le .env, changer le MDP de MYSQL (ligne 91)
    * ```docker-compose up -d nginx mysql phpmyadmin```
* Le serveur nginx est dispo sur le port 80 (par défaut). Aller sur http://localhost pour voir si ça marche 
* Phpmyadmin est dispo sur le port 8080 (par défaut). Aller sur http://localhost:8080 pour voir si ça marche
* Pour se connecter à Php my admin :
    * Serveur : l'IP de la machine hôte (192.169.99.100 par défaut)
    * Login : default / root (Par défaut, à modifier dans le .env du dossier laradock dans la section MYSQL si ça convient pas)
    * Password : secret / root (Par défaut, pareil si vous voulez modifier)
* Se connecter en root (Password : root) sur php my admin pour créer la base 
* Créer une base appelée PPIL (Fin appelles là comme tu veux on s'en fou enfaite)
* On revient dans le dossier du projet
* Dans le .env (Du dossier racine hein, pas celui de laradock OK??)
* S'assurer d'avoir qqc qui ressemble à ça
    * DB_CONNECTION=mysql
    * DB_HOST=192.168.1.53 (Ton IP)
    * DB_PORT=3306
    * DB_DATABASE=PPIL (Le nom que t'as donné à la base)
    * DB_USERNAME=root 
    * DB_PASSWORD=root (#ultrasécu)

