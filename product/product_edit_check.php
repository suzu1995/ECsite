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
require_once('../common/common.php');
$post = sanitize($_POST);
$product_code = $post['product_code'];
$product_name = $post['product_name'];
$product_price = $post['product_price'];
$old_gazou = $post['old_gazou'];
$product_gazou = $_FILES['gazou'];

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
</html>