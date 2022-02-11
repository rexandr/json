<?php
function rate()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);

        foreach ($jsonArray as $arr) {
            foreach ($arr as $key => $value) {
                if ($key === 'from') {
                    $fromSentence [] = mb_substr($value, 3, 2);
                }
                if ($key === 'to') {
                    $toSentence [] = mb_substr($value, 3, 2);
                }
            }
        }

        $month = month((int)mb_substr($value, 0, 2));

        $buffer = buffer($fromSentence, $toSentence);

        echo arrayToString($month, $buffer);
    }else{
        echo "Choose a correct file!";
    }
}

function month($number)
{
    switch ($number) {
        case 1:
            $month = 'Jan';
            break;
        case 2:
            $month = 'Feb';
            break;
        case 3:
            $month = 'Mar';
            break;
        case 4:
            $month = 'Apr';
            break;
        case 5:
            $month = 'May';
            break;
        case 6:
            $month = 'Jun';
            break;
        case 7:
            $month = 'Jul';
            break;
        case 8:
            $month = 'Aug';
            break;
        case 9:
            $month = 'Sep';
            break;
        case 10:
            $month = 'Oct';
            break;
        case 11:
            $month = 'Nov';
            break;
        case 12:
            $month = 'Dec';
            break;
        default:
            echo "Wrong month's title!";
    }
    return $month;
}

function arrayToString($month, $buffer)
{
    $string = $month.' ';

    for ($j = 0; $j < count($buffer)-1; $j++) {
        if ($j % 2 != 0) {
            $string .= '-'.(int)$buffer[$j].', ';
        }
        if ($j % 2 == 0) {
            $string .= (int)$buffer[$j];
        }
    }

    $string .= '-'.$buffer[count($buffer)-1];

    return $string;
}

function buffer($fromSentence, $toSentence)
{
    $buffer[] = $fromSentence[0];

    $countArr = count($fromSentence) - 1;

    for ($i = 0; $i < $countArr; $i++) {
        if ($fromSentence[$i + 1] <= $toSentence[$i] || $fromSentence[$i + 1] - $toSentence[$i] < 2) {
            continue;
        }

        if ($fromSentence[$i] < $toSentence[$i]) {
            $buffer[] = $toSentence[$i];
            $buffer[] = $fromSentence[$i + 1];
        }

        if ($fromSentence[$i + 1] > $fromSentence[$i + 2] && !empty($fromSentence[$i + 2])) {
            $buffer[count($buffer) - 1] = $fromSentence[$i + 2];
        }
    }
    $buffer[] = $toSentence[$countArr];

    return $buffer;
}

rate();
?>