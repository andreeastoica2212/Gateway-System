#include <iostream>
#include “../RF24/RF24.h" //am inclus libraria pentru a lucra cu nRF24L01
using namespace std;

#define PIN_CE  17 //pinul GPIO17 de pe raspberry pi
#define PIN_CSN 0
uint8_t pipeNumber;
uint8_t payloadSize;

int main() {
  RF24 radio(PIN_CE, PIN_CSN); //creeaza un obiect comandat de pinul GPIO17 de chip enable si cel de Chip Set Enable
  radio.begin();
  radio.setChannel(5); //seteaza canalul de ascultare (canalul 5)     
  radio.setPALevel(RF24_PA_HIGH);
  radio.setDataRate(RF24_1MBPS); //seteaza viteza transmisiei
  radio.enableDynamicPayloads(); /*functie ce ajuta la receptia ordonata a bitilor din sirul de caractere ce va fi transmis (un bit - un caracter)*/

  radio.openReadingPipe(0, 0x7878787878LL);
  radio.printDetails();
  radio.startListening(); //incepe sa asculte
  cout << "Start listening..." << endl;

  while (true) {
    if (radio.available(&pipeNumber)) {
      payloadSize = radio.getDynamicPayloadSize(); /*preia dimenziunea datelor trimise*/
      char payload[payloadSize];
      string receivedData;
      radio.read(&payload, sizeof(payload));

      for (uint8_t i = 0; i < payloadSize; i++) 
          receivedData += payload[i]; /*construiesc sirul nou cu mesajul receptionat*/

      cout << "Pipe : " << (int) pipeNumber << " ";
      cout << "Size : " << (int) payloadSize << " “; /*dimensiua mesajului receptionat*/
      cout << "Data : " << receivedData << endl; //mesajul receptionat

      delay(100);
    }
  }
  return 0;
}
