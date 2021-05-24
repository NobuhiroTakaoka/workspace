<?php
//課題１
$name = "Takaoka";

if ($name = "Takaoka") {
    echo "私は" . $name . "です";
}

//改行
echo "\n";


//課題２
$total = 0;

for ($i=0; $i <= 10000 ; $i++) { 
    $total += $i;
}

echo $total;

//改行
echo "\n";


//課題３
$fruits = $arrayName = array("banana", "melon", "peach");

foreach ($fruits as $fruit) {
    echo $fruit;
    echo "\n";
}


?>