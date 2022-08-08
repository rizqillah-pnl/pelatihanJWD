<?php
function perkenalan($nama, $salam = "Selamat Siang")
{
    echo $salam . ", ";
    echo "Perkenalkan, Nama Saya " . $nama . "<br>";
    echo "Senang Berkenalan Dengan Anda!<br>";
}

perkenalan("Rizqillah", "Halo");

// Tanpa Salam
perkenalan("Rizqillah");
