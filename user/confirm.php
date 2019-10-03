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
 <form name="datapost" action="db_insert.php" method="post">

<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 //$mode = $_POST['mode'];
 $gid = $_POST['gid'];
 $year = $_POST['year'];
$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['lng'];
$period = $_POST['time'];
$fee = $_POST['fee'];
$maxsub = $_POST['maxsubject'];
//$language = $_POST['language'];
$language = implode("、", $_POST['language']);

 if(empty($location)){
  $location = "スポットが選択されていません";
  $final_step = "トップに戻る";
 }else{
  $db_mode = 1; //0はdelete、1はinsert、2はchange 
  $final_step = "登録";
 }

//$GID = 2;
$year = 1920;
$date = 'all';
$start_time = '8:00';
$end_time = '17:00';
//$language = 'JP';
//$location = '高台寺';
//$lat = 35.00051;
//$long = 135.781218;
//$max_num_participant = 10;
//$charge = 500;
$payment_date = '8';
//$period = 30;

 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
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

if($db_mode == 1){
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
$sql = "SELECT * FROM Guide_Schedule WHERE location = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($location));

$guideData[] = array();
//$start_time = 0;
//$end_time = 0;

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

}else{

}

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
   <!--   <div class="btn-wrapper">
         <a href="../top.html" class = "resistration" onclick="dbinsert();" ><?php echo $final_step; ?></a>
      </div>
<p>
         <INPUT class="resistration" type="submit" name = "datapost" value='<?php echo $final_step; ?>'>
   --> 
         <INPUT class="resistration" type="submit" value='<?php echo $final_step; ?>'>
 </form>

      <div class="btn-wrapper">
       <form>
<p>         <INPUT class="resistration" type="button" onClick='history.back();' value="戻る">
       </form>
      </div>
    </div>
  </body>
</html>

