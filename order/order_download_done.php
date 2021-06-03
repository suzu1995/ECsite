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

try{
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'suzu';
    $password ='u9oIjVjw1dSXbaPp';
    $dbh = new PDO($dsn, $user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //ここまでDBへの接続 エラーの設定

    $sql ='
    SELECT
        t_sale.sale_code,
        t_sale.sale_date,
        t_sale.code_member,
        t_sale.sale_name AS sale_name,
        t_sale.sale_email,
        t_sale.sale_postal1,
        t_sale.sale_postal2,
        t_sale.sale_address,
        t_sale.sale_tel,
        t_detail.product_code,
        m_product.product_name AS product_name,
        t_detail.detail_price,
        t_detail.detail_quantity
    FROM
        t_sale,t_detail,m_product
    WHERE
        t_sale.sale_code = t_detail.sale_code
        AND t_detail.product_code = m_product.product_code
        AND substr(t_sale.sale_date,1,4)=?
        AND substr(t_sale.sale_date,6,2)=?
        AND substr(t_sale.sale_date,9,2)=?
    ';
    $stmt = $dbh->prepare($sql);//SQL文のセット
    $data[] = $year;
    $data[] = $month;
    $data[] = $day;
    $stmt->execute($data);//実行
    $dbh = null;

    $csv = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
    $csv .= "\n";

    while(true)
    {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
        $csv .= $rec['sale_code'];
        $csv .= ',';
        $csv .= $rec['sale_date'];
        $csv .= ',';
        $csv .= $rec['code_member'];
        $csv .= ',';
        $csv .= $rec['sale_name'];
        $csv .= ',';
        $csv .= $rec['sale_email'];
        $csv .= ',';
        $csv .= $rec['sale_postal'].'-'.$rec['sale_postal2'];
        $csv .= ',';
        $csv .= $rec['sale_address'];
        $csv .= ',';
        $csv .= $rec['sale_tel'];
        $csv .= ',';
        $csv .= $rec['product_code'];
        $csv .= ',';
        $csv .= $rec['product_name'];
        $csv .= ',';
        $csv .= $rec['product_price'];
        $csv .= ',';
        $csv .= $rec['product_quantity'];
        $csv .= "\n";
    }

    // print nl2br($csv);
    $file = fopen('./chumon.csv','w');
    $csv = mb_convert_encoding($csv,'SJIS','UTF-8');
    fputs($file,$csv);
    fclose($file);

}
catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をおかけしています';
    exit();
}
?>
<br />
<a href="chumon.csv">注文データのダウンロード</a><br />
<br />
<a href="order_download.php">日付選択へ</a><br />
<br />
<a href="../staff_login/staff_top.php">トップメニューへ</a><br />
</body>
</html>
