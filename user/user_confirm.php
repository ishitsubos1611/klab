<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>登録確認</title>
    <link rel="stylesheet" href="../css/2-3-A.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>

history.pushState(null, null, null);
$(window).on("popstate", function (event) {
  if (!event.originalEvent.state) {
    history.pushState(null, null, null);
    return;
  }
});

</script>

  </head>
  <body>

<?php
//    ini_set('display_errors',1);//画面にエラーを表示
//    error_reporting(E_ALL);//全ての種類のエラーを表示
//    session_start(); 
//    if(isset($_POST['datapost'])){
//      $_SESSION['name'] = $_POST['name']; 
//    }
?>

<p>
 <form name="myform3" method='post' onsubmit="return checkText3()">

<?php    
 //$ginfo = array();
 $ginfo = explode(",",$_POST['guide']);
 $stime = explode(":",$_POST['stime'],-1); 
 //$area = $_POST['area'];
 //$style = $_POST['style'];
 //$month = $_POST['month'];
 //$day = $_POST['day'];
 //$ginfo = $_POST['guide'];
 if(!empty($ginfo)){  
  $gid = $ginfo[0];
  $fee = $ginfo[1];
 }
 $uid = $_POST['uid']; 
 $year = $_POST['year'];
 $date = $_POST['date']; 
$location = $_POST['location'];
//$lat = $_POST['lat'];
//$long = $_POST['lng'];
$period = (int) $_POST['period'];
$end = [];  
if($period >= 60) {
  //$period_h = $period % 60;
  //$period_m = $period -	60;
  $end_h = (int) $stime[0] + floor($period / 60);
  $end_m = (int) $stime[1] + ($period - 60);
  if($end_h >= 24){
    $end_h = $end_h - 24;
  }
  if($end_m >= 60){
    $end_h = $end_h + floor($end_m / 60);
    $end_m = $end_m % 60;
  }
  if(0 <= $end_m && $end_m < 10) {
    $end_m = "0".$end_m;
  }			   
  array_push($end,$end_h,$end_m);
}else{
  $end_h = (int) $stime[0];
  $end_m = (int) $stime[1] + $period;
  if($end_m >= 60){
    $end_h = $end_h + floor($end_m / 60);
    $end_m = $end_m % 60;
  }
  if(0 <= $end_m && $end_m < 10) {
    $end_m = "0".$end_m;
  }			     
  array_push($end,$end_h,$end_m);
}
 $end_time = implode(":",$end);
