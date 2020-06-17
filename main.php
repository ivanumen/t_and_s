<?php

function rightFormatWithTimeZone($timezone){
    if ($timezone >= 0){
        return "+" . (int)$timezone;
    }
    else
        return (int)$timezone;
}

$input = fopen("input.txt",'r');
$output = fopen("output.txt", 'w');

$format = 'd.m.Y_H:i:sT';

$countFlights = fgets($input);

for($i = 0; $i < (int)$countFlights; $i++){
    $flight = fgets($input);
    $arrayInfo = explode(" ", $flight);
    $timeStart = DateTime::createFromFormat($format, $arrayInfo[0] . rightFormatWithTimeZone($arrayInfo[1]), new DateTimeZone('UTC'))->format("U");
    $timeFinish = DateTime::createFromFormat($format, $arrayInfo[2] . rightFormatWithTimeZone($arrayInfo[3]), new DateTimeZone('UTC'))->format("U");
    
    fwrite($output, ($timeFinish - $timeStart) . "\n");
}

fclose($input);
fclose($output);

?>