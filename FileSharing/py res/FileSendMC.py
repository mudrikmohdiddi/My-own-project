import subprocess
import tkinter as tk
import webbrowser
import time
from tkinter import messagebox
from PIL import Image, ImageTk
import sys
import os

def resource_path(relative_path):
    """ Get absolute path to resource, works for dev and for PyInstaller """
    try:
        # PyInstaller creates a temp folder and stores path in _MEIPASS
        base_path = sys._MEIPASS
    except Exception:
        base_path = os.path.abspath(".")

    return os.path.join(base_path, relative_path)

def set_fullscreen_background(window, image_path):
    """Sets a full-screen background image for a Tkinter window.

    Args:
        window: The Tkinter window object.
        image_path: The path to the image file.
    """

    try:
        # Open the image using PIL (Pillow)
        img = Image.open(image_path)

        # Get the screen dimensions
        screen_width = window.winfo_screenwidth()
        screen_height = window.winfo_screenheight()

        # Resize the image to fill the screen
        resized_img = img.resize((screen_width, screen_height), Image.Resampling.LANCZOS)

        # Convert the PIL image to a Tkinter PhotoImage
        bg_image = ImageTk.PhotoImage(resized_img)

        # Create a Label widget to display the image
        bg_label = tk.Label(window, image=bg_image)
        bg_label.place(x=0, y=0, relwidth=1, relheight=1) # place it to fill the whole window.

        # Keep a reference to the image to prevent garbage collection
        bg_label.image = bg_image

    except FileNotFoundError:
        print(f"Error: Image file not found at {image_path}")
    except Exception as e:
        print(f"An error occurred: {e}")

#webbrowser.open(url)
root = tk.Tk()
root.title("FileSendMC")
root.geometry("100000x100000")

image_path = resource_path("tp.png")
set_fullscreen_background(root, image_path)


def otherMC():
    web_path = resource_path("FileSendMC.html")
    webbrowser.open(web_path)

def is_service_running(service_name):
    try:
        output = subprocess.check_output("tasklist", shell=True).decode()
        return service_name in output
    except subprocess.CalledProcessError:
        return False
def msge():
    apache_running = is_service_running("httpd.exe")
    mysql_running = is_service_running("mysqld.exe")
    if(apache_running and mysql_running):
        btn.config(text = "Open FileSendMC",command=openfile,bg="yellow",fg="black")
        btn2.config(text = "Stop!",bg="black", state = tk.NORMAL,fg = "cyan")
        msg.config(text = "Wow mashaallah\ncan Open FileSendMC")
    elif(apache_running == False or mysql_running == False):
        btn.config(text = "Start",command=start,bg="black",fg="cyan")
        btn2.config(text = "Stop!",bg="yellow",fg="black",state = tk.DISABLED)
        msg.config(text = "Sorry can't Open FileSendMC\nplease start than open")


def stop():
    subprocess.run([r"xampp_stop.exe"], shell=True)
    msge()
    
def openfile():
    webbrowser.open("http://localhost/sendfile/welcome.html")

def start():
    subprocess.run([r"xampp_start.exe"], shell=True)
    msge()
def on_close():
    msg.config(text ="Please wait for close...")
    apache_running = is_service_running("httpd.exe")
    mysql_running = is_service_running("mysqld.exe")
    if messagebox.askyesno("Exit", "Are you sure you want to close the FileSendMC?"):
        if(apache_running == True or mysql_running == True):
            subprocess.run([r"xampp_stop.exe"], shell=True)
        root.destroy()
    else:
        msg.config(text ="Close canceled!")
        #msge()
btn4=tk.Button(text='Connect with other\n🎉FileSendMC🎉',font=('digital',12,'bold'),command=otherMC,fg='cyan',bg='blue',width=30,height=5)
btn4.place(x=300,y=0)

btn2=tk.Button(text='Stop',font=('digital',12,'bold'),command=stop,fg='cyan',bg='black',width=30,height=5)
btn2.place(x=0,y=150)

btn3=tk.Button(text='Refresh',font=('digital',12,'bold'),command=msge,fg='black',bg='pink',width=30,height=5)
btn3.place(x=0,y=0)

btn=tk.Button(text='Start',font=('digital',12,'bold'),command=start,fg='cyan',bg='black',width=30,height=5)
btn.pack(side="left")
msg=tk.Label(root,text="Open FileSendMC\nPlease wait...",font=('digital',25,'bold'),fg='cyan',bg='darkblue')
msg.pack(anchor='ne',ipadx=40, ipady=20)

msge()
root.protocol("WM_DELETE_WINDOW", on_close)
root.mainloop()
