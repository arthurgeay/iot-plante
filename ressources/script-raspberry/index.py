# coding: utf-8

import pymysql
import datetime
import time
import smtplib
import os

# Dictionnaire qui stocke les dates d'envoi des alertes
dateAlert = {}

def sendMail(msg, dest):
    file = open(os.path.dirname(os.path.abspath(__file__)) + '/email.txt', 'r')
    rows = file.read().split(';')
    gmail_user = rows[0]
    gmail_password = rows[1]
    file.close()

    sent_from = gmail_user
    to = [dest]
    subject = 'Alerte - Connected Flowers'
    body = "Bonjour, notre systeme a detecte qu'un ou plusieurs des indicateurs captees pour la plante ne sont pas optimales :\n\n" + msg + "\n\n Connected Flowers"

    email_text = """From: %s\nTo: %s\nSubject: %s\n\n%s
        """ % (sent_from, ", ".join(to), subject, body)

    try:
        server = smtplib.SMTP_SSL('smtp.gmail.com', 465)
        server.ehlo()
        server.login(gmail_user, gmail_password)
        server.sendmail(sent_from, to, email_text)
        server.close()

        print('Email sent!')
    except:
        print('Something went wrong...')




while(True):
    # On récupère les données des capteurs de l'arduino
    temperature = 5.0
    brightness = 100
    humidity = 50
    date = datetime.datetime.now()


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

                if(('temperature' not in dateAlert or 'temperature' in dateAlert and dateAlert['temperature'] != date.date()) and (result['temperature_measures'] < 10.0 or result['temperature_measures'] > result['temperature_flower'])):
                    sendMail("La temperature est trop faible. La temperature ideale est comprise entre 10 degre et " + str(result['temperature_flower']) + " degre", user_email)
                    dateAlert['temperature'] = date.date()

                if(('brightness' not in dateAlert or 'brightness' in dateAlert and dateAlert['brightness'] != date.date()) and result['brightness_measures'] < result['brightness_flower']):
                    sendMail("La luminosite est trop faible. \n La luminosite optimale ne doit pas etre en dessous de  " + str(result['brightness_flower']) + " pourcent", user_email)
                    dateAlert['brightness'] = date.date()

                if(('humidity' not in dateAlert or 'humidity' in dateAlert and dateAlert['humidity'] != date.date()) and result['humidity_measures'] < result['humidity_flower']):
                    sendMail("L'humidite est trop faible. \n L'humidite optimale doit etre de " + str(result['humidity_flower']) + " pourcent", user_email)
                    dateAlert['humidity'] = date.date()

                print(dateAlert)

            connection.commit()
        finally:
            connection.close()
    time.sleep(10)

