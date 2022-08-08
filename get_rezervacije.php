

<?php



require 'baza.php';

$conn = OpenCon();

if(isset($_GET['datum']))
{
    $datu = explode("/", $_GET['datum']);
    $datum = $datu[2]."-".$datu[0]."-".$datu[1];
    ?>
    
    
<?php 
$sql = "SELECT * FROM rezervacije join stranke using(stranka_id) join kupljene_ure on kupljene_ure.ku_id = rezervacije.kupljena_dejavnost_id join dejavnosti using(dejavnost_id) where date(cas) = '$datum';";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
echo "<div class='row'>";
echo "<div class='cell' data-title='Dejavnost'>".$row['naslov_dejavnosti']."</div>";
echo "<div class='cell' data-title='cas'>".$row['cas']."</div>";

$zaposlenisql = "SELECT * FROM zaposleni_rezervacije join zaposleni using(zaposlen_id) WHERE rezervacija_id = ".$row['rezervacija_id'].";";
$re = $conn->query($zaposlenisql);
$kdo = "";
while($r = $re->fetch_assoc())
{
$kdo = $kdo." ".$r['zaposleni_ime']; 
}
if($kdo == "")
$kdo = "Ni določeno";
echo "<div class='cell' data-title='Kdo dela'>".$kdo."</div>";
echo "<div class='cell' data-title='Stranka'>".$row['ime']." ".$row['priimek']."</div>";
if($row['opombe'] == "")
echo "<div class='cell' data-title='Opomba'>Ni Opomb</div>";
else
echo "<div class='cell' data-title='Opomba'>".$row['opombe']."</div>";

echo "<div class='cell' data-title='Več'>";
echo "<form action='uredi_rezervacijo.php' method='post'>";
echo "<input type='hidden' name='id' value =".$row['rezervacija_id'].">";


echo "<input type='submit' value='Več'>";
echo "</form>";
echo "</div>";
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





<?php
}
else
{
$cal = [];

$sql = "SELECT * FROM rezervacije r join kupljene_ure ku on ku.ku_id = r.kupljena_dejavnost_id join dejavnosti d using(dejavnost_id); ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
    $event = new stdClass();
    $event->id= $row['rezervacija_id'];
    $event->name = $row['naslov_dejavnosti'];
    $event->date = $row['cas'];
    $event->type="event";
    $event->badge=$row['za_koga'];
    array_push($cal,$event);
}


$myJSON = json_encode($cal);
echo $myJSON;

}
?>
