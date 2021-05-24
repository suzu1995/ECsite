<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $max = $post['max'];

    if($max == 0){
        print 'カートに商品が入っていません';
        print '<br />';
        print '<a href="shop_list.php">商品一覧に戻る</a>';
        exit();
    }
    
    for($i=0;$i<$max;$i++){
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