<?php
include 'baza.php';
$conn = OpenCon();


function izracunajure($did,$k,$conn)
{
    $ure = "select vsebovane_ure from dejavnosti where dejavnost_id = '$did'";
    $result = $conn->query($ure);
    $row = $result->fetch_assoc();
    return $row['vsebovane_ure'] * $k;
}

function cena_dejavnosti($did, $conn ,$k)
{
    $cena = "select cena from dejavnosti where dejavnost_id = '$did'";
    $result = $conn->query($cena);
    $row = $result->fetch_assoc();
    return $row['cena'] * $k;
}



function alert($msg)
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://glinsekapp.stalaglinsek.si/';
    </script>");
}


if(isset($_POST['id_preveri']))
{
echo $_POST['id_preveri'];
$id = $_POST['id_preveri'];
$dejavnost = $_POST['dejavnost'];
$za = $_POST['za'];
$k = $_POST['kolicina'];
$cena = cena_dejavnosti($dejavnost,$conn,$k);
$ure = izracunajure($dejavnost,$k,$conn);
$kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$id."','$dejavnost','$ure','$ure','".date("Y-m-d")."','$za','$cena','$cena')";
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
else
{
$ime = $_POST['im'];
$priimek = $_POST['pr'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$naslov = $_POST['naslov'];
$kid = $_POST['posta'];
$did = $_POST['dejavnost'];
$za = $_POST['za'];

if($za = 'zase')
{
    $za = $ime." ".$priimek;
}
$k = $_POST['kolicina'];

$sql = "SELECT stranka_id,COUNT(*) as 'st' FROM `stranke` WHERE email = '$email' and telefon = '$phone'" ;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$u = izracunajure($did,$k,$conn);
$cena = cena_dejavnosti($did,$conn,$k);

// ze obstaja stranka
if ($row['st'] > 0)
{
   $kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$row['stranka_id']."','$did','$u','$u','".date("Y-m-d")."','$za','$cena','$cena')";
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
    $insert = "INSERT INTO stranke VALUES('NULL','$ime','$priimek','$email','$phone','$kid','$naslov')";
    $result = $conn->query($insert);
    if($result)
    {
        echo "Vnos stranke uspešen";
        $sql = "SELECT stranka_id FROM `stranke` WHERE email = '$email' and telefon = '$phone'" ;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$row['stranka_id']."','$did','$u','$u','".date("Y-m-d")."','$za','$cena','$cena')";
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
}

