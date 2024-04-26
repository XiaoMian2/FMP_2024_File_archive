# Import the required libraries
import re
import tkinter
import tkinter.messagebox
from operator import attrgetter


# Student ID detection
def check_student_id(wyz_stud_id):
    if re.match("^s[0-9]{7}$", wyz_stud_id, re.ASCII):
        return True
    else:
        return False

# Student category
class Student:
    def __init__(self, wyz_name, wyz_stud_id):
        try:
            self.wyz_name = wyz_name
            assert check_student_id(wyz_stud_id)
            self.wyz_stud_id = wyz_stud_id
        except AssertionError:
            tkinter.messagebox.showerror("Error", "Student number format is wrong")
            raise
            
            
# Locomotive number verification
def check_rego_number(wyz_rego_number):
    if re.match("^c[0-9]{7}$", wyz_rego_number, re.ASCII):
        return True
    else:
        return False

# Vehicle category
class Car:
    def __init__(self, wyz_rego_number, wyz_stud_object):
        try:
            assert check_rego_number(wyz_rego_number)
            self.wyz_rego_number = wyz_rego_number
            self.wyz_owner = wyz_stud_object
        except AssertionError:
            tkinter.messagebox.showerror("Error", "The vehicle registration number is incorrect")
            raise


# Student Management
class StudentManager:
    def __init__(self):
        self.wyz_stud_list = []

    def stud_register(self, wyz_stud_object):
        for s in self.wyz_stud_list:
            if s.wyz_stud_id == wyz_stud_object.wyz_stud_id:
                tkinter.messagebox.showerror("Error", "Student already exists")
                return False
        else:
            self.wyz_stud_list.append(wyz_stud_object)
            return True


# Vehicle management
class CarManager:
    def __init__(self):
        self.wyz_car_list = []

    def c_register(self, wyz_car_object):
        for car in self.wyz_car_list:
            if car.wyz_rego_number == wyz_car_object.wyz_rego_number:
                tkinter.messagebox.showerror("Error", "The vehicle has been registered!")
                return False
        else:
            self.wyz_car_list.append(wyz_car_object)
            return True


# Search by student ID
def search_studByID(wyz_stud_list, wyz_stud_id):
    for s in wyz_stud_list:
        match = re.match(wyz_stud_id.strip(), s.wyz_stud_id.strip())
        if match:
            return s
    else:
        return None
        
        
# Sort by student ID
def sort_stdByID(wyz_stud_list, reverse=False):
    wyz_stud_list.sort(key=attrgetter('wyz_stud_id'), reverse=reverse)
    return wyz_stud_list
    
    
# Student and vehicle management class instantiation
wyz_student_manager = StudentManager()
wyz_c_manager = CarManager()
wyz_s1 = Student("wyz_1", "s6371683")
wyz_student_manager.stud_register(wyz_s1)
wyz_s1_car1 = Car("c6243582", wyz_s1)
wyz_c_manager.c_register(wyz_s1_car1)
wyz_s2 = Student("wyz_2", "s8496131")
wyz_student_manager.stud_register(wyz_s2)
wyz_s2_car1 = Car("c8002805", wyz_s2)
wyz_c_manager.c_register(wyz_s2_car1)
wyz_s2_car2 = Car("c2223457", wyz_s2)
wyz_c_manager.c_register(wyz_s2_car2)
wyz_s3 = Student("wyz_3", "s1153706")
wyz_student_manager.stud_register(wyz_s3)
wyz_s3_car1 = Car("c5892447", wyz_s3)
wyz_c_manager.c_register(wyz_s3_car1)
wyz_s3_car2 = Car("c6509401", wyz_s3)
wyz_c_manager.c_register(wyz_s3_car2)
wyz_s3_car3 = Car("c2515416", wyz_s3)
wyz_c_manager.c_register(wyz_s3_car3)
wyz_s4 = Student("wyz_4", "s1638122")
wyz_student_manager.stud_register(wyz_s4)
wyz_s4_car1 = Car("c3402583", wyz_s4)
wyz_c_manager.c_register(wyz_s4_car1)
wyz_s4_car2 = Car("c6677834", wyz_s4)
wyz_c_manager.c_register(wyz_s4_car2)
wyz_s5 = Student("wyz_5", "s9326799")
wyz_student_manager.stud_register(wyz_s5)
wyz_s5_car1 = Car("c8988361", wyz_s5)
wyz_c_manager.c_register(wyz_s5_car1)
wyz_s5_car2 = Car("c8461502", wyz_s5)
wyz_c_manager.c_register(wyz_s5_car2)
wyz_s6 = Student("wyz_6", "s8937458")
wyz_student_manager.stud_register(wyz_s6)
wyz_s6_car1 = Car("c3156668", wyz_s6)
wyz_c_manager.c_register(wyz_s6_car1)
wyz_s7 = Student("wyz_7", "s6370163")
wyz_student_manager.stud_register(wyz_s7)
wyz_s7_car1 = Car("c4449979", wyz_s7)
wyz_c_manager.c_register(wyz_s7_car1)
wyz_s7_car2 = Car("c3108408", wyz_s7)
wyz_c_manager.c_register(wyz_s7_car2)
wyz_s7_car3 = Car("c9003319", wyz_s7)
wyz_c_manager.c_register(wyz_s7_car3)
wyz_s8 = Student("wyz_8", "s1404312")
wyz_student_manager.stud_register(wyz_s8)
wyz_s8_car1 = Car("c1148342", wyz_s8)
wyz_c_manager.c_register(wyz_s8_car1)
wyz_s8_car2 = Car("c2049844", wyz_s8)
wyz_c_manager.c_register(wyz_s8_car2)
wyz_s9 = Student("wyz_9", "s6886971")
wyz_student_manager.stud_register(wyz_s9)
wyz_s9_car1 = Car("c7897652", wyz_s9)
wyz_c_manager.c_register(wyz_s9_car1)
wyz_s10 = Student("wyz_10", "s7538364")
wyz_student_manager.stud_register(wyz_s10)
wyz_s10_car1 = Car("c5605246", wyz_s10)
wyz_c_manager.c_register(wyz_s10_car1)
wyz_s10_car2 = Car("c4588459", wyz_s10)
wyz_c_manager.c_register(wyz_s10_car2)


