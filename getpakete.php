<?php
require 'baza.php';
$conn = OpenCon();
if(isset($_GET['ajdi']))
{
$id = $_GET['ajdi'];

?>
    <label for="i_paket_s">Izbreite paket</label><br>
<select name="i_paket_s" id="i_paket_s">
<?php
$sql = "SELECT * FROM kupljene_ure join dejavnosti using(dejavnost_id) where stranka_id=".$id." and na_voljo_ur > 0;";
$result = $conn->query($sql);

if (mysqli_num_rows($result)==0) 
{
    echo  '<option value="">Stranka nima kupljenih paketov</option>';
}
else
{

while($row = $result->fetch_assoc())
{
    echo  '<option value='.$row["ku_id"].'>'.$row["naslov_dejavnosti"].' | '.$row['za_koga'].'</option>';
}
}


?>
</select>

<?php
}
else
{
    $em = $_GET['email'];
    $sq = "SELECT * FROM stranke join kraji using(k_id) where email = '$em';";
    $result = $conn->query($sq);
    if (mysqli_num_rows($result)==0) 
    {
        echo "Ta stranka ne obstaja";
    }   
    else
    {
    $row = $result->fetch_assoc();
    echo "<label> Ime in priimek </label><br>";
    echo "<input type='hidden' name='id_preveri' value=".$row['stranka_id']." >";
    echo "<input type='text' value=".$row['ime']." ".$row['priimek']." disabled> <br>";
    echo "<label> Email </label><br>";
    echo "<input type='text' value=".$row['email']." disabled> <br>";
    echo "<label> Telefon </label><br>";
    echo "<input type='text' value=".$row['telefon']." disabled> <br>";
    echo "<label> Naslov </label><br>";
    echo "<input type='text' value=".$row['naslov']." disabled> <br>";
    echo "<label> Kraj </label><br>";
    echo "<input type='text' value='".$row['ime_k']." | ".$row['posta']."' disabled> <br>";
    }
}