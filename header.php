<!DOCTYPE html>
<html lang="sl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Stranke</title>
    <style>
        ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
    </style>
</head>
<body>
    <?php require 'baza.php' ?>
    <ul>
        <li><a href="index.php">Rezervacije</a></li>
        <li><a href="stranke.php">Stranke</a></li>
        <li><a href="pretekle.php">Pregled</a></li>


      </ul>
    
</body>
</html>