# Registered student information sorted by student ID
print(sort_stdByID(wyz_student_manager.wyz_stud_list))


# Register to respond to events
def register():
    wyz_name = wyz_e1.get()
    wyz_id = wyz_e2.get()
    wyz_rego_number = wyz_e3.get()
    
    if wyz_name == '' or wyz_id == '' or wyz_rego_number == '':
        tkinter.messagebox.showerror("Error", "All information cannot be empty")
        return False
    
    wyz_find = search_studByID(wyz_student_manager.wyz_stud_list, wyz_id)
    if wyz_find and wyz_find.wyz_name == wyz_name:
        try:
            wyz_new_car = Car(wyz_rego_number, wyz_find)
        except:
            return False
            
        if wyz_c_manager.c_register(wyz_new_car):
            tkinter.messagebox.showinfo("Registration successful", "Vehicle registration successful")
            return True
        else:
            return False
    elif wyz_find and wyz_find.wyz_name != wyz_name:
        tkinter.messagebox.showerror("Error", "Student number does not match student name")
        return False
    else:
        try:
            wyz_new_student = Student(wyz_name, wyz_id)
        except:
            return False
        
        if wyz_student_manager.stud_register(wyz_new_student):
            tkinter.messagebox.showinfo("Registration successful", "Student registration successful")
        else:
            return False
        
        try:    
            wyz_new_car = Car(wyz_rego_number, wyz_new_student)    
        except:
            return False
            
        if wyz_c_manager.c_register(wyz_new_car):
            tkinter.messagebox.showinfo("Registration successful", "Vehicle registration successful")
            return True
        else:
            return False
        
        
# GUI graphical interface design
wyz_root = tkinter.Tk()
wyz_root.title("wyz_Car_Registration")
wyz_root.resizable(width=False, height=False)

wyz_lb1 = tkinter.Label(wyz_root, text="wyz_Car_Registration", bg="darkorchid", fg="cornflowerblue", font=("Bold", 30))
wyz_lb1.grid(row=0, column=0, columnspan=4, pady=10, ipadx=10, ipady=10)

wyz_lb2 = tkinter.Label(wyz_root, text="wyz_Student Name", bg="lightsalmon", fg="aquamarine", font=("Bold", 15))
wyz_lb2.grid(row=1, column=1, padx=10, pady=10, ipadx=5, ipady=5)
wyz_e1 = tkinter.Entry(wyz_root, font=("normal", 13))
wyz_e1.grid(row=1, column=2, pady=10, ipadx=5, ipady=5)

wyz_lb3 = tkinter.Label(wyz_root, text="wyz_Student ID", bg="lightsalmon", fg="aquamarine", font=("Bold", 15))
wyz_lb3.grid(row=2, column=1, padx=10, pady=10, ipadx=5, ipady=5)
wyz_e2 = tkinter.Entry(wyz_root, font=("normal", 13))
wyz_e2.grid(row=2, column=2, pady=10, ipadx=5, ipady=5)

wyz_lb4 = tkinter.Label(wyz_root, text="wyz_Rego Number", bg="lightsalmon", fg="aquamarine", font=("Bold", 15))
wyz_lb4.grid(row=3, column=1, padx=10, pady=10, ipadx=5, ipady=5)
wyz_e3 = tkinter.Entry(wyz_root, font=("normal", 13))
wyz_e3.grid(row=3, column=2, pady=10, ipadx=5, ipady=5)

wyz_btn = tkinter.Button(wyz_root, text="wyz_Register", command=register, bg="darkred", fg="paleturquoise", font=("normal", 15))
wyz_btn.grid(row=4, column=1, columnspan=2, pady=10, ipadx=5, ipady=5)
wyz_root.mainloop()


