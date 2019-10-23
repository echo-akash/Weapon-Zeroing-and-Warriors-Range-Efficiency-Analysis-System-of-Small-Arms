//Syntax for running in arduino to operate the machine which in return zero the weapon


#include<LiquidCrystal_I2C.h>
#include<Keypad.h>

LiquidCrystal_I2C lcd(0x27, 20, 4);

const byte ROWS = 4; //four rows
const byte COLS = 4; //three columns
char keys[ROWS][COLS] = {
  {'1', '2', '3', '+'},
  {'4', '5', '6', '-'},
  {'7', '8', '9', 'C'},
  {'*', '0', '#', 'D'}
};

byte rowPins[ROWS] = {4, 5, 6, 7};    //connect to the row pinouts of the keypad
byte colPins[COLS] = {8, 9, 10, 12};  //connect to the column pinouts of the keypad

Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );

int num;
int vertical_rotation = 0;
int horizontal_rotation = 0;

const int v_pwm = 26;
const int v_in_1 = 22;
const int v_in_2 = 23;

const int h_pwm = 27;
const int h_in_1 = 24;
const int h_in_2 = 25;

const int rotary_v1 = 2;
const int rotary_v2 = 3;
int v_state;
int v_state_last;

boolean flag = false;
void setup() {
  Serial.begin(9600);
  Serial1.begin(9600);
  lcd.begin();
  lcd.setCursor(4, 0);
  lcd.print("Welcome to IDP");
  lcd.setCursor(3, 1);
  lcd.print("   Project of");
  lcd.setCursor(6, 3);
  lcd.print("Group B-II");
  delay(3000);
  lcd.clear();

  lcd.print("To zero with ");
  lcd.setCursor(0, 1);
  lcd.print("BLUETOOTH press 1");
  lcd.setCursor(0, 2);
  lcd.print("Or Press 2 for ");
  lcd.setCursor(5, 3);
  lcd.print("KEYBOARD");
}

void loop() {
  char key = keypad.getKey();
  if (key) {
    lcd.clear();
    if (key == '1') {
//      lcd.print("Connect to App");
      bluetoothData();
    }

    else if (key == '2') {
      int x = UICorr();
      if (x == 0) {
        lcd.clear();
        lcd.setCursor(0, 2);
        lcd.print("******Success******");
      }

      else if (x == 1) {

        lcd.print("Somethng went wrong!!!!!");
      }

    }
  }
}
int bluetoothData(){
  lcd.print("Bluetooth connectd");
  
  char char_array_horizontal[3];
  char char_array_vertical[3];

  if (Serial1.available() > 0) {
          lcd.print("ok: ");

    int v = 0;
    int h = 0;
    while (Serial1.available() > 0) {
      char t = Serial1.read();
      lcd.print("Received: ");
      lcd.println(t);
      delay(10);
      if (t == '0' || t == '1' || t == '2' || t == '3' || t == '4' || t == '5' || t == '6' || t == '7' || t == '8' || t == '9') {
        char_array_horizontal[h] = t;
        h++;
        Serial.print("hor Received ");
        Serial.println(t);

      }
      else {
        while (Serial1.available() > 0) {
          Serial.println("In ver ");
          char t = Serial1.read();
          if (t == '0' || t == '1' || t == '2' || t == '3' || t == '4' || t == '5' || t == '6' || t == '7' || t == '8' || t == '9') {
            char_array_vertical[v] = t;
            v++;
            Serial.print("ver Received ");
            Serial.println(t);
            delay(10);
          }
        }

      }
    }

    horizontal_rotation = atoi(char_array_horizontal);
    vertical_rotation = atoi(char_array_vertical);
    lcd.clear();
    lcd.print("Hori Rot: ");
    lcd.print(horizontal_rotation);
    Serial.print("H rot");
    Serial.println(horizontal_rotation);
    Serial.print("v rot");
    Serial.println(vertical_rotation);
    lcd.setCursor(0, 1);
    lcd.print("Ver Rot: ");
    lcd.print(vertical_rotation);
    //      vertical_rotation = horizontal_rotation; ///for today to save skin

  }
  
}

int UICorr() {
  lcd.print("Vertical Correctn");
  lcd.setCursor(0, 1);
  int vertical_CORRECTION = GetNumber();
  vertical_rotation = (42 * vertical_CORRECTION) / 24;

  lcd.setCursor(0, 2);
  lcd.print("Horizontal Correctn");
  lcd.setCursor(0, 3);
  int horizontal_CORRECTION = GetNumber();
  horizontal_rotation = (42 * horizontal_CORRECTION) / 32;


  if (vertical_rotation != 0 || horizontal_rotation != 0) {
    zero_weapon();

  }

}

int GetNumber()
{
  int sign = 1;


  num = 0;
  char key = keypad.getKey();
  while (key != '#')
  {
    switch (key)
    {
      case NO_KEY:
        break;
      case '-':
        sign = -1;
        lcd.print(key);
        break;

      case '0': case '1': case '2': case '3': case '4':
      case '5': case '6': case '7': case '8': case '9':
        lcd.print(key);
        num = num * 10 + (key - '0');
        break;

      case '*':
        num = 0;
        lcd.clear();
        break;
    }

    key = keypad.getKey();
  }
  num = num * sign;

  return num;
}

int zero_weapon() {
  lcd.print("in zero");
  if (vertical_rotation != 0) {
    
    if (vertical_rotation > 0) {
      digitalWrite(v_in_1, LOW) ;
      digitalWrite(v_in_2, HIGH) ;
    }
    else {
      digitalWrite(v_in_1, HIGH) ;
      digitalWrite(v_in_2, LOW) ;
    }

    while (vertical_rotation != 0) {
      v_state = digitalRead(rotary_v1);

      if (v_state != v_state_last) {

        if (digitalRead(rotary_v2) != v_state) {
          vertical_rotation ++;
        }
        else {
          vertical_rotation --;
        }
        Serial.print("Position: ");
        Serial.println(vertical_rotation);
       // lcd.print("Position: ");
        lcd.println(vertical_rotation);
      }



      v_state_last = v_state;
    }
      digitalWrite(v_in_1, HIGH) ;
      digitalWrite(v_in_2, HIGH) ;
  }

  
      digitalWrite(h_in_1, LOW) ;
      digitalWrite(h_in_2, HIGH) ;
      delay(1000);
      
      digitalWrite(h_in_1, HIGH) ;
      digitalWrite(h_in_2, HIGH) ;
      return 0;
      
  
}
