<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

function init() {
    require(__DIR__.'/../config.php');
    $client = new InfluxDB\Client($dbHost, $dbPort, $dbUsername, $dbPapassword);
    // fetch the database
    return $client->selectDB($dbName);
}

function getLastInsert(String $salle) {
    $database = init();
    $query = 'SELECT * FROM '.$salle.' ORDER BY time DESC LIMIT 1;';
    $result = $database->query($query);
    $points = $result->getPoints();
    return $points;
}

function getLastHourMean(String $salle) {
    $database = init();
    $query = 'select mean(*) FROM '.$salle.' WHERE time > now()-1h';
    $result = $database->query($query);
    $points = $result->getPoints();

    return $points;
}

function adaptPointSerie($points, $salle, $consomationPrefix='') {

    $testOrigin = getLastInsert($salle);
    $real = true;
    foreach ($testOrigin as $s) {
        if($s['dataOrigin'] == 'simulation') {
            $real = false;
        }
    }

    $result = [];
    foreach ($points as $p) {
        $p['dataOrigin'] = ($real) ? 'real' : 'simulation';
        array_push($result, adaptPoint($p, $consomationPrefix));
    }
    return $result;
}

function adaptPoint($point, $consomationPrefix='') {
    $result['dataOrigin'] = $point['dataOrigin'];

    date_default_timezone_set('Europe/Paris');
    $divided = explode('T', $point['time']);
    $dt = $divided[0];
    $hr = explode('.', $divided[1])[0];
    $dttime = new DateTime();
    $dttime->setTimestamp(strtotime($dt.' '.$hr));
    $dttime->add(new DateInterval('PT1H'));
    $result['time'] = $dttime;

    $result['negative_active_power_W'] = (array_key_exists('negative_active_power_W', $point)) ? $point['negative_active_power_W'] : null;
    $result['negative_reactive_power_VAR'] = (array_key_exists('negative_reactive_power_VAR', $point)) ? $point['negative_reactive_power_VAR'] : null;
    $result['positive_active_power_W'] = (array_key_exists('positive_active_power_W', $point)) ? $point['positive_active_power_W'] : null;
    $result['positive_reactive_power_VAR'] = (array_key_exists('positive_reactive_power_VAR', $point)) ? $point['positive_reactive_power_VAR'] : null;
    $result['sum_negative_active_energy_Wh'] = (array_key_exists('sum_negative_active_energy_Wh', $point)) ? $point['sum_negative_active_energy_Wh'] : null;
    $result['sum_negative_reactive_energy_VARh'] = (array_key_exists('sum_negative_reactive_energy_VARh', $point)) ? $point['sum_negative_reactive_energy_VARh'] : null;
    $result['sum_positive_active_energy_Wh'] = (array_key_exists('sum_positive_active_energy_Wh', $point)) ? $point['sum_positive_active_energy_Wh'] : null;
    $result['sum_positive_reactive_energy_VARh'] = (array_key_exists('sum_positive_reactive_energy_VARh', $point)) ? $point['sum_positive_reactive_energy_VARh'] : null;

    if ($result['dataOrigin'] == 'simulation') {
        $result['sum_positive_active_energy_Wh'] = $point[$consomationPrefix.'consomation'];
    }

    return $result;
}

// $a = getLastInsert("/B_10[0-9]/");
// echo '<pre>';
// var_dump(adaptPointSerie($a));
// echo '</pre>';