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
    $staff_code = $_GET['staffcode'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name FROM m_staff WHERE code=?';
    $stmt = $dbh->prepare($sql);//SQL文のセット
    $data[]=$staff_code;
    $stmt->execute($data);//実行

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $staff_name = $record['name'];
    $dbh = null;
}
catch(Exception $e)
{
    print 'ただいま障害により大変ご迷惑をおかけしています。';
    exit();
}
?>

スタッフ削除<br />
<br />
スタッフコード<br />
<?php print $staff_code;?>
<br />
スタッフ名<br />
<?php print $staff_name;?>
<br />
このスタッフを削除してよろしいですか？<br />
<br />
<form method="post" action="staff_delete_done.php">
<input type="hidden" name="code" value="<?php print $staff_code;?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>