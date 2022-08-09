<?php
function factorial($nilai)
{
    if ($nilai < 2) {
        return 1;
    }

    return ($nilai * factorial($nilai - 1));
}

$nilai = 5;
echo "Faktorial ", $nilai, " = ", factorial($nilai);
