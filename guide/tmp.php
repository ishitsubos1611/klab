<?php 

$GID = 2;
$year = 2019;
$date = '9月2日';
$start_time = '8:00';
$end_time = '17:00';
$language = 'JP';
$location = '高台寺';
$lat = 35.00051;
$long = 135.781218;
$max_num_participant = 10;
$charge = 500;
$payment_date = null;
$period = 30;

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
$sql = "INSERT INTO G_Schedule (GID, year, date, start_time, end_time, Language, location, lat, `long`, max_num_participant, charge, payment_date, period) VALUES (:GID, :year, :date, :start_time, :end_time, :language, :location, :lat, :long, :max_num_participant, :charge, :payment_date, :period)";
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
