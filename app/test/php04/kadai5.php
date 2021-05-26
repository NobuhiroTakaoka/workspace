<?php
// strip_tags：文字列に含まれるHTMLタグやPHPタグを取り除く
$str = '<h2 class="blog-title"><a href="#">テスト</a></h2><br><h1 class="logo">テスト</h1><br>テスト<br><p>テスト</p><strong>テスト</strong>';
$str = strip_tags($str, '<br><strong>');
echo $str;

//改行
echo "\n";


// array_push：配列に要素を追加する
$fruits = array("banana", "melon", "peach");
array_push($fruits, "apple", "orange");
print_r($fruits);

//改行
echo "\n";


// array_merge：配列どうしを結合する
$alp1 = array("a", "b", "c");
$alp2 = array("y", "z");
print_r(array_merge($alp1, $alp2));

//改行
echo "\n";


// time：現在時刻のUNIX TIMESTAMPを取得
echo time();

//改行
echo "\n";


// mktime：指定した日時のUNIX TIMESTAMPを取得
$tm = mktime(0, 20, 30, 5, 25, 2021);
echo $tm;

//改行
echo "\n";


// date：指定された日時を任意の形式でフォーマットし、日付文字列を返す
echo date('Y/m/d H:i:s');

//改行
echo "\n";

?>