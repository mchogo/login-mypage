<?php
 mb_internal_encoding("utf8");

 if(empty($_POST['from_edit'])){
    header("Location:login_error.php");
}

$pdo = new PDO("mysql:dbname=lesson1;host=localhost;","root","root");

//該当アカウントのチェック
$stmt = $pdo->prepare("DELETE FROM login_mypage where name = ? && mail = ?");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);

$stmt->execute();

//id番号のリセット＆Table整理
$organize_table =$pdo->prepare("set @n:=0; update`login_mypage` set id=@n:=@n+1; ALTER TABLE `login_mypage` auto_increment = 1;
");

$organize_table->execute();

$pdo = NULL;

//ログアウト処理
session_start();
session_destroy();

$alert = "<script type='text/javascript'>if (!alert('アカウントを削除しました。ログイン画面に戻ります。')) {
    location.href='login.php';
}</script>";
echo $alert;

?>