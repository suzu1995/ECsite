<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])== false){
    print 'ログインされていません<br />';
    print '<a href="shop_list.php">商品一覧へ</a>';
    exit();
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

    $code = $_SESSION['member_code'];

    $dns = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password = 'u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dns,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT member_name,member_email,member_postal1,member_postal2,member_address,member_tel
        FROM m_member WHERE member_code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $stmt->execute($data);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    $dbh = null;

    $onamae = $record['member_name'];
    $email = $record['member_email'];
    $postal1 = $record['member_postal1'];
    $postal2 = $record['member_postal2'];
    $address = $record['member_address'];
    $tel = $record['member_tel'];

    print 'お名前<br />';
    print $onamae;
    print '<br /><br />';
    print 'メールアドレス<br />';
    print $email;
    print '<br /><br />';
    print '郵便番号<br />';
    print $postal1.$postal2;
    print '<br /><br />';
    print '住所<br />';
    print $address;
    print '<br /><br />';
    print '電話番号<br />';
    print $tel;
    print '<br /><br />';

    print '<form method="POST" action="shop_kantan_done.php">';
    print '<input type="hidden" name="onamae" value="'.$onamae.'">';
    print '<input type="hidden" name="email" value="'.$email.'">';
    print '<input type="hidden" name="postal1" value="'.$postal1.'">';
    print '<input type="hidden" name="postal2" value="'.$postal2.'">';
    print '<input type="hidden" name="address" value="'.$address.'">';
    print '<input type="hidden" name="tel" value="'.$tel.'">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK"><br />';
    print '</form>';



 ?>
</body>
</html>