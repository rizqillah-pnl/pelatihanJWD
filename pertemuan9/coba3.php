<?php
function LuasSegitigaSamaKaki($alas, $tinggi)
{
    return (1 / 2) * $alas * $tinggi;
}

$alas = 5;
$tinggi = 8;
echo "<h1>Perhitungan Luas Segitiga Sama Kaki!</h1>";
echo "Alas : ", $alas, "<br>Tinggi : ", $tinggi, "<br>Hasil = ", LuasSegitigaSamaKaki($alas, $tinggi);
