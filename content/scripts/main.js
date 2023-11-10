
function loadScript(src, callback) {

    let script = document.createElement('script');
    script.src = src;
    script.onload = () => callback(script);
    document.head.append(script);
}

function loadpage(s){
    try {
        document.getElementById('content').innerHTML = '';
    } catch (e) {alert(e)}
    var xhr = new XMLHttpRequest();
    xhr.open("GET", s ,false);
    xhr.send();
    document.getElementById("content").insertAdjacentHTML('beforeEnd', xhr.responseText);

    var c = document.getElementById('content');
    c.dispatchEvent(new Event('updated'));
}

function editclass(i){
    for(var a = 0; a <= document.getElementsByClassName('mp').length; a++){
        try {
            document.getElementsByClassName('mp')[a].classList.remove('cls');
        } catch (e) {}
    }
    document.getElementsByClassName('mp')[i].classList.add('cls');
}


function modalProfile() {

    if (!window.flag) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", 'content/functions/modalprofile.php?str', false);
        xhr.send();
        //document.write(xhr.responseText);
        document.body.insertAdjacentHTML('beforeEnd', xhr.responseText);
        window.flag = 1;
    } else {
        document.getElementById('modalUsr').remove();
        window.flag = 0;
    }
}

function CookiesDelete() {

    var cookies = document.cookie.split(";");
    location.reload();
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;";
        document.cookie = name + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = token + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;";
        document.cookie = token + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
    location.reload();
}

function cartUpdate(){
    var xhr = new XMLHttpRequest();
    document.getElementById('toDel2').innerHTML = '';
    xhr.open("GET", 'content/plugins/Ekassir/cart.php', false);
    xhr.send();
    document.getElementById('toDel2').innerHTML = xhr.responseText;
}

function loadCId(id){

    var xhr = new XMLHttpRequest();
    document.getElementById('toDel').innerHTML = '';
    xhr.open("GET", 'content/plugins/Ekassir/loadMenu.php?id='+id, false);
    xhr.send();

    document.getElementById('toDel').innerHTML = xhr.responseText;
    cartUpdate();
}

function loadPId(id,qty){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", 'content/plugins/Ekassir/editCart.php?fnc=plus&id=' + id, false);
    xhr.send();
    cartUpdate();
}

function remPId(id){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", 'content/plugins/Ekassir/editCart.php?fnc=minus&id='+id, false);
    xhr.send();
    cartUpdate();
}

function fs() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
    } else if (document.exitFullscreen) {
        document.exitFullscreen();
    }
}
function ajax(){
    if (document.querySelector('input[ajax="1"]') != null) {
        let val = document.querySelector('input[ajax="1"]').value;

        let xhr = new XMLHttpRequest();
        let url = document.querySelector('input[ajax="1"]').attributes.ajaxoption.value + "&data=" + val;
        xhr.open("GET", url, false);
        xhr.send();
        document.getElementById("list").innerHTML = xhr.responseText;
    }
}

function stockUpdate(id){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'content/plugins/strongStock/controller.php?f=stockUpdate&id='+id, false);
    xhr.send();
    document.getElementById('thisForm').innerHTML = '';
    document.getElementById('thisForm').innerHTML = xhr.responseText;
}

function addSKU1(){
    var name = document.querySelector('input[name=nameSP]').value;
    var vendor = document.querySelector('input[name=vendor]').value;
    var article = document.querySelector('input[name=article]').value;
    var price = document.querySelector('input[name=price]').value;
    var qty = document.querySelector('input[name=Qty]').value;


    var url = 'content/plugins/strongStock/controller.php?addSKU&nameSP=' + name + "&vendor=" + vendor + "&article=" + article + "&price=" + price + "&qty=" + qty;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, false);
    xhr.send();
    //console.log(xhr.responseText);
    if (xhr.responseText == "\n" + "OK") {
        goodalert("Добавлено в склад");
    } else {
        erralert(xhr.responseText);
    }
}

