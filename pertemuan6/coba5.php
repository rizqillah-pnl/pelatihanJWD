<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Ternary</title>
</head>

<body>
    <script>
        let jwb = prompt("Masukkan Jawaban");

        let jawaban = (jwb.toUpperCase == "IYA") ? "Benar" : "Salah";

        document.write(`Jawaban anda : <b>${jawaban}</b>`);
    </script>
</body>

</html>