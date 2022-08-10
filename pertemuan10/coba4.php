<?php

// break
echo "<h1>Break</h1>";
for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        break;
    }

    echo "Nilai i : ", $i, "<br>";
}

echo "<br>";
//continue
echo "<h1>Continue</h1>";
for ($i = 1; $i <= 10; $i++) {
    if ($i == 2) {
        continue;
    }

    echo "Nilai i : ", $i, "<br>";
}


echo "<br>";
//Exit
echo "<h1>Exit</h1>";
for ($i = 1; $i <= 10; $i++) {
    if ($i == 3) {
        exit();
    }

    echo "Nilai i : ", $i, "<br>";
}

echo "Ini Tidak akan jalan, karena sudah exit dari program";
