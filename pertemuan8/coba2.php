<?php
$now =  date('Y');

function hitungUmur($thnLahir, $now)
{
    return $now - $thnLahir;
}


echo "Umur Saya Sekarang : " . hitungUmur(2001, $now) . " Tahun";
