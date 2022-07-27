<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podrobno o stranki</title>
</head>
<body>

<?php

require 'header.php';
$id = $_GET['id'];

$conn = OpenCon();
$sql = "SELECT * FROM `stranke` join kraji using(k_id) where stranka_id=".$id.";";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



?>
<h2>Ogled podatkov in nakupov za stranko <?php echo $row['ime'].' '.$row['priimek'] ?> </h2>
<hr>
<h3>Uredi podatke</h3>
<form action="update_uporabnika.php" method="post" >
<label for="im">Ime</label><br>
  <input type="text" id="im" name="im" value= <?php echo $row['ime'] ?> required="required"><br>
  <label for="pr">Priimek</label><br>
  <input type="text" id="pr" name="pr" value= <?php echo $row['priimek'] ?> required="required"><br>
  <label for="email">E-pošta</label><br>
  <input type="email" id="email" name="email"  value= <?php echo $row['email'] ?> required="required"><br>
  <label for="phone">Telefon</label><br>
  <input type="number" id="phone" name="phone" value= <?php echo $row['telefon'] ?>  required="required"><br>  
  <label for="naslov">Naslov</label><br>
  <input type="text" id="naslov" name="naslov" value= <?php echo $row['naslov'] ?> required="required"><br>
  <label for="posta">Postna stevilka</label><br>
  <select name="posta" id="posta">
  <?php
$sql = "SELECT * FROM `kraji`";
$po = $conn->query($sql);
 while($por = $po->fetch_assoc())
 {
    echo  '<option value='.$por["k_id"].'>'.$por["ime_k"].' | '.$por["posta"].'</option>';
 }
    ?>
  </select><br>

  
  <script>
    let e = document.getElementById('posta');
    e.value = '<?php echo $row["k_id"]; ?>';

  </script>
  <input type="submit" value="Konec">





</form>


<?php
CloseCon($conn);
?>
</body>
</html>
