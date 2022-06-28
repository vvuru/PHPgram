<?php
require_once "application/utils/FileUtils.php";

$filename = "sdlkf.jls.dkf.jpg";

// print substr($filename, strrpos($filename, ".") + 1);
// print getExt($filename);
// print getRandomFileNm($filename);




fscanf(STDIN, "%u\n", $a);
fscanf(STDIN, "%u\n", $b);
$arr_b = str_split($b);

//$a=456, $b=123, $arr_b=[1,2,3]
for ($i = count($arr_b) - 1; $i > -1; $i--) {
    print $a * $arr_b[$i] * . "<br>";
}
