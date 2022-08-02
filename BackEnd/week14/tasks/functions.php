<?php

    function getOutput($val) {
        if ($val) {
            return sprintf("%s <br>\n", $val);
        } else {
            return sprintf("Something wrong with values.<br>\n");
        }
    }

    // Parašykite funkciją, kuri grąžina skaičiaus kvadratą. Skaičius perduodamas kaip parametras.
    function raisedToPow($n, $pow = 2) {
        if (is_numeric($n) && is_numeric($pow)) {
            return $n ** $pow;
        } else {
            return null;
        }
    }

    $res1 = raisedToPow(5);
    echo '5 squared: ' . getOutput($res1);

    // Parašykite funkciją, kuri grąžina dviejų skaičių sumą. Skaičiai perduodami funkcijos parametrus.
    function sum($x, $y) {
        if (is_numeric($x) && is_numeric($y)) {
            return $x + $y;
        } else {
            return null;
        }
    }

    $res2 = sum(5, 2);
    echo 'Sum 5+2: ' . getOutput($res2);

    // Parašykite funkciją, kuri iš antro parametro atima pirmą ir padalija iš trečio.
    function doMath($a, $b, $c) {
        if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
            return ($b - $a) / $c;
        } else {
            return null;
        }
    }

    $res3 = doMath(3, 50, 2);
    echo 'Math: ' . getOutput($res3);

    // Parašykite funkciją, kuri priima kaip parametrą skaičių nuo 1 iki 7, o grąžina savaitės dieną lietuvių kalba.
    function getDayAsStr($dayNum) {
        $weekNames = ['Pirmadienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis', 'Sekmadienis'];
        
        if ($dayNum <= 7 && $dayNum >= 1) {
            return $weekNames[$dayNum - 1];
        } else {
            return null;
        }
    }

    $res4 = getDayAsStr(7);
    echo 'Weekday: ' . getOutput($res4);
