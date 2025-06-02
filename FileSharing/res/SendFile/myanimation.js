function table(){
    this.choice = document.getElementById("option").value;
    localStorage.setItem("saveChoice",this.choice);
    
}
function mine(){
    fetch("ipaddress.php")
    .then(response => response.json())
    .then(data => {
        tname = data.split("*")[1];
        localStorage.setItem("tname",tname);
       
        
    })
    .catch(error => console.error("Error:", error)); 
}
mine();
function you(){
    fetch("http://localhost/sendfile/you.php")
    .then(response => response.json())
    .then(data => {
        document.getElementById("delete2").style.display = "black";
    })
    .catch(error => {
        mine();
        sname = localStorage.getItem("sname");
        pname = localStorage.getItem("tname") || "coder";
        if(sname == pname){
            document.getElementById("delete2").style.display = "black";
        }
        else{
            document.getElementById("delete2").style.display = "none";
        }
        
    });  
}

function mobile(){
    return /Mobi|Android/i.test(navigator.userAgent);
}
function splitname(dataName){
    newName = "";
    noname = 0;
    for(n = 0; n < dataName.length;n++){
        newName += dataName[n];
        if(noname >= 16){
            newName += "<br>";
            noname = 0;
        }
        noname ++;
    }
    if(mobile()){
        return newName;
    }
    else{
        return dataName;
    }
   
}

function connected(){
    
    fetch("ipaddress.php")
    .then(response => response.json())
    .then(data => {
       
        data2 = data.split("*")[0];

        document.getElementById("connect").innerHTML = data2+"</small>";
        
    })
    .catch(error => console.error("Error:", error)); 
}


let saveChoice = localStorage.getItem("saveChoice");
choice = saveChoice || "🎉🎉";
function add(){
    autoAlert("Click add");
    dataADD = document.getElementById("writedata").value;
    fetch("createGroup.php?group="+this.dataADD)
    .then(response => response.json())
    .then(data => {
       
        dd = '<select onchange="table()" id="option">';
        dd += '<option value="">🎉Select group🎉</option>';
        numb = 0;
        added = "Datas added<br>";
        
        for(datas of data){
           // name = datas;
            
            dd += '<option value="'+datas+'">"'+datas+'"</option>';
            this.numb ++;
            this.added += datas+"<br>";
        }
        dd += '</select>';
        document.getElementById("choose").innerHTML = dd;
        document.getElementById("secrete3").innerHTML = numb;

        if(numb == 0){
            autoAlert("No groups added!",4000);
        }
        else{
            autoAlert(this.added);
        }
        
    })
    .catch(error => console.error("Error:", error)); 
    document.getElementById("writedata").value = "";  
}
function add2(){
    dataADD = "";
    fetch("createGroup.php?group="+this.dataADD)
    .then(response => response.json())
    .then(data => {
        numb2 = 0;
        for(datas of data){
            this.numb2 ++;
        }
        document.getElementById("secrete4").innerHTML = numb2;
        
    })
    .catch(error => console.error("Error:", error));
}



////
function upload(file,group) {
    const chunkSize = 1 * 1024 * 1024; // 1MB per chunk
    const totalChunks = Math.ceil(file.size / chunkSize);
    let currentChunk = 0;

    function sendNextChunk() {
        if (currentChunk >= totalChunks) {
            autoAlert("Upload complete");
            document.getElementById('send').innerHTML = '<input type="file" id="fileInput" multiple>';
            return;
        }

        let start = currentChunk * chunkSize;
        let end = Math.min(start + chunkSize, file.size);
        let chunk = file.slice(start, end);

        let formData = new FormData();
        formData.append("file", chunk);
        formData.append("chunkIndex", currentChunk);
        formData.append("totalChunks", totalChunks);
        formData.append("fileName", file.name);
        formData.append("group",group);

        fetch("upload.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(data == "mmmm"){
                currentChunk = totalChunks;
            }
            else{
                currentChunk++;
            }
           
                autoAlert(data);
                sendNextChunk(); // Send next chunk
            
           
        })
        .catch(error => console.error("Error:", error));
    }

    sendNextChunk(); // Start upload
}


////

