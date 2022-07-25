<?php

function OpenCon()
 {
 $dbhost = "stalaglinsek.si";
 $dbuser = "stalagli_stalauser";
 $dbpass = "Konjkonj123";
 $db = "stalagli_webapp";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Povezava neuspešna: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   