#include <SoftwareSerial.h>
#include <ArduinoJson.h>
#include <DHT.h>
SoftwareSerial sa(5,6);
int gasPin = A0;
int pirPin = 2;
int soilHumPin = A1;
int waterPin = A2;
#define DHTPIN 3
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  pinMode(pirPin, INPUT);
  sa.begin(115200);
  Serial.begin(9600);
  dht.begin();
}
 
void loop() {
 StaticJsonBuffer<170> jsonBuffer;
 JsonObject& root = jsonBuffer.createObject();
 int water = analogRead(waterPin);
 if(water == 0)
 {
    water = 1;
 }
 int gas = analogRead(gasPin);
 int pir = digitalRead(pirPin);
 if(pir == 0)
 {
    pir = 100;
 }
 else 
 {
    pir = 111;
 }
 int soilHum = analogRead(soilHumPin);
 float hum = dht.readHumidity();
 float temp = dht.readTemperature();
  root["temp"] = temp;
  root["hum"] = hum;
  root["gas"] = gas;
  root["pir"] = pir; 
  root["soilHum"] = soilHum; 
  root["water"] = water;    
  root.prettyPrintTo(Serial);
if(sa.isListening())
{
 root.printTo(sa);
}
}
