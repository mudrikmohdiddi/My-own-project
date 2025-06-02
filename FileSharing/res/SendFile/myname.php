<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileSendMC</title>
    <style>
        #upload{
            padding: 30px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            display: inline-block;
            border-radius: 10px;
            animation: pop 1s alternate;
            text-align: center;
            
        }
        .upload{
            text-align: center;

        }
        @keyframes pop {
            0% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        input,button{
            width: 300px;
            height: 50px;
            border: 1px solid blue;
            font-size: large;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }
        #img{
            width: 300px;
            height: 300px;
            border: 1px solid blue;
            font-size: large;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }
    </style>
<?php
function name(){
$conn = new mysqli("localhost","root","");
$conn->query("create database if not exists nameDB");
$conn->select_db("nameDB");
$conn->query("create table if not exists nameTABLE(
ID int auto_increment primary key,
name varchar(200)
)");
$newname = '';
$r = $conn->query("select * from nameTABLE");
if($r->num_rows > 0){
      
    while($row = $r->fetch_assoc()){
       
        $newname =  $row["name"];
    }
    
}
$newname2 = explode("*",$newname);
return $newname2[0];
}
?>
</head>
<body>
<div class="upload">
    <div id="upload">
        <p id="rahisi" style="background-color:blue; width: fit-content; color: cyan; text-align: center;">
        <?php
$output = shell_exec("ipconfig");
//echo "<pre>{$output}</pre>";
$part1 = explode("Wi-Fi", $output);
$part2 = explode(": 192", $part1[1]);
if(!empty($part2[1])){
    $part3 = substr($part2[1],0,14);
    $part4 = str_replace("\n","m",$part3);
    $part5 = explode("m",$part4);
    $ip = "192".$part5[0];
    echo "EC code:<br>".$ip."/welcome.html";
}
?>
        </p>
        <h1>🎉FileSendMC🎉</h1>
        <a href="send.html"><button class="saveText"><= Back from upload?</button></a>
        
        <p>🎉Change your name🎉</p>
        
        <button id="setname" onclick="setname()">Reset name</button>
        <p id="phone"><?php echo name()?></p>
       
        <br>
        <?php
include("profile.php");
?>
        
    </div></div>
    <script>
       function rahis(){
        fetch("onlyip.php")
        .then(response => response.json())
        .then(data => {
        document.getElementById("rahisi").innerHTML = "EC:"+data+"welcome.html";

        })
        .catch(error => console.error("Error:", error));
       }
       rahis();
        mc = 0;
        function setname(){
            if(mc == 0){
                this.mc = 1;
                document.getElementById("phone").innerHTML = '<input type="text" id="name" placeholder="Enter name used">';
                document.getElementById("setname").innerHTML = 'Save name';
            }
            else{
                name = document.getElementById("name").value;
               

                    fetch("myname2.php?name="+this.name)
                    .then(response => response.json())
                    .then(data => {
                    sname = data.split("*")[1];
                    localStorage.setItem("sname",this.sname);

                    data2 = data.split("*")[0];
                    document.getElementById("phone").innerHTML = data2;

                    })
                    .catch(error => console.error("Error:", error));

                
                this.mc = 0;
                document.getElementById("setname").innerHTML = 'Reset name';
            }
        }
       
        function profile(){
            fetch("myprofile.php")
            .then(response => response.json())
            .then(data => {
                document.body.style.backgroundImage = "url('"+data+"')";
                document.body.style.backgroundPosition = "center";
                document.body.style.backgroundSize = "cover";

            })
            .catch(error => console.error("Error:", error));
        }
        profile();
        setInterval(backgroundChange,20000);
       
    </script>
</body>
</html>

