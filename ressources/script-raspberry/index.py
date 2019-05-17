import pymysql
import datetime
import time


while(True):
    # On récupère les données des capteurs de l'arduino
    temperature = 20.0
    brightness = 100
    humidity = 50.0
    date = datetime.datetime.now()


    try:
        file = open('data.txt', 'r')
        rows = file.read().split(';')
        user_id = rows[0]
        flower_id = rows[1]
    except:
        user_id = None
        flower_id = None


    # Connexion à la BDD
    connection = pymysql.connect(host='localhost',
                                 user='root',
                                 password='root',
                                 db='iot-plante',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)

    # On ajoute les données à la bdd
    try:
        with connection.cursor() as cursor:
            # Créatuib de la requête
            sql = "INSERT INTO `measures` (`temperature_measures`, `humidity_measures`, `brightness_measures`, `user_id`, `flower_id`, `date_measures`) VALUES (%s, %s, %s, %s, %s, %s)"
            cursor.execute(sql, (temperature, humidity, brightness, user_id, flower_id, date))

        connection.commit()
    finally:
        connection.close()

    time.sleep(10)

