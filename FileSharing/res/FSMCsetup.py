import shutil
import os
import sys
from pathlib import Path
import win32com.client
import ctypes
from ctypes import wintypes
import uuid
import subprocess
import json
from tkinter import Tk, filedialog

def create_folder(folder_path):
    if not os.path.exists(folder_path):
        os.makedirs(folder_path)
        print("Folder created:", folder_path)
    else:
        print("Folder already exists.")
        
create_folder("C:\\xamppInstallers")
CONFIG_FILE = "C:\\xamppInstallers\\xampp_path.json"

def resource_path(relative_path):
    """Get absolute path to resource (works in .py and PyInstaller .exe)"""
    try:
        base_path = sys._MEIPASS  
    except Exception:
        base_path = os.path.abspath(".")

    return os.path.join(base_path, relative_path)

def save_path(path):
    with open(CONFIG_FILE, "w") as f:
        json.dump({"xampp_path": path}, f)

def load_path():
    if os.path.exists(CONFIG_FILE):
        with open(CONFIG_FILE, "r") as f:
            return json.load(f).get("xampp_path")
    return None

def check_common_location():
    default_path = "C:\\xampp"
    if os.path.exists(default_path):
        return default_path
    return None

def ask_user():
    print("XAMPP not found in default location please select true location.")
    user_has_xampp = input("Do you have XAMPP installed? (y/n): ").strip().lower()
    if user_has_xampp == "y":
        print("Please select your XAMPP folder...")
        subprocess.run(f"{resource_path('ask_user_for_path.exe')}",shell=True)
        folder = load_path()
        if os.path.exists(str(folder)+"\\xampp-control.exe"):
            save_path(folder)
            return folder
        else:
            return "2020"
    return None
def ask_user_for_path():
    path = ask_user()
    while(str(path) == "2020"):
        print("The location select is not true location\nplease select true location")
        path = ask_user()
    return path

def get_xampp_path():
    path = load_path()
    if path and os.path.exists(str(path)+"\\xampp-control.exe"):
        return path

    path = check_common_location()
    if os.path.exists(str(path)+"\\xampp-control.exe"):
        save_path(path)
        return path

    return ask_user_for_path()
    
# Use it


print("""
\n
\tMashallah this setup made by MUDRIK MOHD IDDI from SOB-SUZA ZANZIBAR
\tSetup name: FileSendMC
\tObject: To share file and text code between PC or phone
\tN.B:
\t1. After start install please don't close upto finish installation
\t2. After install this app used FileSendMC display in desktop for your control
\t3. For any promble find that know or this email mudrikmohdiddi@gmail.com
\n""")
mudrikCoder = input("Press to start installation::")
print("\n\n\t\tFileSendMC start install....")
print("5%\t\t:Find path")
def create_folder_shortcut(folder_path, shortcut_path):
    shell = win32com.client.Dispatch("WScript.Shell")
    shortcut = shell.CreateShortcut(shortcut_path)
    shortcut.TargetPath = folder_path
    shortcut.Save()
    
def get_actual_desktop_path():
    # Define the GUID structure
    class GUID(ctypes.Structure):
        _fields_ = [
            ("Data1", ctypes.c_ulong),
            ("Data2", ctypes.c_ushort),
            ("Data3", ctypes.c_ushort),
            ("Data4", ctypes.c_ubyte * 8)
        ]

        def __init__(self, guid_str):
            guid = uuid.UUID(guid_str)
            self.Data1 = guid.time_low
            self.Data2 = guid.time_mid
            self.Data3 = guid.time_hi_version
            self.Data4 = (ctypes.c_ubyte * 8).from_buffer_copy(guid.bytes[8:])

    # FOLDERID_Desktop GUID
    FOLDERID_Desktop = GUID('{B4BFCC3A-DB2C-424C-B029-7FE99A87C641}')
    path_ptr = ctypes.c_wchar_p()

    SHGetKnownFolderPath = ctypes.windll.shell32.SHGetKnownFolderPath
    SHGetKnownFolderPath.argtypes = [ctypes.POINTER(GUID), wintypes.DWORD, wintypes.HANDLE, ctypes.POINTER(ctypes.c_wchar_p)]

    result = SHGetKnownFolderPath(ctypes.byref(FOLDERID_Desktop), 0, None, ctypes.byref(path_ptr))
    if result != 0:
        raise ctypes.WinError(result)

    return path_ptr.value


def create_shortcut(shortcut_target,target_path, shortcut_name=None):
    shortcut_path = shortcut_target

    shell = win32com.client.Dispatch("WScript.Shell")
    shortcut = shell.CreateShortcut(str(shortcut_path))
    shortcut.TargetPath = str(target_path)
    shortcut.WorkingDirectory = str(Path(target_path).parent)
    shortcut.IconLocation = str(target_path)  # Optional: use target's icon
    shortcut.save()

    print(f"Shortcut created: {shortcut_path}")



exe_dir = get_xampp_path()

if(not exe_dir):
    xamppInt = resource_path("xamppInstaller")
    print("10%\t\t:Xampp install")
    shutil.copytree(xamppInt, "C:\\xamppInstallers", dirs_exist_ok=True)
    subprocess.run("C:\\xamppInstallers\\xampp-windows-x64-7.4.1-1-VC15-installer.exe",shell=True)
    
    while(not exe_dir):
        exe_dir = get_xampp_path()

#1
SendFile = resource_path("SendFile")

destination_SendFile = os.path.join(exe_dir, "htdocs\\SendFile")
shutil.copytree(SendFile, destination_SendFile, dirs_exist_ok=True)
print("15%\t\tSendFile install")
#2
fsmPY = resource_path("FileSendMC")
destination_fsmPY = exe_dir
shutil.copytree(fsmPY, destination_fsmPY, dirs_exist_ok=True)
print("30%\t\tFileSendMC install")
#3
welcomeHTML = resource_path("welcome")
destination_welcomeHTML = os.path.join(exe_dir, "htdocs")

shutil.copytree(welcomeHTML, destination_welcomeHTML, dirs_exist_ok=True)

print("45%\t\tWelecome install")
#4 
TP = resource_path("imageTP")
destination_TP = os.path.join(exe_dir, "htdocs\\SendFile\\profile")

shutil.copytree(TP, destination_TP, dirs_exist_ok=True)
print("60%\t\tBackground image install")
#5
desktop = get_actual_desktop_path()
desktop_fsmc = str(desktop)+"\\FileSendMC.lnk"
create_shortcut(desktop_fsmc,destination_fsmPY+"\\FileSendMC.exe", "FileSendMC.lnk")
print("75%\t\tCreate shortcut of FileSendMC")
#6
folder_path = os.path.join(exe_dir, "htdocs\\SendFile\\FileSendMC\\CoderMC")
create_folder(folder_path)
print("85%\t\tCreate CoderMC")
#7
create_folder_shortcut(folder_path,str(desktop)+"\\GroupMC.lnk")
print("90%\t\t:create shortcut of GroupMC")
print("FINISH")
subprocess.run(str(get_actual_desktop_path())+"\\FileSendMC.lnk",shell=True)
