<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileSendMC</title>
   
    <style>
        .savetext{
           
            width: 80%;
            font-size: xx-large;
           
            text-align: left;
            padding: 40px;
            color: blue;
        }
.editor-container {
    display: flex;
    width: 100%;
    margin: auto;
    background-color: cyan;
    border: 1px solid blue;
    border-radius: 10px;
    overflow: hidden;
}

.line-numbers {
    background-color: #f0f0f0;
    color: #888;
    padding: 10px;
    text-align: right;
    user-select: none;
    font-family: monospace;
    font-size: xx-large;
}

textarea.savetext {
    border: none;
    resize: none;
    width: 100%;
    height: 500px;
    font-family: monospace;
    padding: 10px;
    outline: none;
    overflow: scroll;
    font-size: xx-large;
}

        input,button,.selectText{
    
            width: 300px;
            height: 50px;
            border: 1px solid blue;
            font-size:medium;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 60px;
            color: blue;
        }
        
        .area{
            text-align: center;
           

        }
        
       
       
        .savetext2{
            border: 1px solid blue;
            font-size: large;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: left;
            padding: 10px;
            color: blue;
        }
       
       
        .writeName,.selectText{
            color: cyan;
            background-color: black;
          
        }
        body{
            background-color: pink;
        }
        #savetext{
      
            font-weight: bold;
            background-color: cyan;
           
        }
       #secrete{
        display: none;
       }
       .add2{
        position: fixed;
      
       }
       #menus{
        text-align: left;
        background-color: blue;
        width: fit-content;
        position: fixed;
       }
       .ndani{
        text-align: center;
       }
       .adv{
        text-align: center;
       }
       #otherEdit{
        display: none;
       }
       #dod,#copy,#menu{
        background-color: rgb(255, 255, 255,0.1);
        color: yellow;
       }
    </style>
    <script>
        function you3(){
            fetch("http://localhost/sendfile/you.php")
            .then(response => response.json())
            .then(data => {
                
            })
            .catch(error => {
               for(h of document.getElementsByClassName("forMe")){
                    h.style.display = "none";
                }
              
            });  
        }
        you3();
       
        function path(){
            document.getElementById("copyPath").style.backgroundColor = "yellow";
        navigator.clipboard.writeText(document.getElementById("pathC").textContent.trim()).then(() => {
        autoAlert("Copied: 🎉🎉" + document.getElementById("pathC").innerHTML+" 🎉🎉");
        }).catch(err => {
        autoAlert("Failed to copy:", err);
        });
        }
        
    </script>

</head>
<body>
   <p style="display: none;" id="pathC">
    <?php
    echo __DIR__."\Laha"
    ?>
   </p>
    <div id="otherEdit">otherEdit</div>
<div class="adv" id="adv">
<button class="forMe" id="copyPath" onclick="path()">Copy path</button>
<button class="forMe" onclick="notepad()" id="MYnotepad">Open in Notepad</button>
<button class="forMe" onclick="allowEdit()" id="allowEdit">Edit option</button>
<button class="forMe" onclick="vscode()" id="vscode">Open in vscode</button>

</div>
    
<p id="namemy" style="text-align: center; background-color: cyan;"></p> <p id="show" style="text-align: center; background-color: cyan;">🎉🎉🎉</p>  
<button id="menu" onclick="menu()" style="position: fixed;">OPEN MENU</button><br>
    
<?php

grtFolder("Laha");



function grtFolder($folder){
   
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
        if(file_exists($folder)){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return true;
    }
}

function scanFile($directory) {
    // Check if the directory exists
    if (!is_dir($directory)) {
        
        die("Directory does not exist.");
    }

    // Scan the directory
    $items = scandir($directory);
    $files = [];

    foreach ($items as $item) {
        // Ignore current (.) and parent (..) directories
        if ($item === '.' || $item === '..') {
            continue;
        }

        // Build full path
        $path = $directory . DIRECTORY_SEPARATOR . $item;

        // Check if it's a file
        if (is_file($path)) {
            $files[] = $item;
        }
    }

    return $files;
}

        
        function newname(){
            $option = "";
            $files = scanFile("Laha");
            foreach($files as $rows){
                $option .= '<option value="'.$rows.'">'.$rows.'</option>';
            }
            return $option;
        }

