<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];
 $gid = $_POST['gid'];

 if($mode == 0){
  $modify_mode = "変更";
 }elseif($mode == 1) {
  $modify_mode = "追加";
 }

$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$stime = $_POST['starttime'];
$etime = $_POST['endtime'];
$time = $_POST['time'];
$fee = $_POST['fee'];
$maxsub = $_POST['maxsubject'];
$language = $_POST['language'];

 if(empty($location)){
  $location = "スポットが選択されていません";
  $modify_mode = "トップに戻る";
 }


//$location = 'kodaiji';
// $lat = $_POST['lat'];
// $long = $_POST['long'];
// データベース接続
//echo $location;

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
$sql = "SELECT * FROM Guide_Schedule WHERE location = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($location));

$guideData[] = array();
$start_time = 0;
$end_time = 0;


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$guideData[]=array(
	'スケジュールID'=>$row['scheduleGID'],
    'ガイドID'=>$row['GID'],
    'ガイドする年月日'=>$row['date'],
    '開始予定時刻'=>$row['start_time'],
    '終了予定時刻'=>$row['end_time'],
    'ガイドのいる予定場所名'=>$row['location'],
    'ガイドのいる予定場所の緯度'=>$row['lat'],
    'ガイドのいる予定場所の経度'=>$row['long'],
    '指定料金'=>$row['charge']
	);
  $start_time = $row['start_time'];
  $end_time = $row['end_time'];
  
} 

//jsonとして出力
// header('Content-type: application/json');
// echo json_encode($guideData,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

//$time = $start_time - $end_time;

?>


<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $_POST['month']; ?>月<?php echo $_POST['day']; ?>日の<?php echo $modify_mode; ?></title>
    <link rel="stylesheet" href="../css/2-3-A.css">
  </head>
  <body>
    <div class="main">
      <div class="startup">
        <p><?php echo $_POST['month']; ?>月<?php echo $_POST['day']; ?>日の<?php echo $modify_mode;?> </p>
      </div>
      <div class="confirmation-wrapper">
        <p class = "destination" id = "location-output"><?php echo $location; ?></p>
        <p class="time-zone check-list"><?php echo $stime; ?>-<?php echo $etime; ?>
        <p class="time red check-list">ガイド時間：<?php echo $time; ?>分</p>
        <p class="message">Language : <?php echo implode("、", $_POST['language']);?>　</p>
        <p class="charge red check-list">Charge ¥<?php echo $fee; ?> (1~<?php echo $maxsub?>名)</p>
      </div>
      <div class="btn-wrapper">
         <a href="../top.html" class = "resistration"><?php echo $modify_mode;?> </a>
      </div>
<p>
      <div class="btn-wrapper">
       <form>
<p>         <INPUT class="resistration" type="button" onClick='history.back();' value="戻る">
       </form>
      </div>
    </div>
  </body>
</html>

<!-- <html>
<head></head>
<body>
<p>
	<?php 
		// echo 'ガイドする年月日', $date;
		// echo '<br>';
		// echo '開始予定時刻', $start_time;
		// echo '<br>';
		// echo '終了予定時刻', $end_time;
		// echo 'ガイドのいる予定場所名', $location;
		// echo '指定料金', $charge;
		// echo '<br>';

	?>
</p> 
</body>
</html> -->

