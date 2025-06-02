import os
import time
import json
import tkinter as tk
from tkinter import filedialog, messagebox, ttk
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler
from openpyxl import Workbook
from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas

JSON_FILE = "file_map.json"

def load_file_map():
    if os.path.exists(JSON_FILE):
        with open(JSON_FILE, "r", encoding="utf-8") as f:
            return json.load(f)
    return {}

def save_file_map():
    with open(JSON_FILE, "w", encoding="utf-8") as f:
        json.dump(file_map, f, indent=4)

file_map = load_file_map()

class MultiFileHandler(FileSystemEventHandler):
    def __init__(self, file_map):
        self.file_map = file_map

    def on_modified(self, event):
        src_path = os.path.abspath(event.src_path)
        if src_path in self.file_map:
            try:
                with open(src_path, 'r', encoding='utf-8') as sf:
                    content = sf.read()
                dst_file = self.file_map[src_path]
                os.makedirs(os.path.dirname(dst_file), exist_ok=True)
                with open(dst_file, 'w', encoding='utf-8') as tf:
                    tf.write(content)
            except Exception as e:
                print(f"Error copying: {e}")

class App:
    def __init__(self, root):
        self.root = root
        self.root.title("📄 File Watcher App - By CoderMC")
        self.observer = None

        # Tree View
        self.tree = ttk.Treeview(root, columns=("src", "dst"), show="headings")
        self.tree.heading("src", text="Njia ya Chanzo")
        self.tree.heading("dst", text="Njia ya Faili la TXT")
        self.tree.pack(fill=tk.BOTH, expand=True, pady=5)

        self.update_tree()

        # Entry fields + buttons
        form = tk.Frame(root)
        form.pack(pady=10)

        tk.Label(form, text="Chanzo la Faili:").grid(row=0, column=0, sticky='e')
        self.src_entry = tk.Entry(form, width=90)
        self.src_entry.grid(row=0, column=1, padx=5)
        tk.Button(form, text="Browse", command=self.browse_src).grid(row=0, column=2)

        tk.Label(form, text="Folda ya TXT:").grid(row=1, column=0, sticky='e')
        self.dst_folder_entry = tk.Entry(form, width=90)
        self.dst_folder_entry.grid(row=1, column=1, padx=5)
        tk.Button(form, text="Browse", command=self.browse_dst_folder).grid(row=1, column=2)

        tk.Button(form, text="➕ Ongeza Mapping", command=self.add_mapping).grid(row=2, column=1, pady=5)

        # Action buttons
        btn_frame = tk.Frame(root)
        btn_frame.pack()

        tk.Button(btn_frame, text="➖ Futa Uliyochagua", command=self.remove_selected).grid(row=0, column=0, padx=5)
        tk.Button(btn_frame, text="📂 Fungua Folda ya TXT", command=self.open_txt_folder).grid(row=0, column=1, padx=5)
        tk.Button(btn_frame, text="▶️ Anza Kufuatilia", command=self.start_watching).grid(row=0, column=2, padx=5)

        tk.Button(btn_frame, text="💾 Excel", command=self.export_excel).grid(row=1, column=0, pady=5)
        tk.Button(btn_frame, text="📝 PDF", command=self.export_pdf).grid(row=1, column=1, pady=5)

    def update_tree(self):
        for i in self.tree.get_children():
            self.tree.delete(i)
        for src, dst in file_map.items():
            self.tree.insert("", tk.END, values=(src, dst))

    def browse_src(self):
        file_path = filedialog.askopenfilename(title="Chagua Faili la Chanzo")
        if file_path:
            self.src_entry.delete(0, tk.END)
            self.src_entry.insert(0, file_path)

    def browse_dst_folder(self):
        folder = filedialog.askdirectory(title="Chagua Folda ya TXT")
        if folder:
            self.dst_folder_entry.delete(0, tk.END)
            self.dst_folder_entry.insert(0, folder)

    def add_mapping(self):
        src = self.src_entry.get().strip()
        folder_dst = self.dst_folder_entry.get().strip()

        if not os.path.isfile(src):
            messagebox.showerror("Tatizo", "Faili la chanzo halipo.")
            return
        if not os.path.isdir(folder_dst):
            messagebox.showerror("Tatizo", "Folda ya lengo haipo.")
            return

        filename = os.path.splitext(os.path.basename(src))[0] + ".txt"
        dst = os.path.join(folder_dst, filename)
        file_map[os.path.abspath(src)] = dst
        save_file_map()
        self.update_tree()
        self.src_entry.delete(0, tk.END)
        self.dst_folder_entry.delete(0, tk.END)

    def remove_selected(self):
        selected = self.tree.selection()
        if not selected:
            messagebox.showwarning("Angalizo", "Chagua kifungu cha kufuta.")
            return
        for i in selected:
            values = self.tree.item(i)['values']
            src = values[0]
            if src in file_map:
                del file_map[src]
        save_file_map()
        self.update_tree()

    def open_txt_folder(self):
        selected = self.tree.selection()
        if not selected:
            messagebox.showwarning("Angalizo", "Chagua kifungu.")
            return
        dst_file = self.tree.item(selected[0])['values'][1]
        folder = os.path.dirname(dst_file)
        if os.path.exists(folder):
            os.startfile(folder)
        else:
            messagebox.showerror("Hitilafu", "Folda haipo.")

    def export_excel(self):
        path = filedialog.asksaveasfilename(defaultextension=".xlsx", filetypes=[("Excel files", "*.xlsx")])
        if not path:
            return
        wb = Workbook()
        ws = wb.active
        ws.title = "Mappings"
        ws.append(["Faili Chanzo", "Faili Lengo"])
        for src, dst in file_map.items():
            ws.append([src, dst])
        wb.save(path)
        messagebox.showinfo("Imefanikiwa", "Excel imehifadhiwa!")

    def export_pdf(self):
        path = filedialog.asksaveasfilename(defaultextension=".pdf", filetypes=[("PDF files", "*.pdf")])
        if not path:
            return
        c = canvas.Canvas(path, pagesize=letter)
        width, height = letter
        y = height - 40
        c.setFont("Helvetica-Bold", 14)
        c.drawString(30, y, "Orodha ya Mafaili Yanayofuatiliwa")
        y -= 30
        c.setFont("Helvetica", 10)
        for src, dst in file_map.items():
            if y < 50:
                c.showPage()
                y = height - 40
            c.drawString(30, y, f"{src[:90]}")
            c.drawString(30, y-12, f"=> {dst[:90]}")
            y -= 30
        c.save()
        messagebox.showinfo("Imefanikiwa", "PDF imehifadhiwa!")

    def start_watching(self):
        if self.observer and self.observer.is_alive():
            messagebox.showinfo("Inaendelea", "Watcher tayari inaendelea.")
            return
        paths = set(os.path.dirname(k) for k in file_map.keys())
        self.observer = Observer()
        for path in paths:
            self.observer.schedule(MultiFileHandler(file_map), path=path, recursive=False)
        self.observer.start()
        messagebox.showinfo("Watcher", "Watcher imeanza!")

if __name__ == "__main__":
    root = tk.Tk()
    app = App(root)
    root.mainloop()