function editSKU1(id){
    var name = document.querySelector('input[name=nameSP]').value;
    var vendor = document.querySelector('input[name=vendor]').value;
    var article = document.querySelector('input[name=article]').value;
    var price = document.querySelector('input[name=price]').value;
    var qty = document.querySelector('input[name=Qty]').value;


    var url = 'content/plugins/strongStock/controller.php?editSKU&nameSP=' + name + "&vendor=" + vendor + "&article=" + article + "&price=" + price + "&qty=" + qty + "&id=" + id;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, false);
    xhr.send();
    //console.log(xhr.responseText);
    if (xhr.responseText == "\n" + "OK") {
        goodalert("Сохранено");
    } else {
        erralert(xhr.responseText);
    }
}

function consumption(){
    var name = document.querySelector('input[name=nameSP]').value;
    var qty = document.querySelector('input[name=Qty]').value;
    var base = document.querySelector('select[name=base]').value;


    var url = 'content/plugins/strongStock/controller.php?consumption&nameSP=' + name + "&qty=" + qty + "&base=" + base;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, false);
    xhr.send();
    //console.log(xhr.responseText);
    if (xhr.responseText == "\n" + "OK") {
        goodalert("Сохранено");
    } else {
        erralert(xhr.responseText);
    }
}

function erralert(string, func){
    document.body.insertAdjacentHTML("afterbegin","<div id='modal'><p class='alert'>"+string+"</p><br><p onclick='document.getElementById(\"modal\").remove(); ' class='close'>Закрыть</p></div>");
}

function goodalert(string, func){
    document.body.insertAdjacentHTML("afterbegin","<div id='modal'><p class='alert2'>"+string+"</p><br><p onclick='document.getElementById(\"modal\").remove(); ' class='close2'>Закрыть</p></div>");
}

function claerCart(){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", 'content/plugins/Ekassir/controller.php?clearCart', false);
    xhr.send();
    cartUpdate();
}


function ajaxSend(s){
    var xhr = new XMLHttpRequest();
    var ph = document.getElementsByName("product")[0].value;
    if(ph != ""){
    try {
        document.getElementById("selectProduct").remove();
    } catch (e) {}
    xhr.open("GET","content/plugins/strongStock/productS.php?search="+ph,false);
    xhr.send();
    document.getElementById("sTable").innerHTML = xhr.responseText;
}
    setTimeout(() => {
        ajaxSend();
    }, 1000);
}

function tof3(){
    var str = "{";
    for(var i = 0; i < document.getElementsByName('productn').length;i++){
        str += '"'+document.getElementsByName('productn')[i].attributes['prodId'].value+'":"'+document.getElementsByName('productn')[i].value+'",';
    }
    var str2 = '';
    for(var i = 0; i < str.length-1; i++){
        str2+=str[i];
    }
    str2 += "}";

    var url = "content/plugins/strongStock/controller.php?comingD&invoice="+ document.getElementsByName('invoice')[0].value +"&json="+str2;
    xhr = new XMLHttpRequest();
    xhr.open("GET", url, false);
    xhr.send();
    if (xhr.responseText == "\n" + "OK") {
        goodalert("OK");
    } else {
        erralert(xhr.responseText);
    }
    console.log(url);
}
function tof4(){
    var str = location.href + "&price=" + document.getElementsByName('price')[0].value;
    var str2 = '';
    for(var i = 0; i < 59; i++){
        str2+=str[i];
    }
    str2 += '4';
    for(var i = 60; i < str.length; i++){
        str2+=str[i];
    }
    location.replace(str2);
}
function selectProduct(id, art, name, qty, vendor){
    var scale = 0;
    for(var i = 0; i < document.getElementsByName('productn').length;i++){
        if(document.getElementsByName('productn')[i].attributes['prodid'].value == id){
            scale = 1
        }
        //console.log(document.getElementsByName('productn')[i].attributes['prodid']);
    }
    if(scale == 1){erralert("Артикул уже добавлен!");} else {
        var str = "<tr style='background: #fff; color: black'><td style='min-width: 100px; padding:10px;'>"+art+"</td><td style='min-width: 100px; padding:10px;'>"+name+"</td><td style='padding:10px;'>"+qty+"</td><td><input name='productn' prodId='"+id+"'></input></td><td style='min-width: 400px; padding:10px;'>"+vendor+"</td><td style='padding:10px;'>-</td></tr>";
        document.getElementById("xtable").insertAdjacentHTML("beforeEnd", str);
    }
}