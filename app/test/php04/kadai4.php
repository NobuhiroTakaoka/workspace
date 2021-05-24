<?php

 function max_array($arr){
    // とりあえず配列の最初の要素を一番大きい値とする
    $max_number = $arr[0];
    foreach($arr as $a){
        // 一時変数が現在の$max_numberより大きければ$max_numberに再設定する
        if ($max_number < $a) {
            $max_number = $a;
        }
    }

    return $max_number;
}

echo max_array(array(1, 3, 5 ,7, 9));

?>