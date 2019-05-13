import pymysql
import bcrypt

# On récupère les données des capteurs de l'arduino
temperature = 20.0
brightness = 100
humidity = 50.0


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
        sql = "INSERT INTO `measures` (`temperature_measures`, `humidity_measures`, `brightness_measures`, `user_id`, `flower_id`) VALUES (%s, %s, %s, %s, %s)"
        cursor.execute(sql, (temperature, humidity, brightness, 1, 1))

    connection.commit()
finally:
    connection.close()

