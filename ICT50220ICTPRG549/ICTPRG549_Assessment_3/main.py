# Import required libraries
import re
import tkinter
import tkinter.messagebox
import pymysql


# Locomotive number verification
def check_rn(wyz_rego_number):
    if re.match("^c[0-9]{7}$", wyz_rego_number, re.ASCII):
        return True
    else:
        return False

# for the vehicle system
class Car:
    def __init__(self, wyz_rego_number, wyz_std_obj):
        try:
            assert check_rn(wyz_rego_number)
            self.wyz_rego_number = wyz_rego_number
            self.wyz_owner = wyz_std_obj
        except AssertionError:
            tkinter.messagebox.showerror("error", "Incorrect vehicle registration code")
            raise


# studentsIDdetection
def check_sid(wyz_id):
    if re.match("^s[0-9]{7}$", wyz_id, re.ASCII):
        return True
    else:
        return False

# studentsclass
class Student:
    def __init__(self, wyz_std_name, wyz_id):
        try:
            self.wyz_std_name = wyz_std_name
            assert check_sid(wyz_id)
            self.wyz_id = wyz_id
        except AssertionError:
            tkinter.messagebox.showerror("error", "The student number format is incorrect")
            raise
            
            
# Vehicle management category
class CarManager:
    def __init__(self):
        self.wyz_car_list = []

    def car_register(self, wyz_c_obj):
        for car in self.wyz_car_list:
            if car.wyz_rego_number == wyz_c_obj.wyz_rego_number:
                tkinter.messagebox.showerror("error", "Vehicle has been registered！")
                return False
        else:
            self.wyz_car_list.append(wyz_c_obj)
            return True


# studentsmanagementclass
class StudentManager:
    def __init__(self):
        self.wyz_s_list = []

    def s_register(self, wyz_std_obj):
        for s in self.wyz_s_list:
            if s.wyz_id == wyz_std_obj.wyz_id:
                tkinter.messagebox.showerror("error", "studentsalready exists")
                return False
        else:
            self.wyz_s_list.append(wyz_std_obj)
            return True


# according tostudentsIDsort
def sort_id(wyz_s_list, reverse=False):
    return sorted(wyz_s_list, key=lambda x: x.get("wyz_id"), reverse=reverse)
    
    
# according tostudentsIDsearch
def search_studByID(wyz_id):
    wyz_connect = pymysql.connect(host="localhost", user="root", password="", database="wyz_mp_park",
                                  charset="utf8")
    wyz_cursor = wyz_connect.cursor(cursor=pymysql.cursors.DictCursor)
    wyz_sql = "select * from `wyz_student` where wyz_id = %s"
    wyz_cursor.execute(wyz_sql, [wyz_id])
    wyz_find = wyz_cursor.fetchone()
    if wyz_find is None:    
        return False
    else:
        return wyz_find
   
        
# main Database connection andstudentsdata query
wyz_connect = pymysql.connect(host="localhost", user="root", password="", database="wyz_mp_park", charset="utf8")
wyz_cursor = wyz_connect.cursor(cursor=pymysql.cursors.DictCursor)
wyz_sql = "select * from `wyz_student`"
wyz_cursor.execute(wyz_sql)
wyz_students = wyz_cursor.fetchall()

# according tostudentsIDsortRegisteredstudentsinformation
print(sort_id(wyz_students))


