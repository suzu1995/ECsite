<?php
if(isset($_POST['disp'])==true){
    if(isset($_POST['product_code'])==false){
        header('Location:product_ng.php');
        exit();
    }
    $product_code = $_POST['product_code'];
    header('Location:product_disp.php?product_code='.$product_code);
    exit();
}

if(isset($_POST['add'])==true){
    header('Location:product_add.php');
    exit();
}

if(isset($_POST['edit'])==true){
    if(isset($_POST['product_code'])==false){
        header('Location:product_ng.php');
        exit();
    }
    $product_code = $_POST['product_code'];
    header('Location:product_edit.php?product_code='.$product_code);
    exit();
}

if(isset($_POST['delete'])==true){
    if(isset($_POST['product_code'])==false){
        header('Location:product_ng.php');
        exit();
    }
    $product_code = $_POST['product_code'];
    header('Location:product_delete.php?product_code='.$product_code);
    exit();
}

?>