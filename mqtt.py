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
         'AM107-16': 'B109',
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
    sql = "INSERT INTO DATA (DATA_TYPE, SOURCE,VALUE,TIMESTAMP) VALUES (%s, %s, %s, %s)"
    Nom = json_data['deviceName']
    if (Nom in salle):
        for key in json_data["object"]:
            print(key + " " + str(json_data["object"][key]))
            source = key
            value = str(json_data["object"][key])
            value = value
            temps = time.time()
            print( source, salle[Nom], value, temps)

            val = ( source, salle[Nom], value, temps)
            mycursor.execute(sql, val)
        mydb.commit()
        print(json_data['deviceName'])
        print("test")
        print(time.time())


client = paho.Client()
client.on_message = onMessage

if client.connect("chirpstack.iut-blagnac.fr", 1883, 60) != 0:
    print("Could not connect to MQtt Broker")

client.subscribe("application/1/device/+/event/up")

try:

    client.loop_forever()


except Exception as e:
    print(e)

client.disconnect()
