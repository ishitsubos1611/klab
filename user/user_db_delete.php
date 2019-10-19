<!DOCTYPE html>
<html lang="ja">
<head>    

<meta charset="utf-8">
  <META http-equiv="Refresh" content="1;URL=../top.html"> 
    <title>削除中</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<body>
<P>削除完了</P>

</body>
</html>



<?php 
echo $scheduleUID = $_POST['scheduleUID'];
echo $date = $_POST['date'];

//$UID = 1;
$UID = $_POST['uid'];  

$host = 'localhost';
$dbname = 'tour_db';
$dbuser = 'yamamoto';
$dbpass = 'rikuya0217';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, [PDO::ATTR_EMULATE_PREPARES => false]);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 echo '接続失敗';
 exit;
}

//if($date=="all"){
if(empty($date)){

$sql = "DELETE FROM U_Schedule WHERE scheduleUID=:scheduleUID";
$stmt = $dbh->prepare($sql);
//print_r($dbh->errorInfo());

$stmt->bindParam(':scheduleUID', $scheduleUID, PDO::PARAM_INT);


$stmt->execute();


}else{

 for($i=1; $i<=31; $i++){


  //DELETE
  $sql = "DELETE FROM U_Schedule WHERE UID=:UID";
  $stmt = $dbh->prepare($sql);
  //print_r($dbh->errorInfo());

  $stmt->bindParam(':UID', $UID, PDO::PARAM_INT);

  $stmt->execute();
 }

}

?>