# Register to respond to events
def register():
    wyz_connect = pymysql.connect(host="localhost", user="root", password="", database="wyz_mp_park",
                                  charset="utf8")
    wyz_cursor = wyz_connect.cursor(cursor=pymysql.cursors.DictCursor)

    wyz_name = wyz_e1.get()
    wyz_id = wyz_e2.get()
    wyz_rego_number = wyz_e3.get()
    
    if wyz_name == '' or wyz_id == '' or wyz_rego_number == '':
        tkinter.messagebox.showerror("error", "All information cannot be blank")
        return False

    if not re.match("^s[0-9]{7}$", wyz_id, re.ASCII):
        tkinter.messagebox.showerror("error", "studentsNo. does not meet the requirements")
        return False

    if not re.match("^c[0-9]{7}$", wyz_rego_number, re.ASCII):
        tkinter.messagebox.showerror("error", "Vehicle number does not meet requirements")
        return False
    
    wyz_find_student = search_studByID(wyz_id)
    if wyz_find_student and wyz_find_student.get("wyz_std_name") == wyz_name:
        wyz_sql = "select * from `wyz_car` where wyz_rego_number = %s"
        wyz_cursor.execute(wyz_sql, [wyz_rego_number])
        wyz_find_car = wyz_cursor.fetchone()
        if wyz_find_car is None:
            wyz_sql = "insert into `wyz_car` values (%s, %s)"
            wyz_cursor.execute(wyz_sql, [wyz_rego_number, wyz_find_student.get("wyz_id")])
            wyz_connect.commit()
            tkinter.messagebox.showinfo("Registration is successful", "vehicleRegistration is successful")
            return True
        else:
            tkinter.messagebox.showerror("error", "Vehicle has been registered！")
            return False

    elif wyz_find_student and wyz_find_student.get("wyz_std_name") != wyz_name:
        tkinter.messagebox.showerror("error", "studentsnumber andstudentsName mismatch")
        return False
    else:
        wyz_sql = "select * from `wyz_car` where wyz_rego_number = %s"
        wyz_cursor.execute(wyz_sql, [wyz_rego_number])
        wyz_find_car = wyz_cursor.fetchone()
        if wyz_find_car is None:
            wyz_sql = "insert into `wyz_student` values (%s, %s)"
            wyz_cursor.execute(wyz_sql, [wyz_id, wyz_name])
            wyz_sql = "insert into `wyz_car` values (%s, %s)"
            wyz_cursor.execute(wyz_sql, [wyz_rego_number, wyz_id])
            wyz_connect.commit()
            tkinter.messagebox.showinfo("Registration is successful", "studentsRegistration is successful")
            tkinter.messagebox.showinfo("Registration is successful", "vehicleRegistration is successful")
            return True
        else:
            tkinter.messagebox.showerror("error", "Vehicle has been registered")
            return False
        
# GUIgraphical interface design
wyz_root = tkinter.Tk()
wyz_root.title("wyz_Car_Registration")
wyz_root.resizable(width=False, height=False)

wyz_lb1 = tkinter.Label(wyz_root, text="wyz_Car_Registration", bg="coral", fg="darkmagenta", font=("Bold", 30))
wyz_lb1.grid(row=0, column=0, columnspan=4, pady=10, ipadx=10, ipady=10)

wyz_lb2 = tkinter.Label(wyz_root, text="wyz_Student Name", bg="papayawhip", fg="palegoldenrod", font=("Bold", 15))
wyz_lb2.grid(row=1, column=1, padx=10, pady=10, ipadx=5, ipady=5)
wyz_e1 = tkinter.Entry(wyz_root, font=("normal", 13))
wyz_e1.grid(row=1, column=2, pady=10, ipadx=5, ipady=5)

wyz_lb3 = tkinter.Label(wyz_root, text="wyz_Student ID", bg="papayawhip", fg="palegoldenrod", font=("Bold", 15))
wyz_lb3.grid(row=2, column=1, padx=10, pady=10, ipadx=5, ipady=5)
wyz_e2 = tkinter.Entry(wyz_root, font=("normal", 13))
wyz_e2.grid(row=2, column=2, pady=10, ipadx=5, ipady=5)

wyz_lb4 = tkinter.Label(wyz_root, text="wyz_Rego Number", bg="papayawhip", fg="palegoldenrod", font=("Bold", 15))
wyz_lb4.grid(row=3, column=1, padx=10, pady=10, ipadx=5, ipady=5)
wyz_e3 = tkinter.Entry(wyz_root, font=("normal", 13))
wyz_e3.grid(row=3, column=2, pady=10, ipadx=5, ipady=5)

wyz_btn = tkinter.Button(wyz_root, text="wyz_Register", command=register, bg="yellowgreen", fg="tomato", font=("normal", 15))
wyz_btn.grid(row=4, column=1, columnspan=2, pady=10, ipadx=5, ipady=5)
wyz_root.mainloop()


