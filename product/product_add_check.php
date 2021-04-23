<body>
<?php

//入力フォームから値を取得
$product_name = $_POST['name'];
$product_price = $_POST['price'];

//表示文字列のエスケープ処理
$product_name = htmlspecialchars($product_name,ENT_QUOTES, 'UTF-8');
$product_price = htmlspecialchars($product_price,ENT_QUOTES, 'UTF-8');

if($product_name == ''){
    print'商品名名が入力されていません。<br />';
}else{
    print'商品名';
    print $product_name;
    print'<br />';
}

if(preg_match('/¥A[0-9]+¥z/',$product_price)==0){
    print '価格は半角数字で入力してくだい<br />';
}else{
    print '価格';
    print $product_price;
    print '円<br />';
}



if($product_name == ''|| preg_match('/¥A[0-9]+¥z/',$product_price)==0){
    print '<form>';
    print '<input type ="button" onclick ="history.back()" value ="戻る">';
    print '</form>';
}else{
    print '上記の商品を追加します';
    print '<form method ="post" action ="product_add_done.php">';
    print '<input type="hidden" name ="name" value ="'.$product_name.'">';
    print '<input type="hidden" name ="price" value ="'.$product_price.'">';
    print '<br />';
    print '<input type ="button" onclick ="history.back()" value ="戻る">';
    print '<input type ="submit" value ="OK">';
    print '</form>';
}
?>
</body>