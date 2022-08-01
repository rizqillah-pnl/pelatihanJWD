<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>If Bercabang</title>
</head>

<body>
    <script>
        let nilai = prompt("Input Nilai : ", 0);

        if (nilai >= 90) grade = "A"
        else if (nilai >= 80) grade = "B+"
        else if (nilai >= 70) grade = "B"
        else if (nilai >= 60) grade = "C+"
        else if (nilai >= 50) grade = "C"
        else if (nilai >= 40) grade = "D"
        else if (nilai >= 30) grade = "E"
        else grade = "F";

        document.write(`<p>Grade anda adalah : <strong>${grade}</strong></p>`);
    </script>
</body>

</html>