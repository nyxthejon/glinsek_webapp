<!DOCTYPE html>
<html lang = "sl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Rezervacije</title>
<link rel="stylesheet" href="popup.css">
<link rel="stylesheet" href="rezer.css">
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="evo-calendar/css/evo-calendar.css" />
<script src="evo-calendar/js/jquery.min.js"></script>
<script defer src="popup.js"></script>
   
<script src="evo-calendar/js/evo-calendar.js"></script>




</head>

<body>


    <?php require 'header.php'; 
 $conn = OpenCon();
 ?>




</body>


<h1> Aplikacija </h1>

<button data-popup-target="#tip">Dodaj novo rezervacijo</button>
<div class="popup" id="tip">
    <div class="popup-header">
        <div class="popup-title" id="naslov_form"> Izberite vrsto dejavosti</div>
        <button data-close-button class="zapri">&times;</button>
    </div>
    <div class="popup-body">
    <select name="vrsta" id="vrsta" onchange="zamenjaj()" >
    <option value=""> </option>
    <option value="Jahanje">Jahanje</option>
     <option value="Tabor">Tabori</option>
    <option value="Rojstni dan">Rojstni dan</option>
   
  </select>




<!-- form za vnos jahanja-->
  <form action="vnos_rezervacije.php" method="post">
  <div class="form" id="jahanje_form">
  <input type="hidden" name="tip" value="jahanje">
    <!-- Izbira stranke -->
    <label for="i_stranka">Izberite stranko</label><br>
  <select name="i_stranka" id="i_stranka" require onchange="showpaketi(this.value)">
  <option value="">Izberite stranko</option>
  <?php
$sql = "SELECT * FROM `stranke`";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
 {
    echo  '<option value='.$row["stranka_id"].'>'.$row["ime"].' '.$row['priimek'].' | '.$row["email"].'</option>';
 }
    ?>
  </select>

    <!-- Izbira paketa -->
    <div id="i_paket">
    </div>
    <div>
    <label for='dateizbira'>Vnesite datum Jahanja</label>
    <input type="datetime-local" require id="dateizbira"
       name="datum_jahanja"
       min="2000-01-01T00:00">
    </div>
    <div>
    <label for='cas'>Do kdaj bo trajalo</label>
    <input type="time" require id="cas"
       name="cas">
    </div>
    <br>
    <br>
    <p>Opombe</p>
    <textarea name='opomba'  id='opomba'></textarea>
    <br>
    <button type="button" onclick="naprej('jahanje_form', 'jahanje_form_naprej','skrij')">Naprej</button>
    <br>
  </div>
  <div class="form" id="jahanje_form_naprej">
  <h3>Kdo bo delal</h3> 
  <?php
$sql = "SELECT * FROM `zaposleni`";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
 {
  echo "<input type='checkbox' id=".$row['zaposleni_ime']." name='zaposleni[]' value='".$row['delavci_id']."'>";
  echo "<label for=".$row['zaposleni_ime'].">".$row['zaposleni_ime']."</label><br>";
}
    ?>
<br>
<input type='checkbox' id="ni" name='zaposleni[]' value="ni znano">
<label for="ni" >Trenutno ni znano</label><br>
  <button type="button" onclick="naprej('jahanje_form_naprej','jahanje_form','pokazi')">Nazaj</button>
<input type="submit" id='checkBtn' value="Submit">
  </div>
</form> 




<!-- form za vnos Tabora-->
<div class="form" id="tabor_form">
  <form action="vnos_rezervacije.php" method="post">

  
  <input type="submit" value="Submit">
</form> 
  </div>




<!-- form za vnos Rojstnega dneva-->  
<form action="vnos_rezervacije.php" method="post">
  <div class="form" id="rd_form">
  <label for="starsa">Ime in priimek staršev</label><br>
  <input type="text" id="starsa" name="starsi"><br>
  <label for="naslov">Naslov</label><br>
  <input type="text" id="naslov" name="naslov" required="required"><br>
  <label for="posta">Postna stevilka</label><br>
  <select name="posta" id="posta">
  <?php


