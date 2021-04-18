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

スタッフ修正<br />
<br />
スタッフコード<br />
<?php print $staff_code;?>
<br />
<br />
<form method="post" action="staff_edit_check.php">
<input type="hidden" name="code" value="<?php print $staff_code;?>">
スタッフ名<br />
<input type="text" name="name" style="width:200px" value="<?php print $staff_name;?>"><br />

パスワードを入力してください<br />
<input type="password" name="pass" style="width: 100px;"><br />
パスワードをもう一度入力してください<br />
<input type="password" name="pass2" style="width: 100px;"><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>