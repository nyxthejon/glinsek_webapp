<?php
require 'baza.php';
$id = $_GET['ajdi'];
$conn = OpenCon();
?>
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
CloseCon($conn);

?>
</select>

