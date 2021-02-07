<?php
header('Content-type:text/plain');

$mensaje = "Hola"; /*"" permite concatenación de variables :\ */
$mensaje2 = 'Mundo!'; /*De preferencia utilizar '' para las cadenas*/

echo $mensaje . ' ' . $mensaje2 . PHP_EOL;//"." es caracter de concatenación (une cadenas)
//Se pueden omitir los espacios pero esto hace más legible el código

$fulano = 'Fulanito';

$mensaje = "Hola $fulano \n";
echo $mensaje;

echo 'Hola $fulano' . PHP_EOL;

echo sprintf('Hola %s%s %1$s %2$s %1$s %2$s %3$s', $fulano, "!","\n"); 
//SIEMPRE QUE SEA POSIBLE UTILIZAR ESTA FUNCION (Es la más segura)

//Heredoc
$str = <<<TEXT
Ejemplo de una cadena 
expandida en varias 'líneas
y admite los caracteres " y ' :3
TEXT;
//distintivo para lo que contiene

echo $str;

$mensajeh = 'vamo a ver qué hace el chop xDD        ';

echo $mensajeh;
echo 'holi1';
echo chop($mensajeh);
echo "holi2 \n";

//chop = rtrim quita los ultimos espacios de la cadena

echo chr(64);

/*
for( $i = 33; $i <= 126; $i++){
    echo chr($i) . "\n";
}
*/


echo chunk_split($str, 4,"@");
