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



class Stranke {

    public $ime;
    public $priimek;
    public $email;
    public $telefon;
    public $naslov;
    public $kid;



    function __construct($ime,$priimek,$email,$telefon,$naslov,$kid) {
        $this->ime = $ime;
        $this->priimek = $priimek;
        $this->email = $email;
        $this->telefon = $telefon;
        $this->naslov = $naslov;
        $this->kid = $kid;
      }


      public function getIme() {
        return $this->ime;
      }
      public function getPriimek() {
        return $this->priimek;
      }
      public function getEmail() {
        return $this->email;
      }
      public function getTelefon() {
        return $this->telefon;
      }
      public function getNaslov() {
        return $this->naslov;
      }
      public function getKid() {
        return $this->kid;
      }

}


if(isset($_POST['dejavnost_skupina']))
{
$arraystrank[] = array();
if(!empty($_POST['im_ena']) && !empty($_POST['pr_ena']) && !empty($_POST['email_ena']) && !empty($_POST['phone_ena']) && !empty($_POST['naslov_ena']) && !empty($_POST['posta_ena']))
{
    $str = new Stranke($_POST['im_ena'],$_POST['pr_ena'],$_POST['email_ena'],$_POST['phone_ena'],$_POST['naslov_ena'],$_POST['posta_ena']);
    $arraystrank[0] = $str;


    if(!empty($_POST['im_druga']))
    {
        if(!empty($_POST['pr_druga']) && !empty($_POST['email_druga']) && !empty($_POST['phone_druga']) && !empty($_POST['naslov_druga']) && !empty($_POST['posta_druga']))
        {
            $str = new Stranke($_POST['im_druga'],$_POST['pr_druga'],$_POST['email_druga'],$_POST['phone_druga'],$_POST['naslov_druga'],$_POST['posta_druga']);
          
            $arraystrank[1] = $str;


                if(!empty($_POST['im_tretja']))
                {
                    if(!empty($_POST['im_tretja']) && !empty($_POST['pr_tretja']) && !empty($_POST['email_tretja']) && !empty($_POST['phone_tretja']) && !empty($_POST['naslov_tretja']) && !empty($_POST['posta_tretja']))
                    {
                        $str = new Stranke($_POST['im_tretja'],$_POST['pr_tretja'],$_POST['email_tretja'],$_POST['phone_tretja'],$_POST['naslov_tretja'],$_POST['posta_tretja']);
                        $arraystrank[2] = $str;


                    
                        if(!empty($_POST['im_cetrta']))
                        {
                            if(!empty($_POST['im_cetrta']) && !empty($_POST['pr_cetrta']) && !empty($_POST['email_cetrta']) && !empty($_POST['phone_cetrta']) && !empty($_POST['naslov_cetrta']) && !empty($_POST['posta_cetrta']))
                            {
                            $str = new Stranke($_POST['im_cetrta'],$_POST['pr_cetrta'],$_POST['email_cetrta'],$_POST['phone_cetrta'],$_POST['naslov_cetrta'],$_POST['posta_cetrta']);
                            
                            $arraystrank[3] = $str;

                             }
                             else
                             {
                                alert("Vnesite vse podatke za cetrto stranko");
                             }
                        }
                    }
                    else
                    {
                        alert("Vnesite vse podatke za tretjo stranko");
                    }
            
                }
        }
        else
        {
            alert("Vnesite vse podatke za drugo stranko");
        }
        
    }
}
else
{
    alert("Vnesite vse podatke za prvo stranko");
}

$bol = 1;
$idarray = array();

// vnasanje strank
foreach($arraystrank as $a)
{
    //preveri ce ze obstaja
    $sql = "SELECT stranka_id,COUNT(*) as 'st' FROM `stranke` WHERE email = '".$a->getEmail()."' and telefon = '".$a->getTelefon()."';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // ze obstaja stranka
    if ($row['st'] > 0)
    {
    array_push($idarray, $row['stranka_id']);
    }
    // se ne obstaja
    else
    {

        $insert = "INSERT INTO stranke VALUES('NULL','".$a->getIme()."','".$a->getPriimek()."','".$a->getEmail()."','".$a->getTelefon()."','".$a->getKid()."','".$a->getNaslov()."');";
        $resultin = $conn->query($insert);
        if($resultin)
        {
        
            echo "Vnos stranke uspešen";
            $sql = "SELECT stranka_id FROM `stranke` WHERE email = '".$a->getEmail()."' and telefon = '".$a->getTelefon()."';";
            $result = $conn->query($sql);
            $rowid = $result->fetch_assoc();
            array_push($idarray, $rowid['stranka_id']);
        }
        else
        {

            $bol = 0;
            alert("Napaka pri vnosu stranke ".$a->getIme()." ");
        }
    }
}

//vnasanje skupine
if($bol == 1)
{
$sarray = $idarray;
while(count($sarray)<4)
{
    array_push($sarray,"NULL");
}

$insertskupino = "INSERT INTO skupine VALUES('NULL',".$sarray[0].",".$sarray[1].",".$sarray[2].",".$sarray[3].");";
$re = $conn->query($insertskupino);
if($re){

    switch(count($idarray))
    {
    case 1:
        $skupinaid = "SELECT * from skupine where stranka1_id = ".$sarray[0]." and stranka2_id is null and stranka3_id is null and stranka4_id is null ORDER BY skupina_id desc LIMIT 1 ;";

        break;
    case 2:
        $skupinaid = "SELECT * from skupine where stranka1_id = ".$sarray[0]." and stranka2_id = ".$sarray[1]." and stranka3_id is null and stranka4_id is null ORDER BY skupina_id desc LIMIT 1 ;";

        break;
    case 3:
        $skupinaid = "SELECT * from skupine where stranka1_id = ".$sarray[0]." and stranka2_id = ".$sarray[1]." and stranka3_id = ".$sarray[2]." and stranka4_id is null ORDER BY skupina_id desc LIMIT 1 ;";

        break;
    case 4:
        $skupinaid = "SELECT * from skupine where stranka1_id = ".$sarray[0]." and stranka2_id = ".$sarray[1]." and stranka3_id = ".$sarray[2]." and stranka4_id = ".$sarray[3]." ORDER BY skupina_id desc LIMIT 1 ;";

        break;

    }
    $rid = $conn->query($skupinaid);
    $idrow = $rid->fetch_assoc();
    echo $idrow['skupina_id'];
    

    $dejavnostinfo = "SELECT * from dejavnosti where dejavnost_id = ".$_POST['dejavnost_skupina'].";";

    $dinfo = $conn->query($dejavnostinfo);
    $din = $dinfo->fetch_assoc();
    
    $nap = 0;
    foreach($idarray as $idm)
    {
        $kupis = "INSERT INTO kupljene_ure VALUES('NULL','".$idm."','".$din['dejavnost_id']."','".$din['vsebovane_ure']."','".$din['dejavnost_id']."','".date("Y-m-d")."','zase','".$din['cena']."','".$din['cena']."',".$idrow['skupina_id'].")";
        $nak = $conn->query($kupis);
        if(!$nak)
        {
        $nap = 1;
          
        }
       

    }

    if($nap == 1)
    {
        foreach($idarray as $nid)
        {
        $del = "DELETE FROM  kupljene_ure WHERE stranka_id = '".$nid."' and dejavnost_id = '".$din['dejavnost_id']."' and datum_nakupa = '".date("Y-m-d")."' and skupina_id = ".$idrow['skupina_id'].";";
        $n = $conn->query($del);
        }
        alert("Napaka pri vnosu ur");
    }
    else
    {
        alert("Uspešno");
    }
   


}
else
{
    alert("Napaka pri ustvarjanju skupine");
}





}



}
else if(isset($_POST['id_preveri']))
{
echo $_POST['id_preveri'];
$id = $_POST['id_preveri'];
$dejavnost = $_POST['dejavnost'];
$za = $_POST['za'];
$k = $_POST['kolicina'];
$cena = cena_dejavnosti($dejavnost,$conn,$k);
$ure = izracunajure($dejavnost,$k,$conn);
$kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$id."','$dejavnost','$ure','$ure','".date("Y-m-d")."','$za','$cena','$cena',0)";
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
   $kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$row['stranka_id']."','$did','$u','$u','".date("Y-m-d")."','$za','$cena','$cena',0)";
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
        $kupi_ure = "INSERT INTO kupljene_ure VALUES('NULL','".$row['stranka_id']."','$did','$u','$u','".date("Y-m-d")."','$za','$cena','$cena',0)";
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

