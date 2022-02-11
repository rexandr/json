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
        foreach ($arr as $key=>$value) {
            if ($key === 'from')
            {
                $fromSentence [] = mb_substr($value, 3, 2);
            }
            if ($key === 'to')
            {
                $toSentence [] = mb_substr($value, 3, 2);
            }
        }
    }
    
    echo '<pre>';
    print_r($fromSentence);
    echo '</pre>';
    echo '<pre>';
    print_r($toSentence);
    echo '</pre>';

    $buffer=[];

    $buffer[] = $fromSentence[0];

    $countArr = count($fromSentence)-1;


    for ($i = 0; $i<$countArr; $i++)
    {

        if ($fromSentence[$i+1]<=$toSentence[$i] || $fromSentence[$i+1] - $toSentence[$i] < 2)
        {
            continue;
        }

        if ($fromSentence[$i]<$toSentence[$i])
        {
            $buffer[] = $toSentence[$i];
            $buffer[] = $fromSentence[$i+1]>$fromSentence[$i+2]?$fromSentence[$i+2]:$fromSentence[$i+1];
        }

    }

    $buffer[] = $toSentence[$countArr];

    echo '<pre>';
    print_r($buffer);
    echo '</pre>';

}

rate();

?>