#include <WiFi.h>
#include <WiFiClient.h>
#include <WiFiServer.h>
#include <WiFiUdp.h>
#include <OneWire.h>
#include <DallasTemperature.h>

/*
 * ESP8266 - 11, 10 pins; 
 * DS18B20 - 2 pin;
 * Mosfet - 3 pin;
*/

OneWire oneWire(2);// вход датчиков 18b20
DallasTemperature ds(&oneWire);
byte qty = 0; // количество градусников на шине 

#include <SoftwareSerial.h> //Подключаем библиотеку работы с Последовательным портом
SoftwareSerial mySerial(11, 10); //На эти ноги подключаем esp8266

//Для esp8266
String ssid="Имя_сети";    // Имя сети WiFi
String password ="Пароль";  // Пароль сети WiFi
String id_device = "Секретный ключ девайся"; //Например "#fdsASd32"
boolean DEBUG=true; // Выводим отладочную информацию в сериал монитор.

//Частота работы цикла loop();
int time_worker = 20000; //10000 - раз в 10 секунд проходит цикл loop();

byte plants_water = 150; //Если земля сухая, то значение с гигрометра будет больше 150. 

//Работа с данными
/*
  * date[0] - значение с датчика температуры 1
  * date[1] - значение с датчика температуры 2
  * date[2] - значение с датчика температуры 3
  * date[4] - значение с датчика температуры 4
  * date[5] - значение с гигрометра 1
  * date[6] - значение с гигрометра 2
  * date[7] - значение с гигрометра 3
  * date[8] - значение с гигрометра 4
*/
float data[8];

//Функция ждет.
void showResponse(int waitTime){
    long t=millis();
    char c;
    while (t+waitTime>millis()){
      if (mySerial.available()){
        c=mySerial.read();
        if (DEBUG) Serial.print(c);
      }
    }
                   
}

void setup()
{
  Serial.begin(9600); //Для работы с монитором порта.

  pinMode(3, OUTPUT); //Пин с mosfet транзистором

  Serial.println("Initialization esp8266");
  //Все для esp8266
  mySerial.begin(112500);  
  delay(2000);
  //mySerial.println("AT+UART_CUR=9600,8,1,0,0");   
  delay(3000);
  mySerial.println("AT"); // Отправляем тестовую команду АТ в созданный порт, если всё работает в ответе должно прийти ОК
  mySerial.println("AT+CWMODE=1");
  showResponse(2000);
  mySerial.println("AT+RST");
  showResponse(2000);
  mySerial.println("AT+CWJAP=\""+ssid+"\",\""+password+"\"");  // set your home router SSID and password
  showResponse(2000);
  mySerial.println("AT+CIPMUX=0");
  showResponse(2000);
  //mySerial.println("AT+CIPSTART=\"TCP\",\"adscity.ru\",80");
  Serial.println("Start working esp8266!!!");
  showResponse(2000);
  //Все для esp8266 конец.


  //Все для DS18B20
  ds.begin(); //Инициализируем датчики.
    
  qty = ds.getDeviceCount(); //Ищем, сколько у нас датчиков на шине обнаружено.
  Serial.print("Found ");
  Serial.print(qty);
  Serial.println(" devices.");
  //Все для DS18B20 конец.

  //Обнуляем массив перед работой программы.
  for(int i = 0; i < 8; i++)
  {
    data[i] = 1024;
  }
}

//Функция отправляет запрос на сервер.
boolean sendData(float data[8]){
  
  String cmd = "AT+CIPSTART=\"TCP\",\"";                  // TCP подключение к серверу
  cmd += "sitename.ru";                               // адрес сайта, куда будет это все отправляться(например,adscity.ru);
  cmd += "\",80";
  mySerial.println(cmd);
  if (DEBUG) Serial.println(cmd);
  if(mySerial.find("Error")){
    if (DEBUG) Serial.println("AT+CIPSTART error");
    return false;
  }
  
  String getStr = "GET /name.php?";   // Начинаем формировать GET запрос. send.php - имя файла обработчика
  getStr +="id=";
  getStr +=id_device;
  getStr +="&";
  getStr +="temp1=";
  getStr += String(data[0]);

  for(int i = 1; i <= 3; i++)
  {
    getStr +="&temp";
    getStr +=String(i+1);
    getStr +="=";
    getStr +=String(data[i]);
  }

  for(int i = 4; i <= 7; i++)
  {
    getStr +="&hum";
    getStr +=String(i-3);
    getStr +="=";
    getStr +=String(data[i]);
  }

  getStr += " HTTP/1.1\r\nHost: sitename.ru\r\n\r\n"; //Не забудьте указать хост сайта.
  Serial.println(getStr);

  //количество байтов для отправки информации.
  cmd = "AT+CIPSEND=";
  cmd += String(getStr.length());
  mySerial.println(cmd);
  if (DEBUG)  Serial.println(cmd);
  
  delay(100);
  if(mySerial.find(">")){
    mySerial.print(getStr);
    if (DEBUG)  {
      Serial.print(getStr);
      showResponse(1000);
    }
  }
  else{
    //Закрываем соединение
    mySerial.println("AT+CIPCLOSE");
    if (DEBUG)   Serial.println("AT+CIPCLOSE");
    return false;
  }
  return true;
}

//Функция считывает значения с датчиков ds18b20, которые подключены на одну шину.
void ds18b20_reading()
{
  if (DEBUG) ds.requestTemperatures(); // считываем температуру с датчиков 
  
  for (int i = 0; i < qty; i++){ // крутим цикл 
    if(DEBUG)
    {
      Serial.print("Sensor DS18B20 ");
      Serial.print(i);
      Serial.print(": ");
      Serial.print(ds.getTempCByIndex(i)); // отправляем температуру
      Serial.println("C"); 
      Serial.println();
    }
    data[i] = ds.getTempCByIndex(i);
  } 
  
}

//Функция считывает влажность с датчиков.
void humid_reading()
{
  for (int i = 4; i <= 7; i++) // крутим цикл, считывания значения с датчиков
  {
      int hum_from_hygrometr = 0;
      hum_from_hygrometr = analogRead(i-4);
      if(DEBUG)
      {
          Serial.print("Sensor hygrometr ");
          Serial.print(i-3);
          Serial.print(": ");
          Serial.print(hum_from_hygrometr); // отправляем температуру со считанного датчика
          Serial.println("C"); 
          Serial.println();
      }
      if(hum_from_hygrometr == 0)
      {
        data[i] = 1024;
      }
      else
      {
        data[i] = hum_from_hygrometr;
      }
  }
}

void loop() 
{
  ds18b20_reading();
  humid_reading();
  sendData(data);

  //Проверяем необходим ли полив
  if(data[4] > plants_water and 
  data[5] > plants_water and
  data[6] > plants_water and
  data[7] > plants_water)
  {
    digitalWrite(3, HIGH);
    delay(800);
    digitalWrite(3, LOW);
  }
  
  delay(time_worker);
  //Обнуляем массив перед новой отправкой данных.
  for(int i = 0; i < 8; i++)
  {
    data[i] = 1024;
  }
}
