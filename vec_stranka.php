<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="popup.css">
    <script defer src="popup.js"></script>

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

<! -- Urejanje podatkov popup --> 
<button data-popup-target="#tip">Uredi podatke</button>
<div class="popup" id="tip">
    <div class="popup-header">
        <div class="popup-title" id="naslov_form"> Uredi podatke</div>
        <button data-close-button class="zapri">&times;</button>
    </div>
    <div class="popup-body">
    <form action="vec_stranka_placilo.php" method="get" >
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
  <input type="hidden" name="sid" value='<?php echo $id ?>'>
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
    </div>
</div>





<h3>Pretekli nakupi</h3>
<table id="tabela" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Dejavnost</th>
                <th>Kupljene ure</th>
                <th>Ure še na voljo</th>
                <th>Datum nakupa</th>
                <th>Cena</th>
                <th>Potrebno plačati</th>
            </tr>
        </thead>
        <tbody>
<?php 
$sql = "SELECT * FROM stranke join kupljene_ure using(stranka_id) join dejavnosti using(dejavnost_id) where stranka_id = '$id' order by na_voljo_ur DESC";
$result = $conn->query($sql);
 while($row = $result->fetch_assoc())
 {
  echo "<tr>";
  echo "<td>".$row['naslov_dejavnosti']."</td>";
  echo "<td>".$row['stevilo_ur']."</td>";
  echo "<td>".$row['na_voljo_ur']."</td>";
  echo "<td>".$row['datum_nakupa']."</td>";
  echo "<td>".$row['stevilo_ur'] * $row['cena']." Eur</td>";
  $ajdi = $row['ku_id'];
?>
<td>
<?php  
if($row['za_placati'] == 0)
{
echo "<p> Že plačano </p>";
}
else
{
  ?>
   <?php echo $row['za_placati'] ?> Eur &ensp;
  <form method="get" name="cena" action="vec_stranka_placilo.php">
  <input type='number'  required  name='placilo' min='1' max='<?php echo $row['za_placati']; ?>' >
  <input type='hidden' name='ku_id' value='<?php echo $ajdi; ?>' >
  <input type='hidden' name='sid' value='<?php echo $id; ?>' >
  <input type='submit' value='Potrdi'>
  </form>

  <?php
}


  echo "</tr>";
 }

?>

  
        </tbody>
</table>
<script>
  $(document).ready(function () {
    $('#tabela').DataTable({
        pagingType: 'numbers',
        "searching":false
    });
   
});


</script>
<?php

   
CloseCon($conn);
?>
</body>
</html>
