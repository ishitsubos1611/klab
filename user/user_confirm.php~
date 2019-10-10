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
//     $_SESSION['name'] = $_POST['name']; 
//    }
?>

<p>
 <form name="myform3" method='post' onsubmit="return checkText3()">

<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
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
$thisdate = $_POST['thisdate'];
$thismonth = $_POST['thismonth'];
$thisyear = $_POST['thisyear'];

$payment_date = '8';

 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = lat' .' type=hidden value="' . $lat . '">';
 echo '<input name = long' .' type=hidden value="' . $long . '">';
 echo '<input name = language' .' type=hidden value="' . $language. '">';
 echo '<input name = fee' .' type=hidden value="' . $fee. '">';
 echo '<input name = maxsub' .' type=hidden value="' . $maxsub. '">';
 echo '<input name = period' .' type=hidden value="' . $period. '">';
 echo '<input name = payment_day' .' type=hidden value="' . $payment_date. '"><br>';

 if(empty($location)){
  $location = "スポットが選択されていません";
  $final_step = "トップに戻る";
  $stepNum = 0;
 }else{
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
$sql = "SELECT * FROM G_Schedule WHERE GID = ?  AND location = ? ";
//$dblocation = "'". $location . "'";
//$dblocation = '京都鉄道博物館';
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid,$location));


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

  if(($location == $row['location']) && (empty($row['date']))){

   $location = "既に" . $location . "は登録されています";
   $final_step = "削除";
   $stepNum = 2;
  
   $scheduleGID = $row['scheduleGID'];  
   echo '<input name = scheduleGID' .' type=hidden value="' . $scheduleGID. '">'; 
  }
} 


?>

<script>

 function checkText3() {

    var dbVal = <?php echo $stepNum ?>; 

    if(dbVal == 2){
      document.myform3.action = "db_delete.php";
    } else if (dbVal == 1) { 
      document.myform3.action = "insert_place.php";
    } else if( dbVal == 0) { 
      document.myform3.action = "../top.html";
  }
}

</script>
      <div class="startup">
        <p>確認</p>
      </div>
      <div class="confirmation-wrapper">
        <p class = "destination" id = "location-output"><?php echo $location; ?></p>
 <!--       <p class="time-zone check-list">
         <?php echo $check_month; ?>：
         8:00-18:00
-->
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
<p><!--         <INPUT class="resistration" type="button" onClick='history.back();' value="戻る"> -->
      <a href="select_area_regist.php" class = "resistration" >戻る</a>
      </div>

       </form>
      </div>
    </div>
  </body>
</html>

