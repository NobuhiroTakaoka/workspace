<?php
/* for文の始めの値を定義する */
$start = 1;
/* for文の終わりの値を定義する */
$end = 100;

for($i = $start; $i <= $end; $i++){

  // 5で割り切れたら{}内を実行する
  if($i % 5 == 0){
    echo $i;
    echo "\n";
  }
}


//修正点
//  2行目：コメント行を「/* for文の始めの値を定義する /」から「/* for文の始めの値を定義する */」に修正
//  7行目：条件式の不等号を修正「<」→「<=」
//  11行目：echo文の後ろに「;」を追加
//  行追加：12行目に「echo "\n";」を追加し、改行して出力するように修正

?>