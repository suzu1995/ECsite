<?php

try{
    $staff_code = $_POST['staff_code'];
    $staff_password = $_POST['staff_password'];

    $staff_code = htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
    $staff_password = htmlspecialchars($staff_password,ENT_QUOTES,'UTF-8');
    $staff_password= md5($staff_password);

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name FROM m_staff WHERE code=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $staff_code;
    $data[] = $staff_password;
    $stmt->execute($data);

    $dbh = null;

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if($record==false){
        print 'スタッフコード、もしくはパスワードが間違っています<br />';
        print '<a href="staff_login.html">戻る</a>';
    }else{
        header('Location:staff_top.php');
        exit();
    }
}catch(Exception $e){
    print'ただいま障害によりご迷惑をおかけしています';
    exit();
}
?>