<?php

if (isset($_POST['kirim'])) {
    if (!empty($_POST['nama'])) {
        $nama = ucwords($_POST['nama']);
    } else {
        $nama = "Nama Kosong";
    }
    $tahunLahir = $_POST['tahunlahir'];
    $tahunLahir = date('Y', strtotime($tahunLahir));
    $tahunSekarang = date('Y');

    $umur = hitungUmur($tahunLahir, $tahunSekarang);
    perkenalan($nama, $umur);
}

function hitungUmur($thnLahir, $now)
{
    return $now - $thnLahir;
}


function perkenalan($nama, $umur, $salam = "Selamat Siang")
{
    echo "<script>";
    echo "alert('" . $salam . ", Perkenalkan Nama Saya " . $nama . ". Saya " . $umur . " Tahun!');";
    echo "</script>";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">HITUNG UMUR</h1>
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="tahunlahir" class="form-label">Tahun Lahir</label>
                        <input type="date" name="tahunlahir" class="form-control" id="tahunlahir">
                    </div>
                    <button type="submit" class="btn btn-primary" name="kirim">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>