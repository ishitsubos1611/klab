<!DOCTYPE html>
<html lang="ja">
<head>    

<meta charset="utf-8">
  <META http-equiv="Refresh" content="1;URL=../top.html"> 
    <title>登録確認</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<body>
<P>登録完了</P>

</body>
</html>

<?php 

$GID = $_POST['gid'];
$date = $_POST['date'];
$year = $_POST['year'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$language = $_POST['language'];
$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$max_num_participant = $_POST['maxsub'];
$charge = $_POST['fee'];
$payment_date = $_POST['payment_date'];
$period = $_POST['period'];

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

// INSERT
$sql = "INSERT INTO G_Schedule (GID, date, start_time, end_time, Language, location, lat, `long`, max_num_participant, charge, payment_date, period) VALUES (:GID, :date, :start_time, :end_time, :language, :location, :lat, :long, :max_num_participant, :charge, :payment_date, :period)";

//$sql = "INSERT INTO G_Schedule (GID, year, date, start_time, end_time, Language, location, lat, `long`, max_num_participant, charge, payment_date, period) VALUES (:GID, :year, :date, :start_time, :end_time, :language, :location, :lat, :long, :max_num_participant, :charge, :payment_date, :period)";
/*$sql .= "WHERE DATE_FORMAT(date, '%Y-%m-%d') = STR_TO_DATE(:date ,'%Y-%m-%d')";
$sql .= "WHERE TIME_FORMAT(start_time, '%H:%i:%s') = STR_TO_TIME(:start_time,'%H:%i:%s)";
$sql .= "WHERE TIME_FORMAT(end_time, '%H:%i:%s') = STR_TO_TIME(:end_time,'%H:%i:%s)";*/
$stmt = $dbh->prepare($sql);
//print_r($dbh->errorInfo());
//echo $sql;

$stmt->bindParam(':GID', $GID, PDO::PARAM_INT);
$stmt->bindParam(':year', $year, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
$stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);
$stmt->bindParam(':language', $language, PDO::PARAM_STR);
$stmt->bindParam(':location', $location, PDO::PARAM_STR);
$stmt->bindParam(':lat', $lat, PDO::PARAM_INT);
$stmt->bindParam(':long', $long, PDO::PARAM_INT);
$stmt->bindParam(':max_num_participant', $max_num_participant, PDO::PARAM_INT);
$stmt->bindParam(':charge', $charge, PDO::PARAM_INT);
$stmt->bindParam(':payment_date', $payment_date, PDO::PARAM_STR);
$stmt->bindParam(':period', $period, PDO::PARAM_INT);
//$stmt->bindParam(':maxsub', $maxsub, PDO::PARAM_INT);


$stmt->execute();

//$stmt = null;


?>
