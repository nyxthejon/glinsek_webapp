<!DOCTYPE html>
<html lang = "sl">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<head>
<title>Rezervacije</title>
<link rel="stylesheet" href="popup.css">
<script defer src="popup.js"></script>
</head>

<body>
    <?php
    
    include 'baza.php';
    
    $conn = OpenCon();
    $sql = "SELECT * FROM `dejavnosti`";
/*
    $result = $conn->query($sql);
     while($row = $result->fetch_assoc())
     {
        echo $row["naslov_dejavnosti"];
        echo "<br>";
        
     
     }
  */
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

  <div class="form" id="jahanje_form">
  <form action="vnos_rezervacije.php">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <input type="submit" value="Submit">
</form> 
  </div>

<!-- form za vnos Tabora-->
<div class="form" id="tabor_form">
  <form action="vnos_rezervacije.php">
  <label for="fname">LOLLLLLLLLL</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <input type="submit" value="Submit">
</form> 
  </div>

<!-- form za vnos Rojstnega dneva-->
  <div class="form" id="rd_form">
  <form action="vnos_rezervacije.php">
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
    </div>
    </div>

    


<div  id="overlay"></div>




<script>
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

 </script>
</html>
