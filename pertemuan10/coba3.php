<?php
$nilai = 80;

switch ($nilai):
    case $nilai >= 85 && $nilai <= 100:
        echo "Nilai A";
        break;
    case $nilai >= 70:
        echo "Nilai B";
        break;
    case $nilai >= 60:
        echo "Nilai C";
        break;
    case $nilai >= 50:
        echo "Nilai D";
        break;
    default:
        echo "Nilai E";
        break;
endswitch;
