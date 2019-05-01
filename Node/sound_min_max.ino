#define MicSamples (1024*2)
#define MicPin A0
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <FirebaseArduino.h>
#include <ESP8266Ping.h>
#include<string.h>
int randNumber;

//--------------------------------------------------edit this as the node changes

char host[50]= "esp8266-5608d.firebaseio.com";
char auth[50]="your api key";
char  ssid[20]="ssid_name";
char  passwd[20]="password";
String url="http://noise99.000webhostapp.com/log.php";
String node="node1";

//--------------------------------------------------

int sleep=0;
int button = 0;
float light = 0.0;
void(* resetFunc) (void) = 0; 
int db;
char  ssid_new[20];
char  passwd_new[20];
String s,p;
const int grovePowerPin = 15;
const int vibratorPin = 5;
const int lightSensorPin = A0;
const int ledPin = 12;
const int buttonPin = 14;
const int fanPin = 13;
void setup() 
{
	Serial.begin(115200);
	  pinMode(D0, OUTPUT);
     pinMode(D3, OUTPUT);
 digitalWrite(D0, HIGH);
  digitalWrite(D3, LOW);
	// connect to wifi.
	WiFi.begin(ssid,passwd);
	Serial.print("connecting to ");
	Serial.print(ssid);
	while (WiFi.status() != WL_CONNECTED) 
	{
		Serial.print(".");
		delay(500);
	}
	Serial.println();
	Serial.print("connected: ");
	Serial.println(WiFi.localIP());
	Serial.print("Pinging host ");
	Serial.println("www.google.com");

	if(Ping.ping("www.google.com")) 
	{
		Serial.println("Success!!");
	}
	else 
	{
		Serial.println("Error :( in setup");
    fireconnect();
		return;
	}
	Firebase.begin(host, auth);
	Firebase.setString("/"+node+"/responce","online");
	Firebase.set("/"+node+"/change", 0);
	Firebase.set("/"+node+"/status", 0);
	//Firebase.set("/"+node+"/ssid", 0);
	//Firebase.set("/"+node+"/passwd", 0);
	Firebase.set("/"+node+"/list", 0);
}
void fireconnect()
{
    s=Firebase.getString("/"+node+"/ssid");
    p=Firebase.getString("/"+node+"/passwd");
    Firebase.setInt("/"+node+"/change",0);
    Firebase.setInt("/"+node+"/status", 22);
  
    s.toCharArray(ssid_new,20);
    p.toCharArray(passwd_new,20);
    setup1();
}
void setup1()
{
	// connect to wifi.

	WiFi.begin(ssid_new,passwd_new);
	Serial.print("connecting to ");
	Serial.print(ssid_new);
	while (WiFi.status() != WL_CONNECTED) 
	{
		Serial.print(".");
		delay(500);
	}
	Serial.println();
	Serial.print("connected: ");
	Serial.println(WiFi.localIP());
	Serial.print("Pinging host ");
	Serial.println("www.google.com");

	if(Ping.ping("www.google.com")) 
	{
		Serial.println("Success!!");
		Firebase.begin(host, auth);
		Firebase.setString("/"+node+"/responce","online");
		Firebase.set("/"+node+"/change", 0);
		Firebase.set("/"+node+"/status", 0);
		//Firebase.set("/"+node+"/ssid", 0);
		//Firebase.set("/"+node+"/passwd", 0);
		Firebase.set("/"+node+"/list", 0);
		return;
	} 
	else 
	{
		Serial.println("Error :( on new ap ");
		Serial.print(ssid_new);
		setup();
		return;
	}
}

