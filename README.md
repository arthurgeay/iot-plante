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

*A venir*


## Instructions d'installation

 1. Cloner le projet `git clone https://github.com/arthurgeay/iot-plante.git`
 2. Installer un serveur web permettant d'exécuter du PHP. Le plus simple étant d'installer une plateforme LAMP (Apache, MySQL, PHP) sur sa machine : [WAMP](https://www.clubic.com/telecharger-fiche27009-wampserver.html) (windows) | [MAMP](https://www.mamp.info/en/) (Mac) | Linux (LAMP)
 3. Installer [Python](https://www.python.org/downloads/)
 4. Créer une base de données depuis phpMyAdmin `CREATE DATABASE lenomdemabase` 
 5. Importer le script SQL depuis phpMyAdmin pour créer les différentes tables nécessaires au bon fonctionnement du projet (`ressources/sql/iot-plante.sql`)


**Première connexion à l'application** :
 1. Se rendre à l'adresse : localhost/iot-plante
 2. Cliquer sur le lien "Vous n'avez pas de compte ?" puis rentrer l'identifiant et le mot de passe de connexion
 3. Connectez-vous ensuite à l'application avec vos identifiants créés



