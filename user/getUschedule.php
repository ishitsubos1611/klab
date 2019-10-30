<?php
$uid = $_POST['uid'];
//$location = $_POST['location'];
//$lat = $_POST['lat'];
//$long = $_POST['long'];
//$time = $_POST['time'];
//$fee = $_POST['fee'];
//$maxsub = $_POST['maxsubject'];
//$gid = 1;

//$location = 'kodaiji';
// $lat = $_POST['lat'];
// $long = $_POST['long'];

// データベース接続

//$host = 'localhost';
$host = '127.0.0.1';
$dbname = 'tour_db';
$dbuser = 'yamamoto';
$dbpass = 'rikuya0217';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 var_dump($e->getMessage());
 echo '接続失敗';
 exit;
}

//データ取得
$sql = "SELECT * FROM U_Schedule WHERE UID = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($uid));

$guideData[] = array();
$start_time = 0;
$end_time = 0;


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$userData[]=array(
	'scheduleUID'=>$row['scheduleUID'],
    'uid'=>$row['UID'],
    'year'=>$row['year'],
    'date'=>$row['date'],
    'start_time'=>$row['start_time'],
    'end_time'=>$row['end_time'],
    'location'=>$row['location'],
    'language'=>$row['language'],
    'lat'=>$row['lat'],
    'long'=>$row['long'],
    'charge'=>$row['charge'],
    'max_num_participant'=>$row['max_num_participant'],
    'period'=>$row['period']
	);
  //$start_time = $row['start_time'];
  //$end_time = $row['end_time'];
  
} 

//jsonとして出力
 console.log($userData);
 header('Content-type: application/json');
 //echo json_encode($guideData,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
// echo json_encode($guideData,JSON_UNESCAPED_UNICODE);
echo json_encode($userData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

?>


