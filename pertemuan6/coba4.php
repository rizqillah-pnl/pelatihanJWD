<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switc</title>
</head>

<body>
    <script>
        let bulan = prompt("Masukkan Bulan : (1 sampai 12)");
        let namaBulan = "";

        switch (bulan) {
            case "1":
                namaBulan = "Bulan Januari";
                break;
            case "2":
                namaBulan = "Bulan Februari";
                break;
            case "3":
                namaBulan = "Bulan Maret";
                break;
            case "4":
                namaBulan = "Bulan April";
                break;
            case "5":
                namaBulan = "Bulan Mei";
                break;
            case "6":
                namaBulan = "Bulan Juni";
                break;
            case "7":
                namaBulan = "Bulan Juli";
                break;
            case "8":
                namaBulan = "Bulan Agustus";
                break;
            case "9":
                namaBulan = "Bulan September";
                break;
            case "10":
                namaBulan = "Bulan Oktober";
                break;
            case "11":
                namaBulan = "Bulan November";
                break;
            case "12":
                namaBulan = "Bulan Desember";
                break;
            default:
                document.write("Opps! Inputan Anda Tidak Ada!");
        }

        if (namaBulan == "") {
            document.write("<p>Bulan Tidak Diinput!</p>");
        } else {
            document.write(`<h2>${namaBulan}</h2>`);
        }
    </script>
</body>

</html>