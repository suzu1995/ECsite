<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $max = $post['max'];
    
    for($i=0;$i<$max;$i++){

        if(preg_match("/^[0-9]+$/",$post['kazu'.$i])==0){
            print '数量に誤りがあります。';
            print '<a href="shop_list.php">商品一覧に戻る</a>';
            exit();
        }

        if($post['kazu'.$i]<1||10<$post['kazu'.$i]){
            print '一度に購入できるのは1個から10個までです';
            print '<a href="shop_list.php">商品一覧に戻る</a>';
            exit();
        }
        $kazu[]=$post['kazu'.$i];
    }

    $cart = $_SESSION['cart'];
    for($i=$max;0<=$i;$i--){
        if(isset($_POST['sakujyo'.$i])==true){
            array_splice($cart,$i,1);
            array_splice($kazu,$i,1);
        }
    }

    $_SESSION['cart']=$cart;
    $_SESSION['kazu']=$kazu;

    header('Location:shop_cartlook.php');
    exit();