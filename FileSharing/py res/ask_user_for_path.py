import json
from tkinter import Tk, filedialog
import os

CONFIG_FILE = "C:\\xamppInstallers\\xampp_path.json"

def save_path(path):
    with open(CONFIG_FILE, "w") as f:
        json.dump({"xampp_path": path}, f)

root = Tk()
root.withdraw()# Hide the GUI

folder = filedialog.askdirectory(title="Select XAMPP Folder")
if folder:
    save_path(folder)
