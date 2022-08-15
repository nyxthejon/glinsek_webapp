
<?php

function alert($msg)
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://glinsekapp.stalaglinsek.si/';
    </script>");
}

require 'baza.php';
$id = $_POST['ajdi'];
$conn = OpenCon();

if(isset($_POST['iz']))
{
    $del = "DELETE FROM zaposleni_rezervacije WHERE rezervacija_id =".$id.";";
    $result = $conn->query($del);
    $del = "DELETE FROM rezervacije WHERE rezervacija_id =".$id.";";
    $result = $conn->query($del);
    alert("uspešno izbrisano");

}
else
{
$del = "DELETE FROM zaposleni_rezervacije WHERE rezervacija_id =".$id.";";
        $result = $conn->query($del);
if(isset($_POST['choice']))
{
    $l = $_POST['choice'];
    foreach($l as $iz) {
        $ins = "INSERT INTO zaposleni_rezervacije VALUES(".$iz.",".$id.");";
        $result = $conn->query($ins);
        }
}

$date = $_POST['datum'];
$do = $_POST['time'];
$up = "UPDATE rezervacije SET cas='$date', do_kdaj ='$do' where rezervacija_id = ".$id.";";
$result = $conn->query($up);
echo $result;
if($result)
{
    alert("Uspešno posodobljeno");
}
else
{
    alert("Napaka pri posodobitvi");
}
}
