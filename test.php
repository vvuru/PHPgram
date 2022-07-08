<?php
$a = 111;
$b = 111;
//$a=472 $b=385

$bArr = str_split($b);
// print_r($bArr);
//$bArr=[3,8,5]

//  $a * $bArr[2] * 10^0
//+ $a * $bArr[1] * 10^1
//+ $a * $bArr[0] * 10^2
$sum = 0;
for ($i = 0; $i < Count($bArr); $i++) {
    print $a * $bArr[Count($bArr) - (1 + $i)] . "<br>\n";
    $result = $a * $bArr[Count($bArr) - (1 + $i)] * pow(10, $i);
    $sum += $result;
}
print $sum;
