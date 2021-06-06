<?php
    session_start();
    session_regenerate_id();
?>
<!DECOTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php
try{
    require_once('../common/common.php');

    $post = sanitize($_POST);

    $onamae = $post['onamae'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];
    $chumon = $post['chumon'];
    $password = $post['password'];
    $sex = $post['sex'];
    $birth = $post['birth'];

    print $onamae.'様<br />';
    print '注文ありがとうございました。<br />';
    print $email.'にメールを送りましたのでご確認ください<br /';
    print '商品は以下の住所に発送させていただきます。<br />';
    print $postal1.'-'.$postal2.'<br />';
    print $address.'<br />';
    print $tel.'<br />';

    $honbun = '';
    $honbun .= $onamae."様 \n\n この度はご注文ありがとうございました \n";
    $honbun .= "\n";
    $honbun .= "ご注文商品 \n";
    $honbun .= "------------------\n";

    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
    $max = count($cart);

    $dns = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password = 'u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dns,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for($i=0;$i<$max;$i++){
        $sql = 'SELECT product_name,product_price FROM m_product WHERE product_code = ?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $cart[$i];
        $stmt->execute($data);

        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $record['product_name'];
        $price = $record['product_price'];
        $kakaku[] = $price;
        $suryo = $kazu[$i];
        $syokei = $price * $suryo;

        $honbun .=$name.'';
        $honbun .=$price.'円 x';
        $honbun .=$suryo.'個 =';
        $honbun .=$syokei."円 \n";
    }
    $sql = 'LOCK TABLES t_sale WRITE,t_detail WRITE';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $sql = 'INSERT INTO t_sale(code_member,sale_name,sale_email,sale_postal1,sale_postal2,sale_address,sale_tel)
        VALUES(?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[] = 0;
    $data[] = $onamae;
    $data[] = $email;
    $data[] = $postal1;
    $data[] = $postal2;
    $data[] = $address;
    $data[] = $tel;
    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $last_code = $record['LAST_INSERT_ID()'];

    for($i=0;$i<$max;$i++){
        $sql = 'INSERT INTO t_detail(sale_code,product_code,detail_price,detail_quantity)VALUES(?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $last_code;
        $data[] = $cart[$i];
        $data[] = $kakaku[$i];
        $data[] = $kazu[$i];
        $stmt->execute($data);
    }

    $sql = 'UNLOCK TABLES';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    $honbun .= "送料は無料です。 \n";
    $honbun .= "--------------\n";
    $honbun .= "\n";
    $honbun .= "代金は以下の口座にお振込ください。 \n";
    $honbun .= "ろくまる銀行　やさい支店　普通口座1234567\n";
    $honbun .= "入金確認が取れ次第、梱包、発送させていただきます\n";
    $honbun .= "\n";
    $honbun .= "□□□□□□□□□□□□□□□□□□□□□□\n";
    $honbun .= "〜安心野菜のろくまる農園〜\n";
    $honbun .= "\n";
    $honbun .= "○○県六丸郡六丸村 123-4\n";
    $honbun .= "電話090-6060-xxxx\n";
    $honbun .= "メール info@rokumarunouen.co.jp\n";
    $honbun .= "□□□□□□□□□□□□□□□□□□□□□□\n";
    // print '<br />';
    // print nl2br($honbun);

    //メールタイトル
    $title = 'ご注文ありがとうございます';
    //送信元
    $header = 'Form:info@rokumarunouen.co.jp';
    //メールを送信する命令
    $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanise');
    mb_internal_encoding('UTF-8');
    mb_send_mail($email,$title,$honbun,$header);

    //メールタイトル
    $title = 'お客様から注文がありました';
    //送信元
    $header = 'Form:'.$email;
    //メールを送信する命令
    $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanise');
    mb_internal_encoding('UTF-8');
    mb_send_mail('info@rokumarunouen.co.jp',$title,$honbun,$header);

}catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしています';
    exit();
}

?>
<br />
<a href="shop_list.php">商品画面へ</a>
</body>
</html>