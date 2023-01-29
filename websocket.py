import asyncio
import json
import websockets
import mysql.connector

clients = set()

config = open(".CONFIG", "r")
password = config.read()






async def handle_client(websocket, path):
    clients.add(websocket)
    client_address = websocket.remote_address
    print(f'Client connected from {client_address[0]}:{client_address[1]}')
    try:
        last_unix = "0"
        data_recv = json.loads(await websocket.recv())
        print (data_recv)
        # room:     //"all" for all rooms default all
        # data_type: //select data type "all" for all kinds of data
        # last_values: // min 1 all for all values
        # timestamp min //
        if "room" not in data_recv or data_recv["room"] == "all":
            room = '%'
        else:
            room = data_recv["room"]
        
        if "data_type" not in data_recv or data_recv["data_type"] == "all":
            data_type = '%'
        else:
            data_type = data_recv["data_type"]

        if "last_values" not in data_recv or data_recv["last_values"] == "all":
            last_values = '%'
        else:
            last_values = data_recv["last_values"]
        if "timestamp" not in data_recv:
            timestamp = 0.0
        else:
            timestamp = float(data_recv["timestamp"])
        
        while True:
            # Connect to the database
            mydb = mysql.connector.connect(
            host="51.38.52.224",
            user="saeS3",
            password=password,
            database="saeS3"
            )

            cursor = mydb.cursor()
            # treat last timestamp
            # Retrieve data from the database and send it only if new data appears
            if last_unix == "0":
                cursor.execute("SELECT * FROM DATA D WHERE D.SOURCE LIKE '"+room+"' AND D.DATA_TYPE LIKE '"+data_type+"' AND D.TIMESTAMP > "+str(timestamp)+" AND D.TIMESTAMP = (SELECT MAX(C.TIMESTAMP) FROM DATA C WHERE D.SOURCE = C.SOURCE) ORDER BY TIMESTAMP DESC;")
                # cursor.execute("SELECT * FROM DATA WHERE SOURCE LIKE '"+room+"' AND DATA_TYPE LIKE '"+data_type+"' AND TIMESTAMP > "+str(timestamp)+" ORDER BY TIMESTAMP DESC LIMIT 200;")
            else:
                cursor.execute("SELECT * FROM DATA D WHERE D.SOURCE LIKE '"+room+"' AND D.DATA_TYPE LIKE '"+data_type+"' AND D.TIMESTAMP > "+str(timestamp)+"ORDER BY TIMESTAMP DESC;")

            rows = cursor.fetchall()
            cursor.close()
            #ydb.close()
            #print(rows)
            if len(rows) > 0:
                data = json.dumps(rows)
                print(data)
                print("-----------------------------------------------")
                # Send data to the client
                last_unix = rows[0][3]
                timestamp = last_unix
                await websocket.send(data)
            await asyncio.sleep(1)  # Wait for 1 second before sending data again
    except websockets.exceptions.ConnectionClosed:
        clients.remove(websocket)
        mydb.close()
        print(f'Client disconnected from {client_address[0]}:{client_address[1]}')
    except Exception as e:
        mydb.close()
        print("Error: ", e)

start_server = websockets.serve(handle_client, "0.0.0.0", 8090)

asyncio.get_event_loop().run_until_complete(start_server)
asyncio.get_event_loop().run_forever()

