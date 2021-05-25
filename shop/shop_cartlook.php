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
    if(isset($_SESSION['cart'])==true){
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
        $max = count($cart);
    }else{
        $max = 0;
    }

    if($max == 0){
        print 'カートに商品が入っていません';
        print '<br />';
        print '<a href="shop_list.php">商品一覧に戻る</a>';
        exit();
    }

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
<table border="1">
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>

<?php for($i=0;$i<$max;$i++){
?>
<tr>
    <td><?php print $product_name[$i]; ?></td>
    <td><?php print $product_gazou[$i]; ?></td>
    <td><?php print $product_price[$i]; ?>円</td>
    <td><input type="text" name="kazu<?php print $i;?>" value="<?php print $kazu[$i];?>"></td>
    <td><?php print $product_price[$i] * $kazu[$i]; ?>円</td>
    <td><input type="checkbox" name="sakujyo<?php print $i;?>"></td>
    <br />
</tr>
<?php }
?>
</table>
<input type="hidden" name='max' value="<?php print $max;?>">
<input type="submit" value="数量変更"><br />
<input type="button" onclick="history.back()" value="戻る">
</form>
<br />
<a href="shop_form.html">ご購入手続きに進む</a><br />
</body>
</html>