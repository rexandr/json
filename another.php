<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>json</title>
</head>
<body>

<div>
    <a href="index.php">ONE</a><br>
    <?php
    $ranges = rate();
    foreach ($ranges as $range)
    {
        echo $range.'<br>';
    }
    ?>
</div>
</body>
</html>


<?php
function rate()
{
    $file = 'another.json';

    if (file_exists($file)) {
        $json = file_get_contents($file);
        $jsonArray = json_decode($json, true);
        
        foreach ($jsonArray as $arr) {
            $ranges[] = differentRanges($arr);

        }

        return $ranges;
    } else {
        return "Choose a correct file!";
    }
}

function differentRanges($array)
{

    foreach ( $array as $arr) {
        foreach ($arr as $key => $value) {
            if ($key === 'from') {
                $fromSentence [] = mb_substr($value, 3, 2);
            }
            if ($key === 'to') {
                $toSentence [] = mb_substr($value, 3, 2);
            }
        }
    }

        asort($fromSentence);
        asort($toSentence);

        $month = month((int)mb_substr($value, 0, 2));

        $buffer = buffer($fromSentence, $toSentence);

        return arrayToString($month, $buffer);
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
    $string = $month . ' ';

    for ($j = 0; $j < count($buffer) - 1; $j++) {
        if ($j % 2 != 0) {
            $string .= '-' . (int)$buffer[$j] . ', ';
        }
        if ($j % 2 == 0) {
            $string .= (int)$buffer[$j];
        }
    }

    $string .= '-' . $buffer[count($buffer) - 1];

    return $string;
}

function buffer($fromSentence, $toSentence)
{
    $iteration = 0;

    foreach ($fromSentence as $key => $value) {
        if ($key > $iteration) {
            for ($i = $iteration; $i < $key; $i++) {
                unset($fromSentence[$i]);
            }

            $anotherTo = null;

            for ($j = $iteration; $j < $key; $j++) {
                if ($toSentence[$j] > $toSentence[$key]) {
                    $anotherTo = $toSentence[$j];
                }
            }

            $iteration = $key;
        }

        if (isset($fromSentence[$iteration])) {
            $buffer[] = $fromSentence[$iteration];

            if (isset($anotherTo)) {
                $buffer[] = $anotherTo;
                $anotherTo = null;
            } else {
                $buffer[] = $toSentence[$iteration];
            }
        }

        $iteration++;
    }

    for ($i = 1; $i < count($buffer) - 1; $i++) {
        if ($buffer[$i] - $buffer[$i - 1] <= 1) {
            unset($buffer[$i]);
            unset($buffer[$i - 1]);
            $i++;
        }
    }

    $buffer = array_values($buffer);

    for ($i = 1; $i < count($buffer) - 1; $i++) {
        if ($buffer[$i] - $buffer[$i - 1] <= 1) {
            unset($buffer[$i]);
            unset($buffer[$i - 1]);
            $i++;
        }
    }

    $buffer = array_values($buffer);

    return $buffer;
}

?>