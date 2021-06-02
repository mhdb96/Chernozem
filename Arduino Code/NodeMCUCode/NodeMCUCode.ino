#include <SoftwareSerial.h>
#include <ESP8266WiFi.h>
#include <FirebaseArduino.h>
#include <NTPClient.h>
#include <WiFiUdp.h>
#include <ArduinoJson.h>

SoftwareSerial s(D6,D5);
#define FIREBASE_HOST "nodemcu-test-2161a.firebaseio.com" 
#define FIREBASE_AUTH "LkYiTqhvFtTQpdOGFXOA4St3vxOGW8Mq51Qx2FRR" 

const long utcOffsetInSeconds = 3600*3;

char daysOfTheWeek[7][12] = {"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"};

// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds);

const char* ssid="FreeGate";
const char* password = "Alpha1997";
String extIp = "";
String MacAddress = "";
int fan = D0;
int pump = D1;
int alarm = D2;
int wifi = D3;
int noWifi = D4;
int i = 0;

int gas;
int pir;
float temp;
int hum;
int soilHum;
int water;

int gasLimit = 300;
int soilHumLimit = 500;
int tempLimit = 24;

int fanStatus = 3;
int pumpStatus = 3;
int alarmStatus = 3; 
int resetStatus = 0; 

void GetExternalIP()
{
  WiFiClient client;
  if (!client.connect("api.ipify.org", 80)) {
    Serial.println("Failed to connect with 'api.ipify.org' !");
  }
  else {
    int timeout = millis() + 5000;
    client.print("GET /?format=json HTTP/1.1\r\nHost: api.ipify.org\r\n\r\n");
    while (client.available() == 0) {
      if (timeout - millis() < 0) {
        Serial.println(">>> Client Timeout !");
        client.stop();
        return;
      }
    }
    int size;
    while ((size = client.available()) > 0) {
      uint8_t* msg = (uint8_t*)malloc(size);
      
      size = client.read(msg, size);
      String smsg = String((char *)msg);
      int f = smsg.indexOf("{");
      int t = smsg.indexOf("}");
      extIp = smsg.substring(f+7,t-1); 
      Serial.print("External IP: ");
      Serial.println(extIp);
      free(msg);
      String adress = MacAddress + "/Info/ExternalIP";     
      Firebase.setString(adress ,extIp);
    }
  }
}



void connectToWifi()
{
  digitalWrite(wifi, LOW);  
  WiFi.begin(ssid,password);
  Serial.println();
  Serial.print("Connecting");
  int starting = millis();
  while( WiFi.status() != WL_CONNECTED ){
      delay(500);
      Serial.print(".");
      if(millis() - starting > 10000)
      {
        Serial.println("Offline Mode");
        digitalWrite(noWifi, HIGH);
        offlineMode();        
      }
      
  }
  digitalWrite(wifi, HIGH);
  digitalWrite(noWifi, LOW);
  Serial.println();
  Serial.println("Wifi Connected Success!");
  Serial.print("NodeMCU IP Address : ");
  Serial.println(WiFi.localIP() );
  Serial.println(WiFi.macAddress());
  MacAddress = String(WiFi.macAddress());
  MacAddress.replace(":","-");
  GetExternalIP();
}

void offlineMode()
{
  while( WiFi.status() != WL_CONNECTED ){ 
    yield(); 
    Serial.println("offl");  
    if(!checkJSON())
    continue; 
    controlGas();
    controlSoilHumidity();
    controlTemp();
    controlMovement();
  }
}

void controlGas()
{
  if(gas > gasLimit)
  {
    digitalWrite(pump, LOW);
  }
  else 
  {
    digitalWrite(pump, HIGH);
  }
}

void controlSoilHumidity()
{
    if(soilHum > soilHumLimit)
  {
    digitalWrite(pump, LOW);
  }
  else 
  {
    digitalWrite(pump, HIGH);
  }
}
 
void controlTemp()
{
    if(temp > tempLimit)
  {
    digitalWrite(fan, LOW);
  }
  else 
  {    
    digitalWrite(fan, HIGH);
  }
}
void controlMovement()
{
  if(pir == 1)
  {
    digitalWrite(alarm, HIGH);
  }
  else 
  {
    digitalWrite(alarm, LOW);
  }
}


 
void setup() {
  pinMode(noWifi, OUTPUT);
  digitalWrite(noWifi, LOW);
  pinMode(wifi, OUTPUT);
  digitalWrite(wifi, LOW);
  pinMode(fan, OUTPUT);
  digitalWrite(fan, HIGH);
  pinMode(pump, OUTPUT);
  digitalWrite(pump, HIGH);
  pinMode(alarm, OUTPUT);
  digitalWrite(alarm, LOW);
  
  Serial.begin(9600);
  s.begin(115200);
  while (!Serial) continue;
  Serial.println();
  Serial.print("Wifi connecting to ");
  Serial.println( ssid );
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
  connectToWifi(); 

  while(!getAutomation()){

  }
  
  if(!getSetters())
  {    
    String subAdress = MacAddress + "/Setters/";
    StaticJsonBuffer<100> jsonBuffer;
    JsonObject& root = jsonBuffer.createObject();
    root["Fan"] = 3;
    root["Pump"] = 3;
    root["Alarm"] = 3;
    root["Reset"] = 0;
    root["AControl"] = 0;
    Firebase.set(subAdress, root);
    jsonBuffer.clear();
  }
  Firebase.remove(MacAddress + "/Data");
  timeClient.begin();
  
  
}

