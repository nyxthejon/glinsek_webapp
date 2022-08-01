<!DOCTYPE html>
<html lang = "sl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Rezervacije</title>
<link rel="stylesheet" href="popup.css">
<script defer src="popup.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
  echo "<input type='checkbox' id=".$row['zaposleni_ime']." name='zaposleni[]' value=".$row['delavci_id'].">";
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
  <label for="fname">LOLLLLLLLLL</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <input type="submit" value="Submit">
</form> 
  </div>

<!-- form za vnos Rojstnega dneva-->
  <div class="form" id="rd_form">
  <form action="vnos_rezervacije.php" method="post">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <input type="submit" value="Submit">
</form> 
  </div>

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
