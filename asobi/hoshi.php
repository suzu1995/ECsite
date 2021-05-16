<?php

$mbango = $_POST['mbango'];

$hoshi['M1'] = 'かに星雲';
$hoshi['M31'] = 'アンドロメダ大星雲';
$hoshi['M42'] = 'オリオン大星雲';
$hoshi['M45'] = 'スバル';
$hoshi['M57'] = 'ドーナツ星雲';

foreach($hoshi as $bango => $name){
    print $bango.'は'.$name;
    print '<br />';
}

print 'あなたが選んだ星座は';
print $hoshi[$mbango];
print 'です';
