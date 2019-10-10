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
echo $scheduleGID = $_POST['scheduleGID'];
echo $date = $_POST['date'];

$GID = 1;

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

$sql = "DELETE FROM G_Schedule WHERE scheduleGID=:scheduleGID";
$stmt = $dbh->prepare($sql);
//print_r($dbh->errorInfo());

$stmt->bindParam(':scheduleGID', $scheduleGID, PDO::PARAM_INT);


$stmt->execute();


}else{

 for($i=1; $i<=31; $i++){


  //DELETE
  $sql = "DELETE FROM G_Schedule WHERE GID=:GID";
  $stmt = $dbh->prepare($sql);
  //print_r($dbh->errorInfo());

  $stmt->bindParam(':GID', $GID, PDO::PARAM_INT);

  $stmt->execute();
 }

}

?>
