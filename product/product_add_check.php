<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br />';
    print '<a href=../staff_login/staff_login.html>ログイン画面へ</a>';
    exit();
}else{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
    print '<br />';
}
?>
<!DECOTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

//入力フォームから値を取得
$product_name = $_POST['name'];
$product_price = $_POST['price'];
$product_gazou = $_FILES['gazou'];

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

if(preg_match("/^[0-9]+$/",$product_price)==0){
    print '価格は半角数字で入力してくだい<br />';
}else{
    print '価格';
    print $product_price;
    print '円<br />';
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

if($product_name == ''|| preg_match("/^[0-9]+$/",$product_price)==0 || $product_gazou['size']>1000000){
    print '<form>';
    print '<input type ="button" onclick ="history.back()" value ="戻る">';
    print '</form>';
}else{
    print '上記の商品を追加します';
    print '<form method ="post" action ="product_add_done.php">';
    print '<input type="hidden" name ="name" value ="'.$product_name.'">';
    print '<input type="hidden" name ="price" value ="'.$product_price.'">';
    print '<input type="hidden" name ="gazou_name" value ="'.$product_gazou['name'].'">';
    print '<br />';
    print '<input type ="button" onclick ="history.back()" value ="戻る">';
    print '<input type ="submit" value ="OK">';
    print '</form>';
}
?>
</body>
</html>