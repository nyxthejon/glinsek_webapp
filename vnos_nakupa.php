<?php
include 'baza.php';
$ime = $_POST['ip'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$naslov = $_POST['naslov'];
$kid = $_POST['posta'];
$did = $_POST['dejavnost'];
$za = $_POST['za'];
$k = $_POST['kolicina'];


function izracunajure($did,$k,$conn)
{
    $ure = "select vsebovane_ure from dejavnosti where dejavnost_id = '$did'";
    $result = $conn->query($ure);
    $row = $result->fetch_assoc();
    return $row['vsebovane_ure'] * $k;
}

function alert($msg)
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://glinsekapp.stalaglinsek.si/';
    </script>");
}

$conn = OpenCon();
$sql = "SELECT stranka_id,COUNT(*) as 'st' FROM `stranke` WHERE email = '$email' and telefon = '$phone'" ;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$u = izracunajure($did,$k,$conn);

// ze obstaja stranka
if ($row['st'] > 0)
{
   $kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$row['stranka_id']."','$did','$u','".date("Y-m-d")."','$za')";
   $nakrez = $conn->query($kupi_ure);
   if($nakrez)
   {
    
    alert("Uspešno dodane ure");
   }
   else
   {
    alert("Napaka pri dodajanju ur obsotječi stranki");
   }

}
// se ne obstaja
else
{
    $insert = "INSERT INTO stranke VALUES('NULL','$ime','$email','$phone','$kid')";
    $result = $conn->query($insert);
    if($result)
    {
        echo "Vnos stranke uspešen";
        $sql = "SELECT stranka_id FROM `stranke` WHERE email = '$email' and telefon = '$phone'" ;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$row['stranka_id']."','$did','$u','".date("Y-m-d")."','$za')";
        $nakrez = $conn->query($kupi_ure);

        if($nakrez)
        {
            alert("Uspešno dodana stranka in ure");
        }
        else
        {
            alert("Napaka pri nakupu ur");
            
        }
    }
    else
    {
        alert("Napaka pri vnosu stranke");
    }
}