void pushToFirebase(const String& subAdress, int& value)
{
  StaticJsonBuffer<100> jsonBuffer;
  JsonObject& data = jsonBuffer.createObject(); 
  String adress = MacAddress + "/Data/";    
  data["value"] = value;
  data["time"] = timeClient.getFormattedTime();  
  Firebase.push(adress + subAdress ,data);
  //Serial.println(Firebase.success());
  jsonBuffer.clear();
}
void pushToFirebase(const String& subAdress, float& value)
{
  StaticJsonBuffer<100> jsonBuffer;
  JsonObject& data = jsonBuffer.createObject(); 
  String adress = MacAddress + "/Data/";    
  data["value"] = value;
  data["time"] = timeClient.getFormattedTime();
  Firebase.push(adress + subAdress ,data);
  //Serial.println(Firebase.success());
  jsonBuffer.clear();
}

bool getSetters()
{
  String subAdress = MacAddress + "/Setters/";  
  const ArduinoJson::JsonObject& setters = Firebase.get(subAdress).getJsonVariant().asObject();
  if(setters["Fan"] == 0 || setters["Pump"] == 0 || setters["Alarm"] == 0)
  {
    return false;
  } 
  else
  {
    setters.prettyPrintTo(Serial);
    fanStatus = setters["Fan"];
    pumpStatus = setters["Pump"];
    alarmStatus = setters["Alarm"];
    resetStatus = setters["Reset"]; 
    return true;  
  }
}

bool getAutomation()
{
  String subAdress = MacAddress + "/Automation/";
  const ArduinoJson::JsonObject& automation = Firebase.get(subAdress).getJsonVariant().asObject();
  automation.prettyPrintTo(Serial);
  if(automation["GasLimit"] == 0 || automation["SoilHumidityLimit"] == 0 || automation["TempretureLimit"] == 0)
  {
    return false;
  } 
  else
  {
    automation.prettyPrintTo(Serial);
    gasLimit = automation["GasLimit"];
    tempLimit = automation["TempretureLimit"];
    soilHumLimit = automation["SoilHumidityLimit"];
    return true;  
  }
}

bool checkJSON()
{
  StaticJsonBuffer<170> jsonBuffer;
  JsonObject& root = jsonBuffer.parseObject(s);     
  if (root == JsonObject::invalid())
  {
    jsonBuffer.clear();
    return false;    
  }
  else {
    gas = root["gas"];
    pir = root["pir"];
    temp = root["temp"];
    hum = root["hum"];
    soilHum = root["soilHum"];
    water = root["water"];
    if(gas == 0 || temp == 0 || hum == 0 || soilHum == 0 || water == 0 || pir == 0)
    {
      jsonBuffer.clear();  
      return false;  
    }
    if(pir == 100)
    pir = 0;
    else if(pir == 111)
    pir = 1;
    root.prettyPrintTo(Serial);
    jsonBuffer.clear();
    return true;
  }
}
 
void loop() {
  
  if(WiFi.status() != WL_CONNECTED)
  {
    connectToWifi();
  }  
  Serial.println("onli");
  if(!checkJSON())
    return;
  if(!getSetters())
    return;
  timeClient.update();
  if(resetStatus == 1)
  {
    Firebase.remove(MacAddress + "/Data");
    ESP.reset();
  }
  if(fanStatus == 1)
  {
    digitalWrite(fan, HIGH);
  }
  else if(fanStatus == 2) 
  {
    digitalWrite(fan, LOW);
  }
  else
  {
    controlTemp();
  }
  if(pumpStatus == 1)
  {
    digitalWrite(pump, HIGH);
  }
  else if(pumpStatus == 2) 
  {
    digitalWrite(pump, LOW);
  }
  else 
  {
    controlGas();
    controlSoilHumidity();
  }
  if(alarmStatus == 1)
  {
    digitalWrite(alarm, LOW);
  }
  else if(alarmStatus == 2)
  {
    digitalWrite(alarm, HIGH);
  }
  else
  {
    controlMovement();
  }
  Serial.println(++i);
  pushToFirebase("Gas",gas);
  pushToFirebase("Movement",pir);
  pushToFirebase("Tempreture",temp);
  pushToFirebase("Humidity",hum);
  pushToFirebase("SoilHumidity",soilHum);  
  pushToFirebase("Water",water);
  delay(1000);
}
  
