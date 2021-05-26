<?php

function all_bai($arr){
    $elem = count($arr);
    $result = $arr[0];

    for ($i=1; $i < $elem ; $i++) { 
        $result *= $arr[$i];
    }

    return $result;
}

echo all_bai(array(1, 3, 5 ,7, 9));

?>