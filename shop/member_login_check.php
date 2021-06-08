<?php

try{
    $member_email = $_POST['email'];
    $member_password = $_POST['password'];

    $member_email = htmlspecialchars($member_email,ENT_QUOTES,'UTF-8');
    $member_password = htmlspecialchars($member_password,ENT_QUOTES,'UTF-8');
    $member_password= md5($member_password);

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT member_code,member_name FROM m_member WHERE member_code=? AND member_password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $member_email;
    $data[] = $member_password;
    $stmt->execute($data);

    $dbh = null;

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if($record==false){
        print 'メールアドレス、もしくはパスワードが間違っています<br />';
        print '<a href="member_login.html">戻る</a>';
    }else{
        session_start();
        $_SESSION['login']= 1;
        $_SESSION['member_code']= $record['member_code'];
        $_SESSION['member_name']= $record['member_name'];
        header('Location:shop_list.php');
        exit();
    }
}catch(Exception $e){
    print'ただいま障害によりご迷惑をおかけしています';
    exit();
}
?>