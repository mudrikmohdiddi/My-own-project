<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileSendMC</title>
    <style>
    .savetext{
           
            
            border: 1px solid cyan;
            font-size: large;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 40px;
            text-align: center;
           
            color: blue;
        }
        input,button,.selectText{
    
            width: 300px;
            height: 50px;
            border: 1px solid blue;
            font-size: large;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 60px;
            color: blue;
        }
       #secrete{
        display: none;
       }
    </style>
<?php
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
            $no = 0;
            $option = "";
            $files = scanFile("Laha");
            foreach($files as $rows){
                $no ++;
                $option .= '<li><a href="Laha/'.$rows.'">'.$rows.'</a><input type="checkbox" value="'.$rows.'" name="" id="'.$no.'"><hr></li><br>';
            }
            return $option;
        }



?>
</head>
<body onchange="select()">
        
        <div class="savetext">
        <p id="namemy"></p>
           <p>🎉Delete your text🎉</p>
            <a href="saveText.php"><button><=Back form Text</button></a>
            <br><br>
            <button style="background-color: red; color: cyan; position: fixed;left:9% " onclick="deletesText()" id="maba">Delete</button><br><br><br><br>
            Select all <input type="checkbox" name="" id="selall" onchange="unselect()">
            <ol>
                <div id="newname"></div>
            </ol>
        </div>
        <p id="test"></p>
        <p id="secrete">0</p>
    <div id="secp" style="display: none;">
    <?php
    echo "../../../../profile/".scanFile("../../../../profile/")[0];
    ?>
    </div>
   <script>
    
    function you2(){
            fetch("http://localhost/sendfile/you.php")
            .then(response => response.json())
            .then(data => {
                
                document.getElementById("maba").style.display = "black";
                
            })
            .catch(error => {8
                sname = localStorage.getItem("sname");
                pname = localStorage.getItem("tname") || "coder";
                if(sname == pname){
                    document.getElementById("maba").style.display = "black";
                }
                else{
                    document.getElementById("maba").style.display = "none";
                }
               
            });  
        }
        you2();
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
        
    function unselect(){
        selall = document.getElementById("selall").checked;
        if(!selall){
            num = Number(document.getElementById("secrete").innerHTML);
            for( z = 1; z <= num; z++){
                document.getElementById(""+z).checked = false;
                this.hay = 1;
            }
        }
    }
    hay = 0;
    function select(){
       
        selall = document.getElementById("selall").checked;
        num = Number(document.getElementById("secrete").innerHTML);
        if(num == nosel() && this.hay == 0){
            document.getElementById("selall").checked = true;
            for( z = 1; z <= num; z++){
                document.getElementById(""+z).checked = true;
            }
            this.hay = 1;
        }
        
        else{
            if(selall && this.hay != 1){
            for( z = 1; z <= num; z++){
                document.getElementById(""+z).checked = true;
                this.hay = 1;
            }
        }
        if(num != nosel() && this.hay == 1){
            document.getElementById("selall").checked = false;
            this.hay = 0;
        }
    }
     
    }
  
    function nosel(){
        num = Number(document.getElementById("secrete").innerHTML);
        numb = 0;
        for( z = 1; z <= num; z++){
           sel = document.getElementById(""+z).checked;
           if(sel){
            numb ++;
           }
        }
        return numb;
}

function deletesText(){
    numbers = Number(document.getElementById("secrete").innerHTML);
    ddel = '\n';
    for(nom = 1;nom <= numbers;nom++){
        if(document.getElementById(""+nom+"").checked){
            ddel += (nom)+". "+document.getElementById(""+nom+"").value+"😢\n";
        }
    }
    let respond = confirm("Do you want delete😢 this file😢😢"+ddel);
    if(respond){
    ///
    ourdata = "";
    num = Number(document.getElementById("secrete").innerHTML);
    for(m = 1; m <= num;m++){
        sl = document.getElementById(""+m).checked
        sv = document.getElementById(""+m).value;
        if(sl){
            ourdata += (m)+". "+sv+" Text successfull delete!\n";
            formData = new FormData();
            formData.append("deletename",sv);
            
            fetch("deletes2.php", {
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
    

    }
    if(ourdata){
        alert(ourdata);
    }
    else{
        alert("Not select text🎉");
    }
}
else{
    alert("Wow🎉 for cancel delete file🎉🎉");
}
mynewname();
}
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
function mynewname(){
    
    fetch("newname.php")
    .then(response => response.json())
    .then(data =>{
        document.getElementById("newname").innerHTML = data;
    })
    .catch(error => console.error("Error:", error));
}
mynewname();
setInterval(idadi,1000);


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
        //document.getElementsByTagName("title")[0].innerHTML = (window.location.href).split("CoderMC/")[1].split("/")[0].replace("%20"," ");
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