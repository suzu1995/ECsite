<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false){
    print 'ようこそゲストさん　';
    print '<a href="member_login.html">会員ログイン</a>';
    print '<br />';
}else{
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_logout">ログアウト</a><br />';
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
    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
    $max = count($cart);

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    foreach($cart as $key => $value){
        $sql = 'SELECT product_code,product_price,product_name,product_gazou FROM m_product WHERE product_code=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $value;
        $stmt->execute($data);

        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        $product_name[] = $record['product_name'];
        $product_price[] = $record['product_price'];
        if($record['product_gazou']==''){
            $product_gazou[] = '';
        }else{
            $product_gazou[] = '<img src="../product/gazou/'.$record['product_gazou'].'">';
        }
    }
    $dbh = null;

}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしています。';
    exit();
}
?>
カートの中身<br />
<br />
<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++){
?>
    <?php print $product_name[$i]; ?>
    <?php print $product_gazou[$i]; ?>
    <?php print $product_price[$i]; ?>円
    <input type="text" name="kazu<?php print $i;?>" value="<?php print $kazu[$i];?>">
    <?php print $product_price[$i] * $kazu[$i]; ?>円

    <br />
<?php }
?>
<input type="hidden" name='max' value="<?php print $max;?>">
<input type="submit" value="数量変更"><br />
<input type="button" onclick="history.back()" value="戻る">
</form>
</body>
</html>