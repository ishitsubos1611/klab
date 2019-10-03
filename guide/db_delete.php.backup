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
//$GID = $_POST['gid'];
//$date = $_POST['date'];
//$year = $_POST['year];
//$start_time = $_POST['start_time'];
//$end_time = $_POST['end_time'];
//$language = $_POST['language'];
//$location = $_POST['location'];
//$lat = $_POST['lat'];
//$long = $_POST['long'];
//$max_num_participant = $_POST['max_num_participant'];
//$charge = $_POST['charge'];
//$payment_date = $_POST['payment_date'];
//$period = $_POST['period'];

$GID = 1;
//$year = ;
$date = 'all';
$start_time = '8:00';
$end_time = '17:00';
//$language = 'JP';
$location = '四条烏丸';
//$lat = 35.00051;
//$long = 135.781218;
//$max_num_participant = 10;
//$charge = 500;
//$payment_date = null;
//$period = 30;

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

if($date=="all"){

 for($i=1; $i<=31; $i++){

// DELETE
$sql = "DELETE FROM G_Schedule WHERE GID=:GID";
$stmt = $dbh->prepare($sql);
//print_r($dbh->errorInfo());

$stmt->bindParam(':GID', $GID, PDO::PARAM_INT);


$stmt->execute();
  }

}else{

$sql = "DELETE FROM G_Schedule WHERE GID=:GID AND `date`=:date AND start_time=:start_time AND end_time=:end_time AND location=:location";

/*year=:year AND date=:date AND start_time=:start_time AND end_time=:end_time AND location=:location"*/;
/*$sql .= "WHERE DATE_FORMAT(date, '%Y-%m-%d') = STR_TO_DATE(:date ,'%Y-%m-%d')";
$sql .= "WHERE TIME_FORMAT(start_time, '%H:%i:%s') = STR_TO_TIME(:start_time,'%H:%i:%s)";
$sql .= "WHERE TIME_FORMAT(end_time, '%H:%i:%s') = STR_TO_TIME(:end_time,'%H:%i:%s)";*/
$stmt = $dbh->prepare($sql);
//print_r($dbh->errorInfo());

$stmt->bindParam(':GID', $GID, PDO::PARAM_INT);
$stmt->bindParam(':year', $year, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
$stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);
//$stmt->bindParam(':language', $language, PDO::PARAM_STR);
$stmt->bindParam(':location', $location, PDO::PARAM_STR);
//$stmt->bindParam(':lat', $lat, PDO::PARAM_INT);
//$stmt->bindParam(':long', $long, PDO::PARAM_INT);
//$stmt->bindParam(':max_num_participant', $max_num_participant, PDO::PARAM_INT);
//$stmt->bindParam(':charge', $charge, PDO::PARAM_INT);
//$stmt->bindParam(':payment_date', $payment_date, PDO::PARAM_STR);
//$stmt->bindParam(':period', $period, PDO::PARAM_INT);
//$stmt->bindParam(':maxsub', $maxsub, PDO::PARAM_INT);


$stmt->execute();
}
//$stmt = null;


?>
