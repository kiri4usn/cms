function printerConnection(){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "content/plugins/BS260_Driver/connectionTest.php" ,false);
    xhr.send();

    var xhr2 = new XMLHttpRequest();
    xhr2.open("GET", xhr.responseText, false);
    xhr2.send();

    if(xhr2.status == 200){
        console.log(xhr2.status);
    } else {
        console.log(xhr2.status);
    }

}