<!DECOTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php
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
 $password2 = $post['password2'];
 $sex = $post['sex'];
 $birth = $post['birth'];

 $okflg = true;

 if($onamae == ""){
     print '名前が入力されていません<br /><br />';
     $okflg = false;

 }else{
     print 'お名前<br />';
     print $onamae;
     print '<br /><br />';
 }

 if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',$email)==0){
    print 'メールアドレスを正確に入力してください<br /><br />';
    $okflg = false;
 }else{
     print 'メールアドレス<br />';
     print $email;
     print '<br /><br />';

 }

 if(preg_match('/^[\d]+$/',$postal1)==0 || preg_match('/^[\d]+$/',$postal2)==0){
    print '郵便番号は半角数字で入力してください<br /><br />';
    $okflg = false;
 }else{
     print '郵便番号<br />';
     print $postal1.$postal2;
     print '<br /><br />';
 }

 if($address == ""){
     print '住所が入力されていません<br /><br />';
     $okflg = false;
 }else{
    print '住所<br />';
    print $address;
    print '<br /><br />';
 }

 if(preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',$tel)== 0){
    print '電話番号を正確に入力してください<br /><br />';
    $okflg = false;
 }else{
    print '電話番号<br />';
    print $tel;
    print '<br /><br />';
 }

 if($chumon == 'chumontoroku'){
   if($password == ''){
      print 'パスワードが入力されていません<br /><br />';
      $okflg = false;
   }
   if($password != $password2){
     print 'パスワードが一致していません<br /><br />';
     $okflg = false;
   }

   print '性別<br />';
   if($sex == 'man'){
      print '男性';
   }else{
      print '女性';
   }
   print '<br /><br/>';

   print '生まれ年<br />';
   print $birth;
   print '年代';
}

 if($okflg == true){
    print '<form method="POST" action="shop_form_done.php">';
    print '<input type="hidden" name="onamae" value="'.$onamae.'">';
    print '<input type="hidden" name="email" value="'.$email.'">';
    print '<input type="hidden" name="postal1" value="'.$postal1.'">';
    print '<input type="hidden" name="postal2" value="'.$postal2.'">';
    print '<input type="hidden" name="address" value="'.$address.'">';
    print '<input type="hidden" name="tel" value="'.$tel.'">';
    print '<input type="hidden" name="chumon" value="'.$chumon.'">';
    print '<input type="hidden" name="password" value="'.$password.'">';
    print '<input type="hidden" name="sex" value="'.$sex.'">';
    print '<input type="hidden" name="birth" value="'.$birth.'">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK"><br />';
    print '</form>';
 }else{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
 }


 ?>
</body>
</html>