function newnumber(){
    $files = scanFile("Laha");
    return count($files);

}
       
?>
<p id="secrete">0</p> <br><br>

<div id="coc" style="position:fixed;">
<table align="center">
    <tr>
        <td>
            <button style="width: 150px; align-items: center;" id="copy" onclick="copyText()">Copy</button>
        </td>
        <td>
            <button style="width: 150px; align-items: center;" id="dod" onclick="dodText()">🧰dowl</button>
        </td>
    </tr>
</table>
 </div><br><br><br>
 <pre id="copysec" style="display: none;"></pre>
 <div id="menus">
 <div class="ndani">   

 <br>
<div class="btn" id="btn">
<table align="center">
    <tr>
        <td>
            <button style="width: 100px;" id="edit" onclick="editors()">EDIT</button>
        </td>
        <td>
            <button style="width: 100px;" id="open" onclick="open22()">Open</button>
        </td>
        <td>
            <a id="run"><Button id="run2" onclick="myRun2()" style="width: 100px;">RUN ⏯🏃‍♂️</Button></a>
        </td>
    </tr>
</table>
       
<br>
<br>

<div id="newname"></div>

    </select>
</div>

<br>

    
    
    <div class="add">
    <table align="center">
        <tr>
            <td>
                <button style="width: 200px;" onclick="add()" id="add">ADD</button>
            </td>
        </tr>
    
    </table>
    <br>
    <div id="afteradd">
    <input type="text" name="writeName" class="writeName" id="writeName" placeholder="🎉Write name of save text🎉" style="text-align: center;">
<br>
    </div>
    
    
    <div class="back" id="back">
        <a href="../../../../send.html"><button><=Back from upload</button></a>
    </div>
    <br>
    <a href="deletes.php" id="maba"><button style="background-color: red; color: cyan;">View or DELETE</button></a>
    
    </div> 
   <br>
   </div>
   </div>
    <div class="area" id="area">
        
    </div>
    

    <div id="secp" style="display: none;">
        <?php
        echo "../../../../profile/".scanFile("../../../../profile/")[0];
        ?>
    </div>
  <script>
    function updateLineNumbers() {
    const textarea = document.getElementById("savetext");
    const lineNumbers = document.getElementById("lineNumbers");
    let lines = textarea.value.split("\n").length;
    if(mobile()){
        y = Number((((lines * 222)/147)+"").split(".")[0])
        lines = y;
    }
    let numbers = "";
    for (let i = 1; i <= lines; i++) {
    numbers += i + "<br>";
    }
    lineNumbers.innerHTML = numbers;
}

function syncScroll() {
    const textarea = document.getElementById("savetext");
    const lineNumbers = document.getElementById("lineNumbers");
    lineNumbers.scrollTop = textarea.scrollTop;
}

