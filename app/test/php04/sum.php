<?php
// 1〜$max までを足した値を返す関数
function sum($max){

    // $result は結果を保存する変数
    $result = 0;

    // $i は 1　からはじまり $max より大きくなるまでループする
    for ($i=0; $i <= $max ; $i++) { 

        // $result に　$i を順番に足していく
        $result += $i;
    }

    // $result を結果として返す
    return $result;
}

// 関数を実行する
echo sum(100);
?>