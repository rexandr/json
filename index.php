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
            $month = mb_substr($value, 3, 2);
            $sentence [] = $month;
        }
    }

    echo '<pre>';
    print_r($sentence);
    echo '</pre>';

    $buffer .= (int)$sentence[0];

    for ($i = 1; $i < (count($sentence) - 1); $i++) {

        if ($i % 2 != 0 && $sentence[$i]> $sentence[$i-1]) {
            $i++;
            continue;
        }

        if ($i % 2 == 0 && $sentence[$i]< $sentence[$i-1]) {
            $i++;
            continue;
        }

        if ($sentence[$i] < $sentence[$i + 1] && $i % 2 != 0) {
            $buffer .= '-' . $sentence[$i] . ', ';
        }elseif ($sentence[$i] > $sentence[$i + 2] && $i<(count($sentence) - 2)){
            continue;
        }elseif ($sentence[$i] < $sentence[$i + 1]  && $i % 2 == 0) {
            $buffer .= $sentence[$i];
        }

    }

    echo $buffer .= '-' . $sentence[count($sentence) - 1];

}

rate();

?>

<!--echo '<pre>';-->
<!--    var_dump($sentence);-->
<!--    echo '</pre>';-->
<!---->
<!--asort($sentence);-->
<!---->
<!--echo '<pre>';-->
<!--    print_r($sentence);-->
<!--    echo '</pre>';-->
<!---->
<!--$buffer .= (int)$sentence[0];-->
<!---->
<!--$i = 0;-->
<!--$previous = (int)$sentence[0];-->
<!---->
<!--foreach ($sentence as $key => $value)-->
<!--{-->
<!---->
<!--if ($key === 0){continue;}-->
<!--$i++;-->
<!--if ($key>$i)-->
<!--{-->
<!--continue;-->
<!--}elseif(($value - $previous == 1)||($value - $previous == 0))-->
<!--{-->
<!--continue;-->
<!--}-->
<!--else{-->
<!--$buffer .= $value;-->
<!--}-->
<!--$previous = $value;-->
<!--}-->
<!---->
<!--echo $buffer;-->