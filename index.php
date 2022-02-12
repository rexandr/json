<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #line_block {
            width: 150px;
            height: 50px;
            float: left;
            margin: 0 15px 15px 0;
            text-align: left;
            padding: 10px;
        }
    </style>
    <title>json</title>
</head>
<body>
<div style="width:100%; height:1px; clear:both;"></div>

<div id="line_block"></div>
<div id="line_block"><?php echo '<pre>';
print_r(rate()[0]);
echo '</pre>';?></div>
<div id="line_block"><?php echo '<pre>';
    print_r(rate()[1]);
    echo '</pre>';?></div>
<div id="line_block"><?php echo '<pre>';
    print_r(rate()[2]);
    echo '</pre>';?></div>
<div id="line_block"><?php echo '<pre>';
    print_r(rate()[3]);
    echo '</pre>';?></div>
<div id="line_block"><?php echo '<pre>';
    print_r(rate()[4]);
    echo '</pre>';?></div>

<div style="width:100%; height:1px; clear:both;"></div>
</body>
</html>


<?php
function rate()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);

        $arrayAr = [];

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
        $arrayAr[] = $fromSentence;
        $arrayAr[] = $toSentence;
        asort($fromSentence);
        asort($toSentence);
        $arrayAr[] = $fromSentence;
        $arrayAr[] = $toSentence;

        $month = month((int)mb_substr($value, 0, 2));

        $buffer = buffer($fromSentence, $toSentence);

        $arrayAr[] = arrayToString($month, $buffer);
        //echo arrayToString($month, $buffer);

        return $arrayAr;
    } else {
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
    $buffer[] = $fromSentence[0];

    $countArr = count($fromSentence) - 1;

    $jump = 0;

    $iteration = 0;

    foreach ($fromSentence as $key=>$value)
    {

        if ($key == 0)
        {
            $iteration++;
            continue;
        };

//        if ($key >= $iteration && $sw == 1)
//        {
//            $iteration++;
//            continue;
//        };

        if ($iteration<$jump)
        {
            $iteration++;
            continue;
        }

        if ($key >= $iteration)
        {
            $buffer[] = $value;
            $jump = $key;
            $iteration++;
            continue;
        };

        if ($fromSentence[$iteration] < $toSentence[$iteration]) {
            $buffer[] = $toSentence[$iteration];
            $buffer[] = $fromSentence[$iteration + 1];
        }

        $iteration++;

    }

//    for ($i = 0; $i < $countArr; $i++) {
//
//        if ($fromSentence[$i + 1] - $toSentence[$i] < 2) {
//            continue;
//        }
//
//        if ($fromSentence[$i] < $toSentence[$i]) {
//            $buffer[] = $toSentence[$i];
//            $buffer[] = $fromSentence[$i + 1];
//        }
//
//        if ($fromSentence[$i + 1] > $fromSentence[$i + 2] && !empty($fromSentence[$i + 2])) {
//            $buffer[count($buffer) - 1] = $fromSentence[$i + 2];
//        }
//    }
    $buffer[] = $toSentence[$countArr];

    return $buffer;
}
?>