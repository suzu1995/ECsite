<?php

$gakunen = $_POST['gakunen'];

switch($gakunen){
    case '1':
        $kousya = 'あなたの校舎は南校舎です。';
        $bukatsu = '部活動にはスポーツ系と文化系があります。';
        $mokuhyou = 'まずは学校に慣れましょう。';
        break;
    case '2':
        $kousya = 'あなたの校舎は西校舎です。';
        $bukatsu = '学園祭目指して全力で取り組みましょう。';
        $mokuhyou = '今しかできないことを見つけよう。';
        break;
    case '3':
        $kousya = 'あなたの校舎は東校舎です。';
        $bukatsu = '受験に就職に忙しくなります。後輩へ譲っていきましょう。';
        $mokuhyou = '将来への道を作ろう。';
        break;
    default:
        $kousya = 'あなたの校舎は3年生と同じです。';
        $bukatsu = '部活動はありません';
        $mokuhyou = '早く卒業しましょう';
        break;
}
?>