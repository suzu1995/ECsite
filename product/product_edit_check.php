<body>
<?php

//入力フォームから値を取得
$product_code = $_POST['product_code'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$old_gazou = $_POST['old_gazou'];
$product_gazou = $_FILES['gazou'];

//表示文字列のエスケープ処理
$product_code = htmlspecialchars($product_code,ENT_QUOTES, 'UTF-8');
$product_name = htmlspecialchars($product_name,ENT_QUOTES, 'UTF-8');
$product_price = htmlspecialchars($product_price,ENT_QUOTES, 'UTF-8');

if($product_name == ''){
    print'商品名が入力されていません。<br />';
}

if(preg_match("/^[0-9]+$/",$product_price)==0){
    print '価格は半角数字で入力してくだい<br />';
}

if($product_gazou['size'] > 0){
    if($product_gazou['size'] > 1000000){
        print '画像が大きすぎます';
    }else{
        move_uploaded_file($product_gazou['tmp_name'],'./gazou/'.$product_gazou['name']);
        print'<img src="./gazou/'.$product_gazou['name'].'">';
        print'<br />';
    }
}

if($product_name == ''|| preg_match("/^[0-9]+$/",$product_price)==0 ||$product_gazou['size'] > 1000000){
    print '<form>';
    print '<input type ="button" onclick ="history.back()" value ="戻る">';
}else{
    print'商品名';
    print $product_name;
    print'<br />';
    print'価格';
    print $product_price.'円';
    print'<br />';
    print '上記のように変更します';
    print '<form method ="post" action ="product_edit_done.php">';
    print '<input type="hidden" name ="product_code" value ="'.$product_code.'">';
    print '<input type="hidden" name ="product_name" value ="'.$product_name.'">';
    print '<input type="hidden" name ="product_price" value ="'.$product_price.'">';
    print '<input type="hidden" name ="old_gazou" value ="'.$old_gazou.'">';
    print '<input type="hidden" name ="product_gazou" value ="'.$product_gazou['name'].'">';
    print '<br />';
    print '<input type ="button" onclick ="history.back()" value ="戻る">';
    print '<input type ="submit" value ="OK">';
    print '</form>';
}
?>
</body>