function uploadFile() {
    let fileInput = document.getElementById('fileInput').files;

    let file = fileInput;

    if (file.length === 0 || this.choice.length == 0) {
        autoAlert("Please choose a file and group");
        return;
    }
    
    for(s = 0;s < file.length;s++){
       upload(file[s],this.choice);
}
}

function extention(NameFile){
   
    const browserFileExtensions = [
        // Web Files
        ".html", ".htm",".php",
      
        // Image Files
        ".jpeg", ".jpg", ".png", ".gif", ".bmp", ".webp", ".svg","webp",
      
        // Video Files
        ".mp4", ".webm", ".ogg",
      
        // Audio Files
        ".mp3", ".wav", ".ogg", ".aac",".m4a",
      
        // Document Files
        ".txt", ".xml", ".json",".pdf"
      
      ];
      lat = false;
      if(mobile()){
        browserFileExtensions.pop();
      }
      for(br of browserFileExtensions){
        NameFile = NameFile.toLowerCase();
        if(NameFile.endsWith(br)){
            lat = true;
        }
      }
      if(lat){
        return 'a';
      }
      else{
        if(!NameFile.includes(".")){
            if(mobile()){
                return 'p';
            }
            else{
                return 'a';
            }
            
        }
        else{
            return 'p';
        }
       
      }
       
      
      
}

///
arg = "unsort";
function arrange(){
    if(arg == "unsort"){
        this.arg = "reverse";
        receive();
        document.getElementById("accending").innerHTML = "Reverse";
        
       
}
else{
    this.arg = "unsort";
    receive();
    document.getElementById("accending").innerHTML = "Default";
    
        
}
    
}
///
isAudioFile2 = false;
isVideoFile2 = false;
function receive(){
    document.getElementById("audioBTN2").style.display = 'none';
    document.getElementById("videoBTN2").style.display = 'none';
    fetch("receive.php?group="+this.choice+"&arrange="+this.arg)
    .then(response => response.json())
    .then(data =>{
      
        isAudioFile2 = false;
        isVideoFile2 = false;
     //   choice = document.getElementById("option").value;
        S = "";
        R = "<hr>";
        no = 0;
        if(data != "del"){
        for(datas of data){
            if(isAudioFile(datas)){
                document.getElementById("audioBTN2").style.display = 'block';
                isAudioFile2 = true;
            }
            if(isVideoFile(datas)){
                document.getElementById("videoBTN2").style.display = 'block';
                isVideoFile2 = true;
            }
            if(datas.endsWith(".part")){
                //datas = datas.split(".part")[0];
                no++;
                continue;
            }
            
           // name = datas;
            path = "FileSendMC/CoderMC/"+this.choice+"/"+datas;
            R += '<li id="py'+datas+'"> <'+extention(datas)+' href="'+path+'">🎉'+splitname(datas)+'🎉 </'+extention(datas)+'> <input type="checkbox" value="'+datas+'" name="" id="'+no+'"></li><hr>';
            no++;
        }
    }
        document.getElementById("secrete").innerHTML = no;
        if(no > 1){
            document.getElementById("coverselect").style.display = "block";
          S   = '<label for="Select" class="selectALL">Select All</label><br><br><input type="checkbox" onchange="unselect()" name="selectAll" id="selectAll">';
        }
        else{
            S = "";
            document.getElementById("coverselect").style.display = "none";
        }
        
        if(no == 0){
            
            R += "<h1>😢😢😢</h1>";
           
        }
        document.getElementById("select").innerHTML = S;
        document.getElementById("dataR").innerHTML = R;
        if(data == "del"){
            this.choice = "";
        }
       
    })
    .catch(error => console.error("Error:", error));//saveText", "FileSendMC/CoderMC/".$fol."/saveText
    document.getElementById("gtst").innerHTML = '<a href="FileSendMC/CoderMC/'+this.choice+'/saveText/saveText.php"><button class="saveText">🎉 Save Text 🎉</button></a>';
}
function Delete(){
    numbers = Number(document.getElementById("secrete2").innerHTML);
    ddel = '\n';
    for(nom = 0;nom < numbers;nom++){
        if(document.getElementById(""+nom+"").checked){
            ddel += (nom+1)+". "+document.getElementById(""+nom+"").value+"😢\n";
        }
    }
    let respond = confirm("Do you want delete😢 this file😢😢"+ddel);
    if(respond){
    autoAlert("Click Delete",1000);
    L = "Successfull delete";
   
   L = "";
   for(no = 0;no < numbers;no++){
      //  choice = document.getElementById("option").value; 
       
       
    
            namedel = document.getElementById(""+no+"").value;
            
       
        Dfile = document.getElementById(""+no+"").checked;
        if(Dfile){
            L += "Successfull delete => "+namedel+"\n";
        

        fetch("DeleteINfolder.php?file="+namedel+"&group="+this.choice)
        .then(response => response.json())
        .then(data => {
            
            //////
            autoAlert(data+"😢");

            /////

        })
        .catch(error => console.error("Error:", error));      
        }
   }
    

    if(L == ""){
        L = "No file select for delete!";
    }
}
else{
    autoAlert("Wow🎉 for cancel delete file🎉🎉",3000);
}

    
    H = receive();
   
}

