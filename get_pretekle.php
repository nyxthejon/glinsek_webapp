<?php



require 'baza.php';

$conn = OpenCon();

$val = $_GET['zapo'];


if($val == 'vsi')
{
if(isset($_GET['zac']) && isset($_GET['kon']))
{
  $z = $_GET['zac'];
  $k = $_GET['kon'];
  $sql = "SELECT * FROM zaposleni_rezervacije join rezervacije using (rezervacija_id) join stranke using(stranka_id) join kupljene_ure on (rezervacije.kupljena_dejavnost_id = kupljene_ure.ku_id)  join dejavnosti using(dejavnost_id) where date(cas) between '".$z."' and '".$k."';";

}
else
{
  $sql = "SELECT * FROM zaposleni_rezervacije join rezervacije using (rezervacija_id) join stranke using(stranka_id) join kupljene_ure on (rezervacije.kupljena_dejavnost_id = kupljene_ure.ku_id)  join dejavnosti using(dejavnost_id) where date(cas) < date(now());";
}
}
else
{
if(isset($_GET['zac']) && isset($_GET['kon']))
{
  $z = $_GET['zac'];
  $k = $_GET['kon'];
  $sql = "SELECT * FROM zaposleni_rezervacije join rezervacije using (rezervacija_id) join stranke using(stranka_id) join kupljene_ure on (rezervacije.kupljena_dejavnost_id = kupljene_ure.ku_id)  join dejavnosti using(dejavnost_id) where zaposlen_id = ".$val." and date(cas) between '".$z."' and '".$k."';";
}
else
{
$sql = "SELECT * FROM zaposleni_rezervacije join rezervacije using (rezervacija_id) join stranke using(stranka_id) join kupljene_ure on (rezervacije.kupljena_dejavnost_id = kupljene_ure.ku_id)  join dejavnosti using(dejavnost_id) where date(cas) < date(now()) and zaposlen_id = ".$val.";";
}
}
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
echo "<div class='row'>";
echo "<div class='cell' data-title='Dejavnost'>".$row['naslov_dejavnosti']."</div>";
echo "<div class='cell' data-title='cas'>".$row['cas']." do ".$row['do_kdaj']."</div>";
echo "<div class='cell' data-title='Stranka'>".$row['ime']." ".$row['priimek']."</div>";
echo "</div>";
}

?>


<style>
  .row
  {
    display:inline-block;
    min-width: 100%;
  }
  
  @media screen and (min-width: 1500px) {
    .cell
  {
    width:20%;
    margin-top:-10px; 
  }
  .row
  {
    margin-top:-6px; 
  }

  }
</style>





