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

try
{
    require_once('../common/common.php');
    $post = sanitize($_POST);
    $product_code = $post['product_code'];
    $product_name = $post['product_name'];
    $product_price = $post['product_price'];
    $old_gazou = $post['old_gazou'];
    $product_gazou = $post['product_gazou'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';

    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn,$user,$password);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE m_product SET product_name=?,product_price=?,product_gazou=? WHERE product_code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $product_name;
    $data[] = $product_price;
    $data[] = $product_gazou;
    $data[] = $product_code;
    $stmt->execute($data);

    $dbh = null;
    if($old_gazou != $product_gazou){
        if($old_gazou !=""){
            unlink('./gazou/'.$old_gazou);
        }
    }
}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしております';
    exit();
}

?>
修正しました<br />
<br />
<a href="product_list.php">戻る</a>

</body>
</html>