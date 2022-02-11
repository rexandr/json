<?php
function rate()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
    }

    echo '<pre>';
    print_r($jsonArray);
    echo '</pre>';

    $sentence = [];

    $buffer = 'Mar ';

    foreach ($jsonArray as $arr) {
        foreach ($arr as $value) {
            $sentence [] = mb_substr($value, 3, 2);
        }
    }

    echo '<pre>';
    print_r($sentence);
    echo '</pre>';

    $buffer = [];

    $countArr = count($sentence);

    $bufferIndex = 0;

    foreach ($sentence as $key => $raw) {

        $buffer[$bufferIndex] = $sentence[$bufferIndex];

        for ($i = $key; $i < $countArr; $i++) {
            if ($sentence[$i] <= $raw) {
                $buffer[$bufferIndex] = $sentence[$i];
                $bufferIndex++;
            }

            echo '<pre>';
            print_r($buffer);
            echo '</pre>';
        }
        $bufferIndex++;
    }
}

rate();

?>