$participants = $_POST['participants'];  
$start_time = implode(":",$stime);  
//$fee = $_POST['charge'];
//$participants = $_POST['participants'];
//$language = $_POST['language'];
$language = $_POST['language'];
//$thisdate = $_POST['thisdate'];
//$thismonth = $_POST['thismonth'];
//$thisyear = $_POST['thisyear'];
$payment_date = '8';
$confirm = "確認";  
  
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = uid' .' type=hidden value="' . $uid . '">'; 
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = year' .' type=hidden value="' . $year . '">'; 
 echo '<input name = date' .' type=hidden value="' . $date . '">'; 
 //echo '<input name = lat' .' type=hidden value="' . $lat . '">';
 //echo '<input name = long' .' type=hidden value="' . $long . '">';
 echo '<input name = start_time' .' type=hidden value="' . $start_time . '">';
 echo '<input name = end_time' .' type=hidden value="' . $end_time . '">'; 
 echo '<input name = language' .' type=hidden value="' . $language. '">';
 echo '<input name = fee' .' type=hidden value="' . $fee . '">';
 echo '<input name = participants' .' type=hidden value="' . $participants. '">';
 echo '<input name = period' .' type=hidden value="' . $period. '">';
 echo '<input name = payment_day' .' type=hidden value="' . $payment_date. '"><br>';

 if(empty($location)){
  $location = "スポットが選択されていません";
  $final_step = "トップに戻る";
  $stepNum = 0;
 }
 else if(empty($gid)){
   $confirm="ガイドさんの募集"; 
   $reserve =   "". $year . "年"  . $date . "";
   $gid = "募集中";
   $fee = 0; 
   $final_step = "登録";
   $stepNum = 1;
   echo '<input name = gid' .' type=hidden value="' . $gid . '">';
   echo '<input name = fee' .' type=hidden value="' . $fee . '">';
 }else{
   //echo '<input name = gid' .' type=hidden value="' . $gid . '">';
   //echo '<input name = fee' .' type=hidden value="' . $fee . '">';  
   $reserve =   "". $year . "年"  . $date . "";
   $final_step = "登録";
   $stepNum = 1;
 }

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
$sql = "SELECT * FROM U_Schedule WHERE UID = ? ";
//$dblocation = "'". $location . "'";
//$dblocation = '京都鉄道博物館';
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($uid));


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
  
  /*if(($location == $row['location']) && ($date == $row['date'])){

   $location = "既に" . $location . "は登録されています";
   $reserve = "既に" . $year . "年" . $date . "に登録済みのガイド予定があります";
   $final_step = "削除";
   $stepNum = 2;
  
   $scheduleUID = $row['scheduleUID'];
   echo '<input name = scheduleUID' .' type=hidden value="' . $scheduleUID. '">'; 
  }*/
 /* else if(($row['date'] == NULL && $location == $row['location'])){
   //$location = $row['location'];
   //$date == $row['date'];
   $reserve = "既に" . $year . "年" . $row['date'] . "に登録済みのガイド予定があります";
   $final_step = "削除";
   $stepNum = 2;

   $scheduleUID = $row['scheduleUID'];
   echo '<input name = scheduleUID' .' type=hidden value="' . $scheduleUID. '">';
  }*/
  //今は削除にしているが、日付が同じ場合はupdateで登録情報を変更できるようにしたい
  /* else if($date == $row['date']) {
   $reserve = "既に" . $year . "年" . $date . "に登録済みのガイド予定があります";
   $location = "この日は既に" . $row['location'] . "のガイド希望登録をしています";
   $final_step = "削除";
   $stepNum = 2;
   $scheduleUID = $row['scheduleUID'];
   echo '<input name = scheduleUID' .' type=hidden value="' . $scheduleUID. '">';
  }*/
}

?>

<script>
  //デバッグ用
   console.log('<?php echo $location ?>');
   //console.log('<?php echo $row['location'] ?>');
   console.log('<?php echo $gid ?>');
   console.log('<?php echo $fee ?>');
   console.log('<?php echo $date ?>');
   console.log('<?php echo $start_time ?>');
   console.log(<?php echo $scheduleUID ?>);
   console.log(<?php echo $year ?>);
   console.log('<?php echo $end_time ?>');
   //console.log('<?php echo (int) $stime[0] ?>');
  //console.log('<?php echo (int) $stime[0] + ($period % 60) ?>');
</script>

<script>

 function checkText3() {

    var dbVal = <?php echo $stepNum ?>;
 
    //console.log(<?php echo $fee ?>);
 
    if(dbVal == 2){
      document.myform3.action = "user_db_delete.php"; 
    } else if (dbVal == 1) { 
      document.myform3.action = "user_db_insert.php"; //ユーザのDBに登録するプログラム
    } else if( dbVal == 0) { 
      document.myform3.action = "./user_top.html"; 
  }
} 

</script> 
      <div class="startup">
        <p><?php echo $confirm; ?></p>
      </div>
      <div class="confirmation-wrapper">
        <p class = "destination" id = "location-output"><?php echo $location; ?></p>
 <!--       <p class="time-zone check-list">
         <?php echo $check_month; ?>：
         8:00-18:00
  -->
 <!-- <p class="time red check-list">ガイドさん：<?php echo $gid; ?></p> -->
        <p class="time red check-list">ガイド予約日：<?php echo $reserve; ?></p>
	<p class="time red check-list">開始時間：<?php echo $start_time; ?></p>
        <p class="time red check-list">ガイド時間：<?php echo $period; ?>分</p>
        <p class="message">Language : <?php echo $language ?>　</p>
        <p class="charge red check-list">Charge ¥<?php echo $fee; ?> (1~<?php echo $participants?>名)</p>
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
<p><!--         <INPUT class="resistration" type="button" onClick='history.back();' value="戻る"> -->
      <a href="user_select_area.php" class = "resistration" >戻る</a>
      </div>

       </form>
      </div>
    </div>
  </body>
</html>

