<?php
require 'baza.php';



function alert($msg)
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='http://glinsekapp.stalaglinsek.si/';
    </script>");
}

if($_POST['tip'] == "jahanje")
{
    $stranka = $_POST['i_stranka'];
    $dejavnost = $_POST['i_paket_s'];
    $datum = $_POST['datum_jahanja'];
    $dokdaj = $_POST['cas'];
    if(isset($_POST['opomba']))
    {
    $opomba = $_POST['opomba'];
    }
    else
    {
    $opomba = "";
    }
    $zap = $_POST['zaposleni'];

    
    $conn = OpenCon();
    $sql = "INSERT INTO rezervacije() VALUES ('NULL','NULL','$dejavnost','$datum','$dokdaj','$stranka','NULL','NULL','$opomba') ";
    $result = $conn->query($sql);
    if($result)
    {
    foreach ($zap as $z)
    {
        if($z == 'ni znano')
        {
            alert("Uspešno rezervirano");
        }
        else
        {
          
          
            $sqlselect = "SELECT rezervacija_id FROM rezervacije where kupljena_dejavnost_id = ".$dejavnost." and cas = '".$datum."' and stranka_id = ".$stranka.";";
            $result = $conn->query($sqlselect);
            $row = $result->fetch_assoc();
            
            
            $ins = "INSERT INTO zaposleni_rezervacije VALUES(".$z.",".$row['rezervacija_id'].");";
            $rez = $conn->query($ins);

            if($rez)
            {
                alert("Uspešno rezervirano");
            }
            else
            {
                alert("Napaka pri rezervaciji");
            }
        }
    }
    }
}