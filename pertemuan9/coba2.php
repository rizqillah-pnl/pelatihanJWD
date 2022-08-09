<?php
function do_print()
{
    echo time();
}

do_print();

echo "<br>";

function jumlah($a, $b)
{
    return $a + $b;
}

echo "Jumlah 5 + 5 = ", jumlah(5, 5);
