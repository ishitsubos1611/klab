<?php 
//プログラムエラー出力
error_reporting(E_ALL);
ini_set('display_errors', '1');

//$GID = $_POST['GID'];
//$date = $_POST['date'];
//$start_time = $_POST['start-time'];
//$end_time = $_POST['end-time'];
//$location = $_POST['location'];
// $lat = $_POST['lat'];
// $long = $_POST['long'];
// $max_num_participant = $_POST['max_num_participant'];
// $charge = $_POST['charge'];
// $period = $_POST['period'];

$GID = 1;
$year = 2019;
$date = 901;  //0901だと、「Parse error:  Invalid numeric literal」と出る
$start_hour = 8;
$start_minute = 0;
$end_hour = 17;
$end_minute = 0;
$location = 'kodaiji';
$lat = '35.00051';
$long = '135.781218';
$max_num_participant = 10;
$charge = 200;
$period = 10;

$host = '127.0.0.1';
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
$sql = "INSERT INTO Guide_Schedule (GID, year, date, start_hour, start_minute, end_hour, end_minute, location, lat, `long`, max_num_participant, charge, period) VALUES (:GID, :year, :date, :start_hour, :start_minute, :end_hour, :end_minute, :location, :lat, :long, :max_num_participant, :charge, :period)";

$stmt = $dbh->prepare($sql);
//エラー出力
//print_r($dbh->errorInfo());

$stmt->bindParam(':GID', $GID, PDO::PARAM_INT);
$stmt->bindParam(':year', $year, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':start_hour', $start_hour, PDO::PARAM_INT);
$stmt->bindParam(':start_minute', $start_minute, PDO::PARAM_INT);
$stmt->bindParam(':end_hour', $end_hour, PDO::PARAM_INT);
$stmt->bindParam(':end_minute', $end_minute, PDO::PARAM_INT);
$stmt->bindParam(':location', $location, PDO::PARAM_STR);
$stmt->bindParam(':lat', $lat, PDO::PARAM_STR);
$stmt->bindParam(':long', $long, PDO::PARAM_STR);
$stmt->bindParam(':max_num_participant', $max_num_participant, PDO::PARAM_INT);
$stmt->bindParam(':charge', $charge, PDO::PARAM_INT);
$stmt->bindParam(':period', $period, PDO::PARAM_INT);


$stmt->execute();

$stmt = null;




?>