$sql = "SELECT * FROM `kraji`";
$result = $conn->query($sql);
echo  "<option value='none'> </option>";
 while($row = $result->fetch_assoc())
 {
    echo  '<option value='.$row["k_id"].'>'.$row["ime_k"].' | '.$row["posta"].'</option>';
 }
    ?>
  </select><br>
  <label for="email">E-pošta</label><br>
  <input type="email" id="email" name="email" required="required"><br>
  <label for="phone">Telefon</label><br>
  <input type="number" id="phone" name="phone" required="required"><br>
  <button type="button" onclick="naprej('rd_form','rd_form_naprej','skrij')">Naprej</button>
 
</div>
 <div class='form' id='rd_form_naprej'>
 <label for="starsa">Ime in priimek Slavljenca/ke</label><br>
  <input type="text" id="starsa" name="slavljenec"><br>
  <label for="leto">Dopolnila bo</label><br>
  <input type="number" id="leto" name="leto"><br>
   <div>
    <label for='dateizbira'>Vnesite datum praznovanja</label>
    <input type="datetime-local" require id="dateizbira"
       name="datum_jahanja"
       min="2000-01-01T00:00">
    </div>
    

 <label for='opombe'>Opombe</label>
<textarea cols='50' id='about' name='about' rows='4'></textarea> 
<button type="button" onclick="naprej('rd_form_naprej','rd_form','pokazi')">Nazaj</button>
 <input type="submit" value="Submit">
</div>
</form> 
  




    </div>
</div>



<button data-popup-target="#nakup">Dodaj nov nakup paketa</button>
<div class="popup" id="nakup">
    <div class="popup-header">
        <div class="popup-title"> Vnesite podatke o stranki</div>
        <button data-close-button class="zapri">&times;</button>
    </div>
    <div class="popup-body">
    

    <!-- form za nakup paketa-->
    
    <form action="vnos_nakupa.php" method="post">
    <label for="vd"> Izberite dejavnost </label><br>

    <select name="dejavnost" id="vd">
    <?php

$sql = "SELECT * FROM `dejavnosti`";


$result = $conn->query($sql);
 while($row = $result->fetch_assoc())
 {
    echo  '<option value='.$row["dejavnost_id"].'>'.$row["naslov_dejavnosti"].' | '.$row["cena"].' EUR</option>';
 }
    ?>
    </select>
    <br>
  <label for="im">Ime</label><br>
  <input type="text" id="im" name="im" required="required"><br>
  <label for="pr">Priimek</label><br>
  <input type="text" id="pr" name="pr" required="required"><br>
  <label for="email">E-pošta</label><br>
  <input type="email" id="email" name="email" required="required"><br>
  <label for="phone">Telefon</label><br>
  <input type="number" id="phone" name="phone" required="required"><br>
  <label for="naslov">Naslov</label><br>
  <input type="text" id="naslov" name="naslov" required="required"><br>
  <label for="posta">Postna stevilka</label><br>
  <select name="posta" id="posta">
  <?php


$sql = "SELECT * FROM `kraji`";
$result = $conn->query($sql);
echo  "<option value='none'> </option>";
 while($row = $result->fetch_assoc())
 {
    echo  '<option value='.$row["k_id"].'>'.$row["ime_k"].' | '.$row["posta"].'</option>';
 }
    ?>



  </select><br>
  <label for="za">Za koga se kupuje paket</label><br>
  <input type="text" id="za" name="za" value="zase"><br>
  <label for="kolicina">Kolicina</label><br>
  <input type="number" id="kolicina" name="kolicina" value="1" min="1"><br>
  <input type="submit" value="Konec">
