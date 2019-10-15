<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $year = $_POST['year'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];
 $gid = $_POST['gid'];
 $scheduleGID = $_POST['scheduleGID'];

 if($mode == 0){
  $modify_mode = "変更";
 }elseif($mode == 1) {
  $modify_mode = "登録（追加)";
 }

$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$stime = $_POST['starttime'];
$etime = $_POST['endtime'];
$time = $_POST['time'];
$fee = $_POST['fee'];
$maxsub = $_POST['maxsubject'];
//$language = $_POST['language'];
$language = implode("、", $_POST['language']);


// データベース接続

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



if($mode == 0){
//データ取得
$sql = "SELECT * FROM G_Schedule WHERE scheduleGID = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($scheduleGID));

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
  $location = $row['location'];
} 

}elseif($mode == 1){
//データ取得
$sql = "SELECT * FROM G_Schedule WHERE GID = ? AND location = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid, $location));


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     $row['scheduleGID'];
     $time = $row['period'];
     $location = $row['location'];
     $fee = $row['charge'];
     $language = $row['Language'];
     $maxsub = $row['max_num_participant'];
} 

}
?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
  <title><?php echo $_POST['month']; ?>月<?php echo $_POST['day']; ?>日の<?php echo $modify_mode; ?></title>
    <!--<link rel="stylesheet" href="../css/2-3-A.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>

  function checkText3() {
   var mode = <?php echo $mode ?> 
   if(mode == 0){ 
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "db_update.php";
   }else if(mode == 1){ 
        document.myform3.action = "db_insert.php";
   }
  }

</script>

  </head>
  <body>

<p>
<!-- <form name="datapost" action="db_update.php" method="post"> -->
 <form name="myform3" method='post' onsubmit="return checkText3()">

<?php
 echo '<input name = year' .' type=hidden value="' . $year . '">';
 echo '<input name = month' .' type=hidden value="' . $month . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = scheduleGID' .' type=hidden value="' . $scheduleGID . '">';
 echo '<input name = start_time' .' type=hidden value="' . $stime . '">';
 echo '<input name = end_time' .' type=hidden value="' . $etime . '">';
 echo '<input name = period' .' type=hidden value="' . $time . '">';
 echo '<input name = fee' .' type=hidden value="' . $fee . '">';
 echo '<input name = maxsub' .' type=hidden value="' . $maxsub . '">';
 echo '<input name = language' .' type=hidden value="' . $language . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';
?>

    <div class="main">
      <div class="container-fluid">
        <div class="text-center">	
	    <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <div class = "btn btn-danger disabled btn-xl btn-block">
                  <p><?php echo $year; ?>年<?php echo $_POST['month']; ?>月<?php echo $_POST['day']; ?>日の<?php echo $modify_mode;?> </p>
		</div>
              </div>
	    </div>
	    <p></p>
      <div class="confirmation-wrapper">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
	    <div class = "btn btn-danger disabled btn-xl btn-block">
              <p class = "destination" id = "location-output"><?php echo $location; ?></p>
	    </div>
	  </div>
	</div>
        <p class="time-zone check-list"><?php echo $stime; ?>-<?php echo $etime; ?>
        <p class="time red check-list">ガイド時間：<?php echo $time; ?>分</p>
        <p class="message">Language : <?php echo $language;?>　</p>
        <p class="charge red check-list">Charge ¥<?php echo $fee; ?> (1~<?php echo $maxsub?>名)</p>
      </div>
<!--      <div class="btn-wrapper">
         
         <a href="../top.html" class = "resistration"><?php echo $modify_mode;?> </a>
      </div>
<p>-->
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <INPUT class="btn btn-info btn-lg btn-block" type="submit" value='<?php echo $modify_mode; ?>'>
	</div>
      </div>
      <p></p>
</form>
      <div class="btn-wrapper">
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
       	  <form>
<p>         <INPUT class="btn btn-info btn-lg btn-block" type="button" onClick='history.back();' value="戻る">
          </form>
        </div>
      </div>
      </div>
    </div>
  </body>
</html>

<head></head>
<body>
<p>

