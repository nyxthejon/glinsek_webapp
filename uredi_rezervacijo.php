<!DOCTYPE html>
<html>
<head>
<title>Pregled Rezervacije</title>
<style>
    html {
  -webkit-font-smoothing: antialiased;
}

body {
  background-color: wheat;
  font-family: "Titillium Web", sans-serif;
}
@media screen and (min-width: 40em) {
  body {
    font-size: 1.25em;
  }
}

.form .button, .form .message, .customSelect, .form .select, .form .textarea, .form .text-input, .form .option-input + label, .form .checkbox-input + label, .form .label {
  padding: 0.75em 1em;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: none;
  line-height: normal;
  border-radius: 0;
  border: none;
  background: none;
  display: block;
}

.form .label {
  font-weight: bold;
  color: black;
  padding-top: 0;
  padding-left: 0;
  letter-spacing: 0.025em;
  font-size: 1.125em;
  line-height: 1.25;
  position: relative;
  z-index: 100;
}
.required .form .label:after, .form .required .label:after {
  content: " *";
  color: #E8474C;
  font-weight: normal;
  font-size: 0.75em;
  vertical-align: top;
}

.customSelect, .form .select, .form .textarea, .form .text-input, .form .option-input + label, .form .checkbox-input + label {
  font: inherit;
  line-height: normal;
  width: 100%;
  box-sizing: border-box;
  background: #222222;
  color: white;
  position: relative;
}
.customSelect:placeholder, .form .select:placeholder, .form .textarea:placeholder, .form .text-input:placeholder, .form .option-input + label:placeholder, .form .checkbox-input + label:placeholder {
  color: white;
}
.customSelect:-webkit-autofill, .form .select:-webkit-autofill, .form .textarea:-webkit-autofill, .form .text-input:-webkit-autofill, .form .option-input + label:-webkit-autofill, .form .checkbox-input + label:-webkit-autofill {
  box-shadow: 0 0 0px 1000px #111111 inset;
  -webkit-text-fill-color: white;
  border-top-color: #111111;
  border-left-color: #111111;
  border-right-color: #111111;
}
.customSelect:not(:focus):not(:active).error, .form .select:not(:focus):not(:active).error, .form .textarea:not(:focus):not(:active).error, .form .text-input:not(:focus):not(:active).error, .form .option-input + label:not(:focus):not(:active).error, .form .checkbox-input + label:not(:focus):not(:active).error, .error .customSelect:not(:focus):not(:active), .error .form .select:not(:focus):not(:active), .form .error .select:not(:focus):not(:active), .error .form .textarea:not(:focus):not(:active), .form .error .textarea:not(:focus):not(:active), .error .form .text-input:not(:focus):not(:active), .form .error .text-input:not(:focus):not(:active), .error .form .option-input + label:not(:focus):not(:active), .form .error .option-input + label:not(:focus):not(:active), .error .form .checkbox-input + label:not(:focus):not(:active), .form .error .checkbox-input + label:not(:focus):not(:active) {
  background-size: 8px 8px;
  background-image: linear-gradient(135deg, rgba(232, 71, 76, 0.5), rgba(232, 71, 76, 0.5) 25%, transparent 25%, transparent 50%, rgba(232, 71, 76, 0.5) 50%, rgba(232, 71, 76, 0.5) 75%, transparent 75%, transparent);
  background-repeat: repeat;
}
.form:not(.has-magic-focus) .customSelect.customSelectFocus, .form:not(.has-magic-focus) .customSelect:active, .form:not(.has-magic-focus) .select:active, .form:not(.has-magic-focus) .textarea:active, .form:not(.has-magic-focus) .text-input:active, .form:not(.has-magic-focus) .option-input + label:active, .form:not(.has-magic-focus) .checkbox-input + label:active, .form:not(.has-magic-focus) .customSelect:focus, .form:not(.has-magic-focus) .select:focus, .form:not(.has-magic-focus) .textarea:focus, .form:not(.has-magic-focus) .text-input:focus, .form:not(.has-magic-focus) .option-input + label:focus, .form:not(.has-magic-focus) .checkbox-input + label:focus {
  background: #4E4E4E;
}

.form .message {
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: 100;
  font-size: 0.625em;
  color: white;
}

.form .option-input, .form .checkbox-input {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}
.form .option-input + label, .form .checkbox-input + label {
  display: inline-block;
  width: auto;
  color: #4E4E4E;
  position: relative;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  cursor: pointer;
}
.form .option-input:focus + label, .form .checkbox-input:focus + label, .form .option-input:active + label, .form .checkbox-input:active + label {
  color: #4E4E4E;
}
.form .option-input:checked + label, .form .checkbox-input:checked + label {
  color: white;
}

.form .button {
  font: inherit;
  line-height: normal;
  cursor: pointer;
  background: #E8474C;
  color: white;
  font-weight: bold;
  width: auto;
  margin-left: auto;
  font-weight: bold;
  padding-left: 2em;
  padding-right: 2em;
}
.form .button:hover, .form .button:focus, .form .button:active {
  color: white;
  border-color: white;
}
.form .button:active {
  position: relative;
  top: 1px;
  left: 1px;
}

body {
  padding: 2em;
}

