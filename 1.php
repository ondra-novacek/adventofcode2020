<?php
// used algorithms are not made for general use, but for solving the specific task only
$numbers = [];

$file = fopen('./files/1_numbers.txt', 'r') or die('Cannot open a file.');
while(!feof($file)) {
    $line = fgets($file);
    $numbers[] = (int) $line;
}
fclose($file);


function partOne($numbers, $goal) {
    sort($numbers);

    $lower = 0;
    $upper = count($numbers) - 1; 
    while ($lower !== $upper) {
        $sum = $numbers[$lower] + $numbers[$upper];
        if ($sum > $goal) {
            $upper -= 1;
        } elseif ($sum < $goal) {
            $lower += 1;
        } elseif ($sum === $goal) {
            return $numbers[$lower] * $numbers[$upper];
        }
    }
    return null;
}

// O(x^3) - bad, but ok for this
function partTwo($numbers, $goal) {
    $len = count($numbers);
    for ($i = 0; $i < $len - 2; $i++) { 
        for ($j = $i+1; $j < $len - 1; $j++) { 
            for ($k = $j + 1; $k < $len; $k++) {
                if (($numbers[$i] + $numbers[$j] + $numbers[$k]) === $goal) {
                    return $numbers[$i] * $numbers[$j] * $numbers[$k];
                }
            }
        }
    }
}

$goal = 2020;
echo partOne($numbers, $goal);
echo "\n";
echo partTwo($numbers, $goal);
