import serial
import time
import Callibrartion


f = open("save1.txt", "r")
l_t = f.readline()
f1 = open("save.txt", "r")
h_t = f1.readline()
l_t = float(l_t)
h_t =float(h_t)

f.close()
f1.close()

threshold = (l_t+h_t)/2
print(threshold)
x = []
cal=Callibrartion.callibration()

try:
    ser = serial.Serial("COM3", 9600)

    while True:
        f1 = open("kill.txt", "r")
        var = int(f1.readline())
        if var==1:
            data = ser.readline()
            data = data.decode()

            data = str(data)
            x = data.split(",")

            A = [float(x) for x in x]
            moist=cal.LM393(A[1])
            print(A,",",moist)
            f = open("soil_m.txt", "w")
            f.write(str(moist))
            f.close()
            dis = A[0]
            with open("cap_p1.txt","w") as f3:
                height = 14
                radious = 5.43
                capacity_of_well = 3.14*(radious**2)*(height)
                volume_of_well = 3.14*(radious*radious)*(height-dis)
                percent_filled =(volume_of_well/capacity_of_well*100)
                Percent_filled = str(percent_filled)
                print('Capacity of Water : ',percent_filled)
                f3.write(Percent_filled)

            if moist < threshold:
                ser.write(b'g')
                f = open("motor.txt", "w")
                f.write("0")
                f.close()
            else:
                ser.write(b'u')
                f = open("motor.txt", "w")
                f.write("1")
                f.close()
        else:
            exit()


except Exception as e:
    print(e)
