<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
</head>
<body>
<form method="post">
<label for="numero">Digite um número:</label>
  <input type="number" name="numero" id="numero">
  <button type="submit" id='numerosubmit'>Enviar</button>
</form>
  <?php
  if (isset($_POST["numero"])) {
    $numero = $_POST["numero"];
    
    print ("O número digitado é: $numero<br><br><br>");
  }
  //incremento
  PRINT("INCREMENTOS<BR>");
  $a = $b=10;
  PRINT("<BR> A variável a vale $a <br>");
  PRINT("<BR> A variável b vale $b <br>");
  $c = $a++;
  print ("<BR> A variável c vale $c <br>");
  PRINT("<BR> A variável a vale $a <br>");
  $d = ++$a;
  print ("<BR> A variável d vale $d <br>");
  PRINT("<BR> A variável a vale $a <br>");
  //condicionais
  PRINT("<BR>CONDICIONAIS - IF<BR>");

  $g = 100;
  $h = 100;

  if($g > $h)
  {
    print("<BR>A variavel g é maior que h<BR>");
  }
  elseif ($g != $h) {
   print("<BR>A Variavel g é diferente de h<BR>");
  }
  else  
  {
    print("<BR>A váriavel g = h<BR>");
  }

  PRINT("<BR>CONDICIONAIS - CASE <br>");
 ?>


<form action=phpescola.php method="post">
<label form="dia">Digite um número referenciando um dia da semana:</label>
  <input type="number" name="dia" id="dia">
  <input type="submit" id='diasemana'>
</form>

<?php

 if(isset($_POST["dia"])) {
  $dia = $_POST["dia"];
  
  switch ($dia) {
    case 1:
      PRINT("<BR>domingo");
      break;
    case 2:
      PRINT("<BR>segunda");
      break;
    case 3:
      PRINT("<BR>terça");
      break;
    default:
   
      break;
  }

}
?>

<hr> 
<?php
$mod = 1341;
if(($mod%3) == 0){
  print("<br>A Variável mod = $mod é divisivel por 3");
}
else{
  print("<br> Não é divisivel por 3");
}
<br>
<br>



print("<h1> Usando for para tabuada em php</h1>");
("<hr size='3' color='#ddff00' ");
 for

?>

</body>
</html>