int mini(int a,int b)
{
	if(a<b) return a;
	else return b;
}
int maxi(int a,int b)
{
	if(a>b) return a;
	else return b;
}
void loop() 
{

	if(Firebase.getInt("/"+node+"/change")==1)
	{
		switch(Firebase.getInt("/"+node+"/status"))
		{
			case 1:
				Firebase.setInt("/"+node+"/status", 22);
				resetFunc();
				setup();
				break;
			case 2:
				//connect to ssid and password
				Firebase.setInt("/"+node+"/status", 22);
				s=Firebase.getString("/"+node+"/ssid");
				p=Firebase.getString("/"+node+"/passwd");
				Firebase.setInt("/"+node+"/change",0);
				Firebase.setInt("/"+node+"/status", 22);
				Firebase.setInt("/"+node+"/ssid",0);
				Firebase.setInt("/"+node+"/passwd", 0);
				s.toCharArray(ssid_new,20);
				p.toCharArray(passwd_new,20);
				setup1();
				Serial.print("Pinging host ");
				Serial.println("www.google.com");

				if(Ping.ping("www.google.com")) 
				{
					Serial.println("Success!!");
				} 
				else 
				{
					Serial.println("Error :(");
					setup1();
					s=s+" not connected to internet";
					Firebase.setString("/"+node+"/responce",s);
				}
				break;
			case 3:
				//get status if on or of set status to 1 and change to 1
        if(sleep==1)
        {
          Firebase.setString("/"+node+"/responce","sleep");
        } 
        else
        {
				  Firebase.setString("/"+node+"/responce","online");
        }
				Firebase.setInt("/"+node+"/change",0);
				Firebase.setInt("/"+node+"/status", 22);
				break;

      case 5:
        //get status if on or of set status to 1 and change to 1
        Firebase.setString("/"+node+"/responce","Sleeping");
        Firebase.setInt("/"+node+"/change",0);
        sleep=1;
         digitalWrite(D3, HIGH);
        break;
      case 6:
        //get status if on or of set status to 1 and change to 1
        Firebase.setString("/"+node+"/responce","online");
        Firebase.setInt("/"+node+"/change",0);
        Firebase.setInt("/"+node+"/status", 22);
        sleep=0;
        digitalWrite(D3, LOW);
        break;     

			case 4:
				//get list of available wifi status code 4
    				String list="";
    				WiFi.mode(WIFI_STA);
    				WiFi.disconnect();
    				delay(100);
    				Serial.println("scan mode on");
    				Serial.println("scan start");
    				// WiFi.scanNetworks will return the number of networks found
    				int n = WiFi.scanNetworks();
    				Serial.println("scan done");
    				if (n == 0)
    				{
    					Serial.println("no networks found");
    					list="no networks found";
    				}
    				else
    				{
    					Serial.print(n);
    					Serial.println(" networks found");
    					for (int i = 0; i < n; ++i)
    					{
    						// Print SSID and RSSI for each network found
    						Serial.print(i + 1);
    						Serial.print(": ");
    						Serial.print(WiFi.SSID(i));
    						list=list+"["+WiFi.SSID(i)+"]";
    						Serial.print(" (");
    						Serial.print(WiFi.RSSI(i));
    						Serial.print(")");
    						Serial.println((WiFi.encryptionType(i) == ENC_TYPE_NONE)?" ":"*");
    						delay(10);
    					}
    				}
    				Serial.println("");
    
    				// Wait a bit before scanning again
    				delay(5000);
    				setup();
    				Firebase.setString("/"+node+"/list",list);
    				Firebase.setInt("/"+node+"/change",0);
    				Firebase.setInt("/"+node+"/status", 22);
				break;

		}
	}
  if(sleep != 1)
  {
  	long signalAvg = 0, signalMax = 0, signalMin = 1024, t0 = millis();
  	for (int i = 0; i < MicSamples; i++)
  	{
  		int k = analogRead(MicPin);
  		signalMin = mini(signalMin, k);
  		signalMax = maxi(signalMax, k);
  		signalAvg += k;
  	}
  	signalAvg /= MicSamples;
  
  	// print
  	//Serial.print("Time: " + String(millis() - t0));
  	//Serial.print(" Min: " + String(signalMin));
  	//Serial.print(" Max: " + String(signalMax));
  	//Serial.print(" Avg: " + String(signalAvg));
  	//Serial.print(" Span: " + String(signalMax - signalMin));
  	//Serial.print(", " + String(signalMax - signalAvg));
  	//Serial.print(", " + String(signalAvg - signalMin));
  	db=20*log10((signalMax-signalMin)/0.2);
  	//db=23*log10(signalAvg/3.3);
  	//Serial.println(signalAvg);
  	Serial.println(db);
  	//Serial.println(signalMax-signalMin);
  
  	if(WiFi.status()== WL_CONNECTED)
  	{   
  		//Check WiFi connection status
  		HTTPClient http;    //Declare object of class HTTPClient
  		//int sensorValue = analogRead(A0);
  		randNumber=signalMax-signalMin;
      digitalWrite(D0, LOW);
  		http.begin(url+"?id="+node+"&d="+String(db));      //Specify request destination
  		//delay(3000);  //Send a request every 30 seconds
  		http.addHeader("Content-Type", "text/plain");  //Specify content-type header
  		int httpCode = http.POST("Message from ESP8266");   //Send the request
  		String payload = http.getString();                  //Get the response payload
  		Serial.println(httpCode);   //Print HTTP return code
  		Serial.println(payload);    //Print request response payload
  		http.end();  //Close connection
     digitalWrite(D0, HIGH);
  	}
  	else
  	{
  		Serial.println("Error in WiFi connection");   
  	}
  }
    else
   {
      Serial.println("node1 sleeping");   
    }
}