function receive2(){
    fetch("receive.php?group="+this.choice)
    .then(response => response.json())
    .then(data =>{
        no2 = 0;
        for(datas of data){
            no2++;
        }
        document.getElementById("secrete2").innerHTML = no2;
    })
    .catch(error => r);
}


    function groupdelete(){
        let respond = confirm("Are you sure want delete😢 this group😢😢 "+this.choice);
        if(respond){
        folderdelted(this.choice);
        autoAlert(this.choice+" Deleted successfully");
        this.choice = "";
        }
        else{
            autoAlert("Wow🎉 for cancel delete this group🎉🎉"+this.choice,3000);
        }
        
    }
   
    
    function folderdelted(folder){
        fetch("group.php?group="+this.choice)
        .then(response => response.json())
        .then(data =>{
            
            autoAlert(data);
            this.choice = "";
        })
        .catch(error => console.error("Error:", error));
           
    }    

   

function reloading(){

        location.reload(true);

    
}

firstName = this.choice;
weka = 0;

function selectAll(){
    
    secondName = this.choice;
    connected();
    readd = add2();
    document.getElementById("change").value = "Go to view =>" + this.choice;
    document.getElementById("uploadfile").value = "upload to " + this.choice;
    if(this.choice == ""){
        document.getElementById("viewfile").innerHTML = "View file<br>😢Deleted";
    }
    else{
        document.getElementById("viewfile").innerHTML = "View file<br>" + this.choice;
    }
    
   newdata = receive2();
   num2 = Number(document.getElementById("secrete2").innerHTML);
    if(num2 == 0){
        document.getElementById("groupdelete").style.display = "block";
    }
    else{
        document.getElementById("groupdelete").style.display = "none";
    }

    num = Number(document.getElementById("secrete").innerHTML);
    num2 = Number(document.getElementById("secrete2").innerHTML);
    num3 = Number(document.getElementById("secrete3").innerHTML);
    num4 = Number(document.getElementById("secrete4").innerHTML);
    
    
    if(num2 != num || num2 == 0 || firstName != secondName){
        firstName = secondName;
        newdata2 = receive();
    }
    if(num3 != num4){
        newdata3 = add();
        
    }
    
    
   one = -1;
   tl = 0;
    for(i = 0; i < num; i++){
        one2 = document.getElementById(""+i).checked;
        if(one2){
            one++;
            tl = i;
        }
    }
    if(one != -1){
        one += 1;
        you();
        document.getElementById("delete2").innerHTML = '<button id="delete" onclick="Delete()">😢Delete😢</button><br><br>';
        document.getElementById("dod2").innerHTML = '<button onclick="dod()" class="dod">🎉Dowload🎉</button>';

        if(isAudioFile2 && isAudioFile(document.getElementById(tl).value)){
            autoAlert('<button onclick="dod()" class="dod">🎉Dowload🎉</button><br><br><button id="audioBTN" onclick="playPlaylist()">play audio</button><br>',3000,150);
      
        }
        if(isVideoFile2 && isVideoFile(document.getElementById(tl).value)){
            autoAlert('<button onclick="dod()" class="dod">🎉Dowload🎉</button><br><br><button id="videoBTN" onclick="playVideolist()">play video</button><br>',3000,150);
      
        }
       
        if(!isAudioFile(document.getElementById(tl).value) && !isVideoFile(document.getElementById(tl).value)){
            autoAlert('<button onclick="dod()" class="dod">🎉Dowload🎉</button><br>',3000,150);
      
        }
        
    }else{
        document.getElementById("delete2").innerHTML = '';
        document.getElementById("dod2").innerHTML = '';
    }
    
    if(one == num){
        document.getElementById("selectAll").checked = true;
    }
    if(one != num && one != -1){
        document.getElementById("selectAll").checked = false;
    }
    else{
        selectAll = document.getElementById("selectAll").checked;

    if(selectAll){
        for(i = 0; i < num; i++){
            document.getElementById(""+i).checked = true;
        }
    }
    }
   
   
}

