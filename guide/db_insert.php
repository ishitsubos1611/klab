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
$month = $_POST['month'];
$day = $_POST['day'];
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
$thisdate = $_POST['thisdate'];
$num_month = $_POST['num_month'];
list($thismonth, $thisday)= explode("-", $thisdate);

//  $last_day = date("t", mktime(0, 0, 0, $month, $year));
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
//if(!empty($thisdate)){
// INSERT

// for($j=0; $j<$num_month; $j++){

//   if($month+$j >= 13){ 
//     $year = $year+1;
//     $month = 0; 
//   }

//   $month += $j;
//   $last_day = date("t", mktime(0, 0, 0, $month+1, $year));
 
//   for($i=1; $i<=$last_day; $i++){

     $sql = "INSERT INTO G_Schedule (GID, year, date, start_time, end_time, Language, location, lat, `long`, max_num_participant, charge, payment_date, period) VALUES (:GID, :year, :date, :start_time, :end_time, :language, :location, :lat, :long, :max_num_participant, :charge, :payment_date, :period)";

    $stmt = $dbh->prepare($sql);
    //print_r($dbh->errorInfo());

     $dbdate = $month;
     $dbdate .= "-";
     $dbdate .= $day;

     $stmt->bindParam(':GID', $GID, PDO::PARAM_INT);
     $stmt->bindParam(':year', $year, PDO::PARAM_INT);
     $stmt->bindParam(':date', $dbdate, PDO::PARAM_STR);
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
 //  }
// }

//$stmt = null;


?>
