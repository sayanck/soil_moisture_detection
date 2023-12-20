# import serial
# import time
# from serial import Serial
import psychrolib
psychrolib.SetUnitSystem(psychrolib.SI)
# ser=serial.Serial("COM7",9600)
# while True:
    
#     returned_bit=ser.readline().decode()
#     # print(returned_bit)
#     x=1/float(returned_bit)
#     y=(34.19124187406271*x+0.0005668561656565901)*100
#     print("Moisture Value in percentage(gm/gm)"+str(y)+"%")
#     time.sleep(1)
class callibration:
    def LM393(self,bit):
        x=1/bit
        return ((34.19124187406271*x+0.0005668561656565901)*100)
    def soil_moist_cap(self,bit):
        x=1/bit
        return ((48.52090977909013*x-0.05851671548209939)*100)
#     def hum_temp_soil(self,rel_hum,temp):
#         Vap_press=psychrolib.GetVapPresFromRelHum(temp,rel_hum)
#         return Vap_press
# c=callibration()
# print(c.LM393(1022))
# while True:
#     temp=float(input("temp : "))
#     hum=float(input("hum : "))
#     hum=(hum/100)
#     print(hum,c.hum_temp_soil(temp=temp,rel_hum=hum))