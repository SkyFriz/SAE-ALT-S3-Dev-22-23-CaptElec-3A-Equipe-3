import json
import paho.mqtt.client as paho
import sys
import mysql.connector

import time

config = open(".CONFIG", "r")
password = config.read()

salle = {'AM107-2': 'B201',
         'AM107-3': 'B202',
         'AM107-4': 'B203',
         'AM107-5': 'B110',
         'AM107-6': 'B111',
         'AM107-7': 'B2001',
         'AM107-8': 'B002',
         'AM107-9': 'B003',
         'AM107-10': 'B101',
         'AM107-11': 'B102',
         'AM107-12': 'B103',
         'AM107-13': 'B105',
         'AM107-14': 'B106',
         'AM107-15': 'B108',
         'AM107-16': 'B109',
         'AM107-17': 'B112',
         'AM107-18': 'B113',
         'AM107-19': 'B212',
         'AM107-20': 'B217',
         'AM107-21': 'B219',
         'AM107-22': 'B234',
         'AM107-23': 'C004',
         'AM107-24': 'C006',
         'AM107-25': 'D001',
         'AM107-26': 'E003',
         'AM107-27': 'E004',
         'AM107-28': 'E001',
         'AM107-29': 'E006',
         'AM107-30': 'E007',
         'AM107-31': 'E101',
         'AM107-32': 'E102',
         'AM107-33': 'E103',
         'AM107-34': 'E104',
         'AM107-35': 'E105',
         'AM107-36': 'E106',
         'AM107-37': 'E100',
         'AM107-38': 'E208',
         'AM107-39': 'E209',
         'AM107-40': 'E206',
         'AM107-41': 'E207',
         'AM107-42': 'E210',
         'AM107-43': 'Salle-conseil',
         'AM107-44': 'A007',
         'AM107-45': 'Local-velo',
         'AM107-46': 'Foyer-personnels',
         'AM107-47': 'Foyer-etudiants-1',
         'AM107-48': 'Foyer-etudiants-2',
         'AM107-49': 'hall-1',
         'AM107-50': 'hall-2',
         'AM107-51': 'amphi1'
         }

mydb = mysql.connector.connect(
    host="51.38.52.224",
    user="saeS3",
    password=password,
    database="saeS3"
)

mycursor = mydb.cursor()


def onMessage(client, userdata, msg):
     json_data = json.loads(msg.payload)


    if ('batteryLevel') in json_data:

        nom = (json_data['deviceName'])
        batery = (json_data['batteryLevel'])
        temps = (time.time())

        sql = "INSERT INTO DEVICE_INFO (SOURCE , VALUE ,TIMESTAP) VALUES (%s, %s, %s)"
        val = (nom, batery, temps)
        mycursor.execute(sql, val)
        mydb.commit()

    else:
        sql = "INSERT INTO DATA (DATA_TYPE, SOURCE,VALUE,TIMESTAMP) VALUES (%s, %s, %s, %s)"
        Nom = json_data['deviceName']
        if (Nom in salle):
            for key in json_data["object"]:
                print(key + " " + str(json_data["object"][key]))
                source = key
                value = str(json_data["object"][key])
                value = value
                temps = time.time()
                print(source, salle[Nom], value, temps)

                val = (source, salle[Nom], value, temps)
                mycursor.execute(sql, val)
            mydb.commit()
       

client = paho.Client()
client.on_message = onMessage

if client.connect("chirpstack.iut-blagnac.fr", 1883, 60) != 0:
    print("Could not connect to MQtt Broker")

client.subscribe("application/1/device/+/event/up")
client.subscribe("application/1/device/+/event/status")

try:

    client.loop_forever()


except Exception as e:
    print(e)

client.disconnect()
