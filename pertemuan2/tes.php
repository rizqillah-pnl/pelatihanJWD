<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

    <?php
    // $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
    // $xml = file_get_contents("https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-Aceh.xml");
    // // $xml = new SimpleXMLElement('https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-Aceh.xml', 0, TRUE);
    // $json = json_encode($xml);
    // $array = json_decode($json, TRUE);
    // print_r($array);


    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, "https://cuaca.umkt.ac.id/api/cuaca/DigitalForecast-Aceh.xml");

    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // $result = curl_exec($curl);
    // curl_close($curl);

    // $result = json_encode($result);
    // $result = json_decode($result, true);

    // echo $result;

    ?>


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        var elems = document.querySelectorAll('#modal');
        var instances = M.Modal.init(elems);
    </script>



    <script>
        x = 10;
        let x;
        console.log(x);
    </script>
</body>

</html>