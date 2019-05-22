# Plante connectée

## Présentation du projet

Dans le cadre des projets à réaliser lors de ma première année à Ynov Nantes, il nous a été demandé de réaliser un objet connecté permettant à un novice en botanique de pouvoir planter une plante ainsi qu'une application permettant à l'utilisateur de suivre l'état de la plante.

**Matériels utilisés :** 

 - Arduino Uno
 - Raspberry Pi
 - Capteur de luminosité LM393
 - Capteur de température et d'humidité DHT11
 - Module WIFI ESP8266

**Les fonctionnalités de l'application cliente :** 

 - Connexion / Inscription
 - Suivi de la plante / Visualisation des données captées par les capteurs
 - Choisir une plante à planter
 - Ajouter une plante à la base de données existante
 - Alerte par mail si les conditions de la plante ne sont pas optimales

## Technologies utilisées

PHP | SQL | Python | C

## Architecture du projet

L'architecture se décompose ainsi :

 - Racine du projet : on retrouve le point d'entrée de l'application (index.php)
 - Répertoire CSS : contient l'unique feuille de style du projet
 - Répertoire Includes : contient toutes les portions de page et leur traitement en PHP. Le fichier db-functions contient toutes les fonctions permettant le 'requettage' des données
 - Répertoire Ressources : contient les différents code sources à intégrés pour l'Arduino mais aussi le script python pour le Raspberry ainsi que le script SQL d'installation de la base de données
 - Répertoire uploads  : répertoire qui contient les images de plante ajouté par l'utilisateur


```
    .
    ├── css
    │   └── style.css
    ├── includes
    │   ├── _add-flower.php
    │   ├── _connexion.php
    │   ├── _dashboard.php
    │   ├── _db-functions.php
    │   ├── _nav.php
    │   ├── _plant-flower.php
    │   ├── _treatment-add-flower.php
    │   ├── _treatment-dashboard.php
    │   ├── _treatment-logout.php
    │   ├── _treatment-log-register.php
    │   └── _treatment-plant-flower.php
    ├── index.php
    ├── README.md
    ├── ressources
    │   ├── code-arduino
    │   │   └── lecture_capteurs_dht11_LM393.ino
    │   ├── script-raspberry
    │   │   ├── email.txt
    │   │   └── index.py
    │   └── sql
    │       └── iot-plante.sql
    └── uploads
```

   

## Instructions d'installation

 1. Installer les différents éléments indispensables pour que le projet fonctionne sur la Raspberry : `sudo apt install php apache2 mysql-server phpmyadmin git python3 python3-pip postfix`
 2. Lors de la configuration de postfix, choisir l'option `Site internet` puis pour le nom de domaine : `iot-plante`
 3. Modifier le fichier de configuration de postfix : `sudo nano /etc/postfix/main.cf`et supprimer à la ligne mydestination iot.plante, | Modifier la ligne inet-interfaces = all par inet-interfaces = loopback-only 
 4. Redémarrer postfix : `sudo service postfix restart`
 5. Vérifier que votre Fournisseur d'Accès à Internet ne bloque pas les envois de mail SMTP. Vous pouvez désactiver le blocage en vous rendant sur la console d'administration de votre box; (généralement l'adresse pour y accéder est 192.168.1.1) 
 6. Installer la librairie pymysql pour Python : `sudo pip3 install pymysql`
 7. Se rendre dans le répertoire /var/www : `cd /var/www` puis `git clone https://github.com/arthurgeay/iot-plante.git`
 8. Modifier la configuration du virtual host par défaut : `sudo nano /etc/apache2/sites-available/000-default.conf`
 9. Supprimer le /html à la ligne -> `documentRoot: var/www` puis enregistrer le fichier
 10. Activer le fichier de configuration modifié : `sudo a2ensite 000-default.conf` puis redémarrer apache `sudo service apache2 restart`
 11. Créer une base de données depuis phpMyAdmin `CREATE DATABASE lenomdemabase` 
 12. Importer le script SQL depuis phpMyAdmin pour créer les différentes tables nécessaires au bon fonctionnement du projet (`ressources/sql/iot-plante.sql`)
 13. Modifier le fichier rc.local : `sudo nano /etc/rc.local`et insérer ceci sur deux lignes séparées (juste avant le exit 0) : `sudo service postfix start` et `sudo python3 /var/www/iot-plante/ressources/script-raspberry/index.py &` 
 14. Créer un fichier `email.txt`dans le répertoire `/var/www/iot-plante/ressources/script-raspberry` et insérer une adresse gmail et un mot de passe dans le fichier, sous la forme `adressemail;motdepasse`
 15. Modifier les droits du répertoire script-raspberry : `sudo chmod 777 /var/www/iot-plante/ressources/script-raspberry` et ceux du répertoire iot-plante : `sudo chmod 777 /var/www/iot-plante`


**Première connexion à l'application** :
 1. Se rendre à l'adresse : localhost/iot-plante
 2. Cliquer sur le lien "Vous n'avez pas de compte ?" puis rentrer l'identifiant et le mot de passe de connexion
 3. Connectez-vous ensuite à l'application avec vos identifiants créés



