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

    $bufer = 'Mar ';


    foreach ($jsonArray as $arr) {
        foreach ($arr as $value) {
                $month = mb_substr($value, 3, 2);
                $sentence []= $month;
        }
    }

   echo '<pre>';
   var_dump($sentence);
   echo '</pre>';

    $bufer .= (int)$sentence[0];

   for ($i = 1; $i<(count($sentence)-1); $i++)
   {
        if ($sentence[$i] < $sentence[$i+1] && $i%2 !== 0)
        {
            $bufer .= '-'.$sentence[$i].', ';
        }else{
            $bufer .= $sentence[$i];
        }
   }

   echo $bufer .= '-'.$sentence[count($sentence)-1];

}

rate();

?>