// Call it initially in your `connection()` function



    var intervalId;
    function mynewname(){
    
    fetch("newname2.php")
    .then(response => response.json())
    .then(data =>{
        laha = '<select name="selectText" id="selectText" class="selectText" style="text-align: center;" onchange="myRun()"> <option value="">🎉Select saved text🎉</option>';
        document.getElementById("newname").innerHTML = laha + data;
    })
    .catch(error => console.error("Error:", error));
}
mynewname();
     function you2(){
            fetch("http://localhost/sendfile/you.php")
            .then(response => response.json())
            .then(data => {
                document.getElementById("maba").style.display = "black";
            })
            .catch(error => {
                sname = localStorage.getItem("sname");
                pname = localStorage.getItem("tname") || "coder";
                if(sname == pname){
                    document.getElementById("maba").style.display = "black";
                }
                else{
                    document.getElementById("maba").style.display = "none";
                    document.getElementById("maba").style.display = "none";
                }
               document.getElementById("allowEdit").style.display = "none";
               document.getElementById("vscode").style.display = "none";
               document.getElementById("MYnotepad").style.display = "none";
              
              
            });  
        }
        you2();
  
   
   document.getElementById("menus").style.display = "none";
        mL = 1;
        function menu(){
            if(mL == 0){
                document.getElementById("menus").style.display = "none";
                document.getElementById("menu").innerHTML = "OPEN MENU";
                this.mL = 1;

            }
            else{
                document.getElementById("menus").style.display = "block";
                document.getElementById("menu").innerHTML = "CLOSE MENU";
                this.mL = 0;
            }
        }
     function myname(){
            fetch("myname2.php")
            .then(response => response.json())
            .then(data => {
                data2 = data.split("*")[0];
                document.getElementById("namemy").innerHTML = "User: 🎉"+data2+"🎉";
               

            })
            .catch(error => console.error("Error:", error));
        }
        myname();
    function idadi(){
    fetch("idadi.php")
    .then(response => response.json())
    .then(data =>{
        namba1 = Number(document.getElementById("secrete").innerHTML);
        namba2 = Number(data);
        if(namba1 != namba2){
            document.getElementById("secrete").innerHTML = namba2;
            mynewname();
        }
    })
    .catch(error => console.error("Error:", error));
}
    function change(){
        idadi();
        val = document.getElementById("selectText").value;
        if(val){
            document.getElementById("edit").style.backgroundColor = "yellow";
            document.getElementById("open").style.backgroundColor = "yellow";
        }
        else{
            document.getElementById("edit").style.backgroundColor = "cyan";
            document.getElementById("open").style.backgroundColor = "cyan"; 
        }
    }
    function mobile(){
        return /Mobi|Android/i.test(navigator.userAgent);
    }
    function connection(){
    document.getElementById("area").innerHTML = `
<div class="editor-container">
    <div class="line-numbers" id="lineNumbers"></div>
    <textarea name="savetext" id="savetext" class="savetext form-control" rows="50" placeholder="Write text" onscroll="syncScroll()" oninput="updateLineNumbers()"></textarea>
</div>`;
  if(mobile()){
            document.getElementById("savetext").style.fontSize = "small";
            document.getElementById("savetext").style.padding = "5px";
           document.getElementsByClassName("line-numbers")[0].style.fontSize = "small";
           document.getElementsByClassName("line-numbers")[0].style.padding = "5px";
        }
        document.getElementById("savetext").disabled = true;
}
connection();

function fit(){
    need = document.getElementById("savetext");
    need.style.height = "auto";
    need.style.height = need.scrollHeight + "px";
}

function savetext(){
    let maneno = document.getElementById("savetext").value;
    let vals = document.getElementById("selectText").value;
    if(maneno && vals){
    formData = new FormData();
    formData.append("savemaneno", maneno);
    formData.append("savename", vals);
    
    fetch("manenosave.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        
    })
    .catch(error => {
        console.error("Error:", error)
    });
}
else{
    alert("Please write text or select name");
}
}


ch = 0;