////////////

function unselect(){
    selall = document.getElementById("selectAll").checked;
    if(!selall){
        num = Number(document.getElementById("secrete").innerHTML);
        for( z = 0; z <= num; z++){
            document.getElementById(""+z).checked = false;
            this.hay = 1;
        }
    }
    
}


///////////////
lastview = localStorage.getItem("lastview") || "upload";

function gtv(){
if(this.choice){
    localStorage.setItem("lastview","view");
document.getElementById("upl").style.display = "none";
document.getElementById("rec").style.display = "block";
}
else{
    autoAlert("Please select group 😢");
}
}
function bfu(){
    
document.getElementById("upl").style.display = "block";
document.getElementById("rec").style.display = "none";
localStorage.setItem("lastview","upload");
}

function firstON(){
    if(lastview == "view"){
        document.getElementById("upl").style.display = "none";
        document.getElementById("rec").style.display = "block";
    }
    else{
        document.getElementById("upl").style.display = "block";
        document.getElementById("rec").style.display = "none";
    }
}
firstON();

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
autoAlert("Welcome <br>in Mudrik coder website");

function downloadFile(url, filename) {
    a = document.createElement("a");
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    }
 function dod(){
        autoAlert("Click dowload",1000);
        numbers = Number(document.getElementById("secrete2").innerHTML);
        L = "";
        for(no = 0;no < numbers;no++){
           
            namedod = document.getElementById(""+no+"").value;
            Dfile = document.getElementById(""+no+"").checked;
            if(Dfile){
                L += "Successfull dowload => "+namedod+"<br>";
                downloadFile("FileSendMC/CoderMC/"+this.choice+"/"+namedod,namedod);
            }
           // no++;
        }
        if(L == ""){
            L = "No file select for delete!";
        }
        autoAlert(L);
        receive();   
       
        
    }
var nopart = 0;
var partdata = "";
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
    
setInterval(selectAll,1000);
setInterval(partFiles,1000);

function isAudioFile(filename) {
    const audioExtensions = ['.mp3', '.wav', '.ogg', '.aac', '.m4a', '.flac'];
    const ext = filename.slice(filename.lastIndexOf('.')).toLowerCase();
    return audioExtensions.includes(ext);
  }
  //[].push()
 function audioList(data){
    listAudio = [];
    for(list of data){
        if(isAudioFile(list)){
            listAudio.push(list);
        }
    }
    return listAudio;
 }
au = 0;

