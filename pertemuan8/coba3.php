<?php
function hitungUmur($thnLahir, $now)
{
    return $now - $thnLahir;
}


function perkenalan($nama, $salam = "Selamat Siang")
{
    $now =  date('Y');
    echo $salam . ", ";
    echo "Perkenalkan, Nama Saya " . $nama . "<br>";
    echo "Umur Saya : " . hitungUmur(2001, $now) . " Tahun<br>";
    echo "Senang Berkenalan Dengan Anda!<br>";
}

perkenalan("Rizqillah");
