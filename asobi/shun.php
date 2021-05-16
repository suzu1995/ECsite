<?php

$tsuki = $_POST['tsuki'];

$yasai[] = "";
$yasai[] = "ブロッコリー";
$yasai[] = "カリフラワー";
$yasai[] = "レタス";
$yasai[] = "三つ葉";
$yasai[] = "アスパラガス";
$yasai[] = "セロリ";
$yasai[] = "なす";
$yasai[] = "ピーマン";
$yasai[] = "オクラ";
$yasai[] = "サツマイモ";
$yasai[] = "大根";
$yasai[] = "ほうれん草";

print $tsuki;
print '月は';
print $yasai[$tsuki];
print 'が旬です';

?>