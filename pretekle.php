<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stranke.css">
    <link rel="stylesheet" href="rezer.css">
<style>
    .izbira
    {
    margin:10px;    
    }
</style>
</head>
<body>
<?php
require 'header.php';
echo "<h1>Pretekle rezervacije in kdo je delal</h1>";
$conn = OpenCon();
$sql = "SELECT * FROM zaposleni;";
$result = $conn->query($sql);
echo "<div class='izbira'>";
while($row =  $result->fetch_assoc())
{
   echo "<input type='radio' id='".$row['zaposlen_id']."' onchange='getValue(this)' name='zaposlen' value='".$row['zaposlen_id']."'>";
   echo "<label for='".$row['zaposleni_ime']."'>".$row['zaposleni_ime']."</label>";

}
?>
<input type="radio" id="vse" onchange="getValue(this)" name="zaposlen" value="vsi">
<label for="vse">Vsi</label><br>

</div>
<div class='izbira'>
<label for="start">Od</label>

<input type="date" id='start' onchange="Datum()" class="med" name="start">
      


<label for="end">Do</label>
<input type="date" id='end' onchange="Datum()" class="med" name="end">
    

</div>


<div id='pretk'></div>




<script>

   function Datum()
   {
    var zac = document.getElementById('start').value;
    var kon = document.getElementById('end').value;
    if(zac != "" && kon != "")
    {
        console.log("ok");
        var val = document.querySelector('input[name="zaposlen"]:checked').value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("pretk").innerHTML = this.responseText;
        }
        xhttp.open("GET", "get_pretekle.php?zac="+ zac + "&zapo=" + val + "&kon=" + kon);
        xhttp.send();
    }
   } 

   
   function getValue(val)
    {
        document.getElementById('start').value = null;
        document.getElementById('end').value = null;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("pretk").innerHTML = this.responseText;
        }
        xhttp.open("GET", "get_pretekle.php?zapo="+ val.value);
        xhttp.send();
        //val.value
    }
</script>
</body>
</html>