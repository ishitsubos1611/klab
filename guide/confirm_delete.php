<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>登録確認</title>
    <link rel="stylesheet" href="../css/2-3-A.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </head>
  <body>

<?php
//    ini_set('display_errors',1);//画面にエラーを表示
//    error_reporting(E_ALL);//全ての種類のエラーを表示
//    session_start(); 
//    if(isset($_POST['datapost'])){
//     $_SESSION['name'] = $_POST['name']; 
//    }
?>

<p>
 <form name="datapost" action="db_delete.php" method="post">

<?php

echo $scheduleGID = $_POST['scheduleGID'];
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
$sql = "SELECT * FROM G_Schedule WHERE scheduleGID = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($scheduleGID));

$guideData[] = array();
//$start_time = 0;
//$end_time = 0;

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$guideData[]=array(
        'GuidScheduleID'=>$row['scheduleGID'],
    'GuideID'=>$row['GID'],
    'year'=>$row['year'],
    'date'=>$row['date'],
    'start_time'=>$row['start_time'],
    'end_time'=>$row['end_time'],
    'guidelocation'=>$row['location'],
    'requiredTime'=>$row['period'],
    'language'=>$row['language'],
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['long'],
    'charge'=>$row['charge'],
    'max_num_participant'=>$row['max_num_participant']
	);
$location = $row['location'];
$gid = $row['gid'];
$year = $row['year'];
$period = $row['period'];
$fee = $row['charge'];
$maxsub = $row['max_num_participant'];
//$language = $_POST['language'];
$language = implode("、", $row['language']);
} 

//jsonとして出力
// header('Content-type: application/json');
// echo json_encode($guideData,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

//$GID = 2;
//$date = 'all';
$start_time = '8:00';
$end_time = '17:00';

 echo '<input name = scheduleGID' .' type=hidden value="' . $scheduleGID . '">';
 echo '<input name = year' .' type=hidden value="' . $year . '">';
// echo '<input name = month' .' type=hidden value="' . $month . '">';
 echo '<input name = date' .' type=hidden value="' . $date . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = lat' .' type=hidden value="' . $lat . '">';
 echo '<input name = long' .' type=hidden value="' . $long . '">';
 echo '<input name = start_time' .' type=hidden value="' . $start_time . '">';
 echo '<input name = end_time' .' type=hidden value="' . $end_time . '">';
 echo '<input name = language' .' type=hidden value="' . $language. '">';
 echo '<input name = fee' .' type=hidden value="' . $fee. '">';
 echo '<input name = maxsub' .' type=hidden value="' . $maxsub. '">';
 echo '<input name = period' .' type=hidden value="' . $period. '">';
 echo '<input name = payment_day' .' type=hidden value="' . $payment_date. '"><br>';

?>


      <div class="startup">
        <p>確認</p>
      </div>
      <div class="confirmation-wrapper">
        <p class = "destination" id = "location-output"><?php echo $location; ?></p>
        <p class="time-zone check-list">8:00-18:00
        <p class="time red check-list">ガイド時間：<?php echo $period; ?>分</p>
        <p class="message">Language : <?php echo implode("、", $_POST['language']);?>　</p>
        <p class="charge red check-list">Charge ¥<?php echo $fee; ?> (1~<?php echo $maxsub?>名)</p>
      </div>
         <INPUT class="resistration" type="submit" value='削除'>
 </form>

      <div class="btn-wrapper">
       <form>
<p>         <INPUT class="resistration" type="button" onClick='history.back();' value="戻る">
       </form>
      </div>
    </div>
  </body>
</html>

