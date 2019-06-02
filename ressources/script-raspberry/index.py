# coding: utf-8

import pymysql
import datetime
import time
import smtplib
import os
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# Dictionnaire qui stocke les dates d'envoi des alertes
dateAlert = {'temperature': None, 'brightness': None, 'humidity': None, 'flower_id': None}

def sendMail(msg, dest):
    # Ouverture du fichier qui stocke les identifiant de connexion mail
    file = open(os.path.dirname(os.path.abspath(__file__)) + '/email.txt', 'r')
    rows = file.read().split(';')
    gmail_user = rows[0]
    gmail_password = rows[1]
    file.close()

    sent_from = gmail_user
    send_to = dest
    subject = 'Alerte - Connected Flowers'
    body = "Bonjour, notre systeme a detecte qu'un ou plusieurs des indicateurs captees pour la plante ne sont pas optimales :\n\n" + msg + "\n\n Connected Flowers"

    msg = MIMEMultipart()
    msg['From'] = sent_from
    msg['To'] = send_to
    msg['Subject'] = subject

    msg.attach(MIMEText(body, 'plain'))

    # Ouverture du fichier de log
    log = open(os.path.dirname(os.path.abspath(__file__)) + '/logs.txt', 'a')
    try:
        server = smtplib.SMTP_SSL('smtp.gmail.com', 465)
        server.ehlo()
        server.login(gmail_user, gmail_password)
        server.sendmail(sent_from, send_to, msg.as_string())
        server.quit()

        log.write(str(datetime.datetime.now()) + ': Email sent! \n')
    except:
        log.write(str(datetime.datetime.now()) + ': Something went wrong... \n')
    log.close()



while(True):
    # On récupère les données des capteurs de l'arduino
    temperature = 5.0
    brightness = 100
    humidity = 50
    date = datetime.datetime.now()

    # Récupération des données du fichier data
    try:
        fileData = open(os.path.dirname(os.path.abspath(__file__)) + '/data.txt', 'r')
        rows = fileData.read().split(';')
        user_id = rows[0]
        flower_id = rows[1]
        user_email = rows[2]
        fileData.close()
    except:
        user_id = None
        flower_id = None
        user_email = None

    if(user_id != None and flower_id != None):
        # Connexion à la BDD
        connection = pymysql.connect(host='localhost', user='root', password='root', db='iot-plante', charset='utf8mb4',
                                     cursorclass=pymysql.cursors.DictCursor)

        # On ajoute les données à la bdd
        try:
            with connection.cursor() as cursor:
                # Création de la requête pour insérer les données de mesure
                sql = "INSERT INTO `measures` (`temperature_measures`, `humidity_measures`, `brightness_measures`, `user_id`, `flower_id`, `date_measures`) VALUES (%s, %s, %s, %s, %s, %s)"
                cursor.execute(sql, (temperature, humidity, brightness, user_id, flower_id, date))

                # On récupère les données de mesures et on vérifie si elles sont correcte sinon on envoie une alerte
                cursor.execute(
                    "SELECT * FROM measures AS m INNER JOIN flower AS f ON f.id_flower = m.flower_id ORDER BY m.date_measures DESC")
                result = cursor.fetchone()

                if(dateAlert['flower_id'] != result['flower_id']):
                    if((dateAlert['flower_id'] != result['flower_id'] or dateAlert['temperature'] != date.date()) and (result['temperature_measures'] < 10.0 or result['temperature_measures'] > result['temperature_flower'])):
                        message = "La temperature est trop faible. La temperature ideale est comprise entre 10 degre et " + str(result['temperature_flower']) + " degre"
                        sendMail(message, user_email)
                        dateAlert['temperature'] = date.date()

                    if((dateAlert['flower_id'] != result['flower_id'] or dateAlert['brightness'] != date.date()) and result['brightness_measures'] < result['brightness_flower']):
                        message = "La luminosite est trop faible. La luminosite optimale ne doit pas etre en dessous de  " + str(result['brightness_flower']) + " pourcent"
                        sendMail(message, user_email)
                        dateAlert['brightness'] = date.date()

                    if(dateAlert['flower_id'] != result['flower_id'] or dateAlert['humidity'] != date.date() and result['humidity_measures'] < result['humidity_flower']):
                        message = "L'humidite est trop faible. L'humidite optimale doit etre de " + str(result['humidity_flower']) + " pourcent"
                        sendMail(message, user_email)
                        dateAlert['humidity'] = date.date()

                    dateAlert['flower_id'] = result['flower_id']

                print(dateAlert)

            connection.commit()
        finally:
            connection.close()
    time.sleep(10)

