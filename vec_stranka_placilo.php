<?php 
require 'header.php';


function alert($msg, $id)
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://glinsekapp.stalaglinsek.si/vec_stranka.php?id=$id';
    </script>");
    
}

$sid = $_GET['sid']; 
$conn = OpenCon();


if(isset($_GET['ku_id']) && isset($_GET['placilo']))
{
$id = $_GET['ku_id'];
$pl = $_GET['placilo']; 
 $sql = "UPDATE kupljene_ure set za_placati = za_placati - ".$pl." where ku_id = ".$id." ;";
  $result = $conn->query($sql);

  if($result)
  {
    alert("Uspešno plačilo", $sid);
  }
  else
  {
    alert("Napaka pri plačilu", $sid);
  }
}
else if(isset($_GET['im']) && isset($_GET['pr']) && isset($_GET['email']) && isset($_GET['phone']))
{
$im = $_GET['im'];
$pri = $_GET['pr'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$naslov = $_GET['naslov'];
$post = $_GET['posta'];

$sql = "UPDATE stranke set ime ='".$im."', priimek = '".$pri."', email = '".$email."', telefon = '".$phone."', naslov='".$naslov."',k_id = ".$post." where stranka_id = ".$sid.";";
$result = $conn->query($sql);
if($result)
  {
    alert("Uspešno posodobljen", $sid);
  }
  else
  {
    alert("Napaka pri posodobitvi", $sid);
  }
}