</form>

    </div>
    </div>

    


    <!-- ogled rezervacije -->
    <div class="popup" id="rezervacija">
    <div class="popup-header">
        <div class="popup-title"> Ogled rezervacije  </div>
        <button data-close-button class="zapri">&times;</button>
    </div>
    <div class="popup-body">
      <h2> lo llll </h2>
    </div>
    </div>

<div id="evoCalendar"></div>



<h3 id='rez_nas'>Rezervacije na izbran dan</h3>

<div id = 'rez_na_dan'></div>
  

<div  id="overlay"></div>










<script>
$(document).ready(function () {
     $('#checkBtn').click(function() {
       checked = $("input[type=checkbox]:checked").length;
       if(!checked) {
         alert("You must check at least one checkbox.");
         return false;
       }
     });
 });



let calevent = [];
var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
   calevent = JSON.parse(this.responseText);

   $('#evoCalendar').evoCalendar({
    language:'sl',
    calendarEvents: calevent
  
  
  });
}
xmlhttp.open("GET", "get_rezervacije.php");
xmlhttp.send();

  
  

  /*
  $("#evoCalendar").evoCalendar('addCalendarEvent', [
    {
      id: '5ggg',
      name: "My Birthday",
      date: "2022-08-02 18:34:00",
      description: "Vacation leave for 3 days.",
      type: "event",
      everyYear: false,
      badge:"08/03 - 08/05",
    }
  ]);
*/
  


//Današnje rezervacije ko se zažene
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); 
var yyyy = today.getFullYear();
var d =  mm +'/'+ dd +'/'+ yyyy;


const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("rez_na_dan").innerHTML = this.responseText;
  }
  xhttp.open("GET", "get_rezervacije.php?datum="+d);
  xhttp.send();



  
// selectDate
$('#evoCalendar').on('selectDate', function(event, newDate, oldDate) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("rez_na_dan").innerHTML = this.responseText;
  }
  xhttp.open("GET", "get_rezervacije.php?datum="+newDate);
  xhttp.send();
});











    // Zamenja form ob spremembi select
    function zamenjaj()
{   var vrsta = document.getElementById("vrsta");
    var naslov_form = document.getElementById("naslov_form");

    var jahanje = document.getElementById("jahanje_form");
    var rd = document.getElementById("rd_form");
    var tabor = document.getElementById("tabor_form");
    jahanje.style.display = "none";
    rd.style.display = "none";
    tabor.style.display = "none";
    if(vrsta.value == "Jahanje")
    {
        jahanje.style.display = "block";
        rd.style.display = "none";
        tabor.style.display = "none";
        naslov_form.innerHTML = "Vnesite podatke za jahanje";
    }
    else if(vrsta.value == "Rojstni dan")
    {
        jahanje.style.display = "none";
        rd.style.display = "block";
        tabor.style.display = "none";
        naslov_form.innerHTML = "Vnesite podatke za Rojstni dan";
    }
    else if(vrsta.value == "Tabor")
    {
        jahanje.style.display = "none";
        rd.style.display = "none";
        tabor.style.display = "block";
        naslov_form.innerHTML = "Vnesite podatke za Tabor";
    }
    else
    {
        naslov_form.innerHTML = "Izberite vrsto dejavosti";
    }
}



function naprej(odlokacija, dolokacija,action)
{
  var odkam = document.getElementById(odlokacija);
  var dokam = document.getElementById(dolokacija);

  odkam.style.display = "none";
  dokam.style.display = "block";
  var vr = document.getElementById('vrsta');
  if(action == 'skrij')
  vr.style.display = "none";
  else if (action == 'pokazi')
  {
  vr.style.display = "block";
  }
}

function showpaketi(str)
{

  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    ostal.style.display = "none";
    return;
  }

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("i_paket").innerHTML = this.responseText;
  }
  xhttp.open("GET", "getpakete.php?ajdi="+str);
  xhttp.send();

}

 </script>
 <?php
CloseCon($conn);
?>
</html>