function editors(){
    document.getElementById("copy").style.display = "none";
    document.getElementById("dod").style.display = "none";
    edit = document.getElementById("savetext");
    btn = document.getElementById("edit");
    select = document.getElementById("selectText").value;
    if(document.getElementById("selectText").value){
    if(ch == 0){
        
        btn.innerHTML = "SAVE";
        this.ch = 1;
        open22(3);
        document.getElementById("copy").style.display = "none";
        document.getElementById("dod").style.display = "none";
        edit.disabled = false;
        document.getElementById("selectText").disabled = true;
        document.getElementById("open").disabled = true;
    }
    else{
        
        edit.disabled = true;
        btn.innerHTML = "EDIT";
        this.ch = 0;
        savetext();
        document.getElementById("selectText").disabled = false;
        document.getElementById("open").disabled = false;
       // location.reload();
        connection();
    }
}
else{
    alert("Please 🎉 Select name first");
}
}
function add(){
    dataADD = document.getElementById("writeName").value;
    fetch("otherdivice.php?name="+this.dataADD)
    .then(response => response.json())
    .then(data => {
       
        alert(data);
       
    })
    .catch(error => {
        alert("No name write");
        
    });
    
    document.getElementById("afteradd").innerHTML = '<input type="text" name="writeName" class="writeName" id="writeName" placeholder="🎉Write name of save text🎉" style="text-align: center;">';
}

document.getElementById("copy").style.display = "none";
document.getElementById("dod").style.display = "none";

function open22(hala = 2){
    document.getElementById("savetext").value = "";
    document.getElementById("savetext").value = "";
    clearInterval(intervalId);
    valuess = document.getElementById("selectText").value;
if(valuess){
        document.getElementById("copy").style.display = "block";
        document.getElementById("dod").style.display = "block";
    fetch("open22.php?namesave="+this.valuess)
    .then(response => response.json())
    .then(data => {
        document.getElementById("savetext").value = data;
        
        fit();
        updateLineNumbers();
        document.getElementById("show").innerHTML = "🎉Open [ " + document.getElementById("selectText").value + "] 🎉";
        
    })
    .catch(error => {
        alert("No name select or connection error");
        
    });
//hala
if(hala == 2){
intervalId = setInterval(()=>{

    fetch("open22.php?namesave="+this.valuess)
    .then(response => response.json())
    .then(data => {
        const scrollY = window.scrollY;
        document.getElementById("savetext").value = data;
        fit();
        updateLineNumbers();
        window.scrollTo(0, scrollY);
    })
    .catch(error => {
        autoAlert("No name select or connection error");
    });

},1000);
}
else{
intervalId = setInterval(()=>{

    let maneno = document.getElementById("savetext").value;
    let vals = document.getElementById("selectText").value;
    if(vals){
    formData = new FormData();
    formData.append("savemaneno", maneno);
    formData.append("savename", vals);
    
    fetch("manenosave.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        
    })
    .catch(error => {
        console.error("Error:", error)
    });
}
else{
    alert("Please write text or select name");
}

},1000);
   

}

//hala  
}
else{
    alert("No name 🎉Select");
}
}
function copyText() {
    valuess2 = document.getElementById("selectText").value;
    if(valuess){
    fetch("open22.php?namesave="+this.valuess2)
    .then(response => response.json())
    .then(text => {
        navigator.clipboard.writeText(text).then(() => {
        alert("Copied: 🎉🎉" + document.getElementById("selectText").value+" 🎉🎉");
        }).catch(err => {
        console.error("Failed to copy:", err);
        });
    })
    .catch(error => {
        alert("No name select");
        
    });
  
}
  
}
function dodText() {
    valuess3 = document.getElementById("selectText").value;
    if(valuess){
        downloadFile("Laha/"+valuess3, valuess3);
        alert("🧰start download "+valuess3+" 🌐");
}
  
}

