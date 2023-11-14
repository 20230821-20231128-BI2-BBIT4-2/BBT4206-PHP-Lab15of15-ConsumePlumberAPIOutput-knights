<?php
$apiUrl = 'http://127.0.0.1:5022/diabetes';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arg_pregnant = $_POST['arg_pregnant'];
    $arg_glucose = $_POST['arg_glucose'];
    $arg_pressure = $_POST['arg_pressure'];
    $arg_triceps = $_POST['arg_triceps'];
    $arg_insulin = $_POST['arg_insulin'];
    $arg_mass = $_POST['arg_mass'];
    $arg_pedigree = $_POST['arg_pedigree'];
    $arg_age = $_POST['arg_age'];

    $params = array(
        'arg_pregnant' => $arg_pregnant,
        'arg_glucose' => $arg_glucose,
        'arg_pressure' => $arg_pressure,
        'arg_triceps' => $arg_triceps,
        'arg_insulin' => $arg_insulin,
        'arg_mass' => $arg_mass,
        'arg_pedigree' => $arg_pedigree,
        'arg_age' => $arg_age
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $apiUrl = $apiUrl . '?' . http_build_query($params);
    curl_setopt($curl, CURLOPT_URL, $apiUrl);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error = curl_error($curl);
        die("cURL Error: $error");
    }

    curl_close($curl);

    $data = json_decode($response, true);

    if (isset($data['0'])) {
        echo "The predicted diabetes status is:<br>";
        foreach ($data as $repository) {
            echo $repository['0'], $repository['1'], $repository['2'], "<br>";
        }
    } else {
        echo "API Error: " . $data['message'];
    }
}
?>
