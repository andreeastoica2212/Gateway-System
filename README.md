# gateway
This project is a gateway system implemented on a Raspberry Pi 4 that uses Wi-Fi and nRF technologies for collecting data from 3 different senzors. 

The Wi-Fi communication is established with a WeMos board that has a temperature sensor connected to it (DS18B20) and a ESP8266 based module with a water level sensor. Both of the devices use the HTTP protocol to send data to a database located on the Raspberry. The data is displayed in a php page that comes from the Raspberry Pi which acts as a web server.

The nRF communication is established betweeen the Raspberry Pi (with a nRF module connected) which acts as a receiver and an Arduino (that also has an nRF module connected) to which I connected a proximity sensor (HC-SR04). The sensor sends a "presence detected" message to the terminal of the Raspberry Pi when it detects something.

The Raspberry Pi acts as a gateway for the 3 sensors presented.
