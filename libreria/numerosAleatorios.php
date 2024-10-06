<?php
function numerosRandom()
{
    return rand(1, 9);
}

// Hace un arreglo de 4 números random utilizando la función de arriba
function numerosRecuperacion()
{
    $numeros = [];
    for ($iteracion = 0; $iteracion < 4; $iteracion++) {
        $numeros[] = numerosRandom();  // Almacena cada número en el array
    }
    return $numeros;
}
?>