<?php
fscanf(STDIN, "%u\n", $a);
fscanf(STDIN, "%u", $b);
//$a=472 $b=385

$bArr = str_split($b);
//$bArr=[3,8,5]

//  $a * $bArr[0] * 10^0
//+ $a * $bArr[1] * 10^1
//+ $a * $bArr[2] * 10^2

$sum = 0;
for ($i = 0; $i < Count($bArr); $i++) {
    $result = $a * $bArr[$i] * pow(10, $i);
    fprintf(STDOUT, "%u\n", $result);
    $sum += $result;
}
fprintf(STDOUT, "$u", $sum);