function playPlaylist() {
    if(au == 0){
        autoAlert('<audio id="audioPlayer" controls ></audio><br>',-2024,200);
        au = 1;
    }
    
    document.getElementById("accending").style.display = 'none';
    document.getElementById("delete2").style.display = 'none';
    document.getElementById("dod2").style.display = 'none';
    fetch("receive.php?group="+this.choice+"&arrange="+this.arg)
    .then(response => response.json())
    .then(data2 =>{
        data = audioList(data2);
        currentIndex = 0;
        aun = 0;
        for(n = 0;n < data2.length;n++){
            if(isAudioFile(document.getElementById(n).value)){
                if(document.getElementById(n).checked){
                    currentIndex = aun;
                }
                
                document.getElementById("py"+data2[n]).style.backgroundColor = '';
                aun++;
            }
            document.getElementById(n).checked = false;
        }
        
        audio = document.getElementById("audioPlayer");
        audio.src = "FileSendMC/CoderMC/"+this.choice+"/"+data[currentIndex];
        audio.play();
        document.getElementById("py"+data[currentIndex]).style.backgroundColor = 'lightblue';
        autoAlert(data[currentIndex],5000);
        document.getElementById("py"+data[currentIndex]).scrollIntoView({
            behavior: 'smooth',
            block: 'center'
           });
    namba = 0;
       setInterval(()=>{
            if(currentIndex < data.length-1){
        if(audio.ended && namba == 0){
            this.currentIndex ++;
        audio.src = "FileSendMC/CoderMC/"+this.choice+"/"+data[currentIndex];
        audio.play();
       namba = 1;
       document.getElementById("py"+data[currentIndex]).style.backgroundColor = 'lightblue';
       autoAlert(data[currentIndex],5000);
       document.getElementById("py"+data[currentIndex]).scrollIntoView({
        behavior: 'smooth',
        block: 'center'
       });
       if(currentIndex == 0){
        document.getElementById("py"+data[data.length - 1]).style.backgroundColor = '';
       }
      
     else{
        document.getElementById("py"+data[currentIndex - 1]).style.backgroundColor = '';
     }
      
        }
        else{
            namba = 0;
        }
    }else{
        currentIndex = -1;
    }
    },1000);

    })
    .catch(error => console.error("Error:", error));
    document.getElementById("videoPlayer").pause();
}


vd = 0;

function playVideolist() {
    if(vd == 0){
        if(!mobile()){
            autoAlert('<video id="videoPlayer" width="600" height="320" controls></video><br>',-2024,200);
            vd = 1;
        }
        else{
            autoAlert('<video id="videoPlayer" width="320" height="240" controls></video><br>',-2024,200);
        vd = 1;
        }
        
    }
    
    document.getElementById("accending").style.display = 'none';
    document.getElementById("delete2").style.display = 'none';
    document.getElementById("dod2").style.display = 'none';
    fetch("receive.php?group="+this.choice+"&arrange="+this.arg)
    .then(response => response.json())
    .then(data2 =>{
        data = videoList(data2);
        currentIndex = 0;
        aun = 0;
        for(n = 0;n < data2.length;n++){
            if(isVideoFile(document.getElementById(n).value)){
                if(document.getElementById(n).checked){
                    currentIndex = aun;
                }
               
                document.getElementById("py"+data2[n]).style.backgroundColor = '';
                aun++;
            }
            document.getElementById(n).checked = false;
        }
        
        audio = document.getElementById("videoPlayer");
        audio.src = "FileSendMC/CoderMC/"+this.choice+"/"+data[currentIndex];
        audio.play();
        document.getElementById("py"+data[currentIndex]).style.backgroundColor = 'lightblue';
        autoAlert(data[currentIndex],5000);
        document.getElementById("py"+data[currentIndex]).scrollIntoView({
            behavior: 'smooth',
            block: 'center'
           });
    namba = 0;
       setInterval(()=>{
            if(currentIndex < data.length-1){
        if(audio.ended && namba == 0){
            this.currentIndex ++;
        audio.src = "FileSendMC/CoderMC/"+this.choice+"/"+data[currentIndex];
        audio.play();
       namba = 1;
       document.getElementById("py"+data[currentIndex]).style.backgroundColor = 'lightblue';
       autoAlert(data[currentIndex],5000);
       document.getElementById("py"+data[currentIndex]).scrollIntoView({
        behavior: 'smooth',
        block: 'center'
       });
       if(currentIndex == 0){
        document.getElementById("py"+data[data.length - 1]).style.backgroundColor = '';
       }
      
     else{
        document.getElementById("py"+data[currentIndex - 1]).style.backgroundColor = '';
     }
      
        }
        else{
            namba = 0;
        }
    }else{
        currentIndex = -1;
    }
    },1000);

    })
    .catch(error => console.error("Error:", error));
    document.getElementById("audioPlayer").pause();
}


function isVideoFile(filename) {
  const videoExtensions = ['.mp4', '.webm', '.ogg', '.avi', '.mov', '.mkv'];
  const ext = filename.slice(filename.lastIndexOf('.')).toLowerCase();
  return videoExtensions.includes(ext);
}
function videoList(data){
    listAudio = [];
    for(list of data){
        if(isVideoFile(list)){
            listAudio.push(list);
        }
    }
    return listAudio;
 }