.form {
  max-width: 40em;
  margin: 0 auto;
  position: relative;
  display: flex;
  flex-flow: row wrap;
  justify-content: space-between;
  align-items: flex-end;
}
.form .field {
  width: 100%;
  margin: 0 0 1.5em 0;
}
@media screen and (min-width: 40em) {
  .form .field.half {
    width: calc(50% - 1px);
  }
}
.form .field.last {
  margin-left: auto;
}
.form .textarea {
  max-width: 100%;
}
.form .select {
  text-indent: 0.01px;
  text-overflow: "" !important;
}
.form .select::-ms-expand {
  display: none;
}
.form .checkboxes, .form .options {
  padding: 0;
  margin: 0;
  list-style-type: none;
  overflow: hidden;
}
.form .checkbox, .form .option {
  float: left;
  margin: 1px;
}
.customSelect {
  pointer-events: none;
}
.customSelect:after {
  content: "";
  pointer-events: none;
  width: 0.5em;
  height: 0.5em;
  border-style: solid;
  border-color: white;
  border-width: 0 3px 3px 0;
  position: absolute;
  top: 50%;
  margin-top: -0.625em;
  right: 1em;
  transform-origin: 0 0;
  transform: rotate(45deg);
}
.customSelect.customSelectFocus:after {
  border-color: white;
}
.magic-focus {
  position: absolute;
  z-index: 0;
  width: 0;
  pointer-events: none;
  background: rgba(255, 255, 255, 0.15);
  transition: top 0.2s, left 0.2s, width 0.2s;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  transform-style: preserve-3d;
  will-change: top, left, width;
  transform-origin: 0 0;
}
</style>
</head>
<body>
<?php
require 'baza.php';

$conn = OpenCon();
$sql = "SELECT * FROM rezervacije join stranke using(stranka_id) join kupljene_ure on kupljene_ure.ku_id = rezervacije.kupljena_dejavnost_id join dejavnosti using(dejavnost_id) where rezervacija_id =".$_POST['id'].";";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>





<form action='ureditevrez.php' class='form' method='post'>
  <p class='field required'>
    <label class='label required' for='name'>Stranka</label>
    <input class='text-input' id='name' disabled name='name' required type='text' value='<?php echo $row["ime"]." ".$row['priimek']; ?>'>
  </p>
  
  <p class='field half'>
    <label class='label' for='phone'>Telefon</label>
    <input class='text-input' id='phone' disabled name='phone' type='phone' value='<?php echo $row["telefon"];?>'>
  </p>
  <p class='field  half'>
    <label class='label' for='email'>E-mail</label>
    <input class='text-input' id='email' disabled  name='email' required type='email' value='<?php echo $row["email"];?>'>
  </p>
  <p class='field required half'>
    <label class='label' for='date'>Čas</label>
    <input type="datetime-local" class='date' id='date' name='datum' value='<?php echo $row["cas"];?>'>
  </p>
  
  <input type='hidden' name='ajdi' value='<?php echo $_POST['id']; ?>'>
  <p class='field required half'>
    <label class='label' for='time'>Do</label>
    <input type="time" class='time' id='time' name='time' value='<?php echo $row["do_kdaj"];?>'>
  </p>
  <p class='field half  error'>
    <label class='label' for='dejavnost'>Dejavnost ki je rezervirana</label>
    <input class='text-input' id='dejavnost' name='dejavnost' required type='text' value='<?php echo $row["naslov_dejavnosti"];?>'>
  </p>
 
  <div class='field required'>
    <label class='label'>Kdo dela?</label>
    <ul class='checkboxes'>
      
    <?php 
$zaposlenisql = "select * from zaposleni";
$re = $conn->query($zaposlenisql);
while($r = $re->fetch_assoc())
{
   $check = "SELECT rezervacija_id from zaposleni_rezervacije where rezervacija_id = ".$row['rezervacija_id']." and zaposlen_id = ".$r['zaposlen_id'].";";
   $num = $conn->query($check);
   echo  " <li class='checkbox'>";
    if(mysqli_num_rows($num) == 0)   
    echo "<input type='checkbox' class='checkbox-input'  id='choice-".$r['zaposlen_id']."'   for='".$r['zaposlen_id']."' name='choice[]' type='checkbox' value='".$r['zaposlen_id']."'>";
   else
   echo "<input type='checkbox' class='checkbox-input' checked  id='choice-".$r['zaposlen_id']."'   for='".$r['zaposlen_id']."' name='choice[]' type='checkbox' value='".$r['zaposlen_id']."'>";

    echo "<label class='checkbox-label' for='choice-".$r['zaposlen_id']."' >".$r['zaposleni_ime']."</label>";
    echo "</li>";

   
}
     ?> 
    </ul>
  </div>
  <p class='field'>
    <label class='label' for='opombe'>Opombe</label>
    <textarea class='textarea' cols='50' id='about' name='about' rows='4' value='<?php echo $row["opombe"];?>'></textarea>
  </p>
  
  <p class='field half'>
    <input class='button' type='submit' value='Shrani'>
    
  </p>
</form>
  <form action='ureditevrez.php' class='form' method='post'>
  <input type='hidden' name='iz' value = 'izbrisi'>
  <input type='hidden' name='ajdi' value = '<?php echo $_POST["id"]; ?>'>
  <p class='field half'>
    <input class='button' type='submit' value='Izbriši rezervacijo'>
  </p>
</form>


</body>
</html>