function downloadFile(url, filename) {
    a = document.createElement("a");
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

    setInterval(change,1000);

    function profile(){
                picha = document.getElementById("secp").innerHTML;
                document.body.style.backgroundImage = "url("+picha+")";
                document.body.style.backgroundPosition = "center";
                document.body.style.backgroundSize = "cover";

           
        }
        profile();
        function autoAlert(message, timeout = 2000,top = 20) {
            let alertBox = document.createElement("div");
            alertBox.innerHTML = message;
            alertBox.style.cssText = ` position: fixed;
            top: ${top}px;
            left: 50%;
            transform: translateX(-50%);
            background: green;
            color: cyan;
            font-size: large;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 1000; `;
            document.body.appendChild(alertBox);
            if(timeout != -2024){
                setTimeout(() => {
                alertBox.remove();
                }, timeout);
            }
            
            }
        function partFiles(){
               
               fetch("http://localhost/SendFile/partFile.php")
               .then(response => response.json())
               .then(data => {
                  autoAlert("Receiving file...<br>"+data);
                  nopart = 1;
                  partdata = data;
               })
               .catch(error => {
                   if(nopart === 1){
                       autoAlert("COMPLETE🎉🎉🎉 <br>"+partdata);
                       nopart = 2;
                       receive();
                   }
               });
           }
        setInterval(partFiles,1000);  
        allowEditNo = 0;
        //fetch("ZERO.php");
        document.getElementById("edit").style.display = "none";
        document.getElementById("writeName").style.display = "none";
        document.getElementById("add").style.display = "none";
        document.getElementById("open").style.width = "150px";
        document.getElementById("run2").style.width = "150px";
        
        function allowEdit(){
           
            if(allowEditNo == 0){
                allowEditNo = 1;
                fetch("ONE.php");
                document.getElementById("allowEdit").style.backgroundColor = "yellow";
                document.getElementById("allowEdit").innerHTML = "Allow Edit";
               
            }
            else{
                allowEditNo = 0;
                fetch("ZERO.php");
                document.getElementById("allowEdit").style.backgroundColor = "";
                document.getElementById("allowEdit").innerHTML = "Block Edit";
            }
          
        } 
      let newData = 0;
    function readEdit(){
        fetch("Redit.php?")
    .then(response => response.json())
    .then(data => {
    if(newData != data){
        if(data === "1"){
               
                document.getElementById("open").style.width = "100px";
                document.getElementById("run2").style.width = "100px";
                document.getElementById("edit").style.display = "block";
                document.getElementById("writeName").style.display = "block";
                document.getElementById("add").style.display = "block";
                document.getElementById("show").style.backgroundColor = "yellow";
               
        }
        else{
               
                document.getElementById("edit").style.display = "none";
                document.getElementById("writeName").style.display = "none";
                document.getElementById("add").style.display = "none";
                document.getElementById("open").style.width = "150px";
                document.getElementById("run2").style.width = "150px";
                document.getElementById("show").style.backgroundColor = "cyan";
        }
        newData = data;
    }
        
    })
    .catch(error => {
        
    });
    }
    setInterval(readEdit,1000);
      function vscode(){
        if(confirm("Do you sure need to open and edit CODE or TEXT in VSCODE")){
            document.getElementById("vscode").style.backgroundColor = "yellow";
            autoAlert("vscode was opened");
            fetch("vscode.php");
        }
        else{
            autoAlert("vscode cancel to open");
        }
      }
      function myRun(){
        document.getElementById("run2").style.backgroundColor = "yellow";
        document.getElementById("MYnotepad").style.backgroundColor = "yellow";
        document.getElementById("run").href = "Laha\\"+document.getElementById("selectText").value;
      }
      function myRun2(){
        if(!document.getElementById("selectText").value){
            autoAlert("Please select file than RUN!");
        }
      }
      function notepad(){
        if(!document.getElementById("selectText").value){
            autoAlert("Please select file than open notepad");
        }
        else{
            fetch("notepad.php?myfile="+ document.getElementById("selectText").value)
        }
      }
     function mytlt(){
      mytitle = (window.location.href).split("CoderMC/")[1].split("/")[0];
      while(mytitle.includes("%20")){
        mytitle = mytitle.replace("%20"," ");
      }
     //document.getElementsByTagName("title")[0].innerHTML = (window.location.href).split("CoderMC/")[1].split("/")[0].replace("%20"," ");
     document.getElementsByTagName("title")[0].innerHTML = mytitle;
    }
    mytlt();
     </script>  

</body>
</html>