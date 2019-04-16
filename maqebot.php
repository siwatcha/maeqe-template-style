<?php

//  R: Turn 90 degree to the right of MAQE Bot (clockwise)
//  L: Turn 90 degree to the left of MAQE Bot (counterclockwise)
//  WN: Walk straight for N point(s) where N can be any positive integers. For example, W1 means walking straight for 1 point.

//               | Y
//               |
//    O----------O----------O
//    | -1,1     | 0,1      | 1,1
//    |          |          |
//    |          |          |     X               N
//    O----------O----------O----->               |
//    | -1,0     | 0,0      | 1,0                 |
//    |          |          |             W <-----|-----> E
//    |          |          |                     |
//    O----------O----------O                     |
//      -1,1       0,-1       1,-1                S
//
//
//  Example:
//  > php maqebot.php RW15RW1
//  > X: 15 Y: -1 Direction: South

$argmnt = $argv[1];
$direction = 'North'; // 'North', 'East', 'South', 'West'
$direc_count = 0; // keep index directions.
$x = 0;
$y = 0;
$num_str = ''; // WN : (string) N .= N

$directions = array('North', 'East', 'South', 'West');

for ($i = 0; $i < strlen($argmnt); $i++) {
    if ($argmnt[$i] == 'R') {
        $direc_count = ($direc_count == 3) ? 0 : $direc_count + 1;
        $direction = $directions[$direc_count];
    } else if ($argmnt[$i] == 'L') {
        $direc_count = ($direc_count == 0) ? 3 : $direc_count - 1;
        $direction = $directions[$direc_count];
    } else if ($argmnt[$i] == 'W') {
        for ($c = $i + 1; $c < strlen($argmnt); $c++) {
            if ((int) $argmnt[$c] || $argmnt[$c] == '0') {
                $num_str .= $argmnt[$c];
            } else {
                break;
            }
        }

        if ($direction == 'North' || $direction == 'South') {
            if ($direction == 'North') {
                $y += (int) $num_str;
            } else {
                $y -= (int) $num_str;
            }
        } else if ($direction == 'West' || $direction == 'East') {
            if ($direction == 'East') {
                $x += (int) $num_str;
            } else {
                $x -= (int) $num_str;
            }
        }

        $num_str = '';
        $i = $c - 1;
    }
}

echo ('X: ' . $x . ' Y: ' . $y . ' Direction: ' . $direction);
