<!DOCTYPE html>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>シェアリングツアーガイドサービス</title>

<style type='text/css'>

#map {
 width: 100%;
 height: 450px;
}
</style>

    <link rel="stylesheet" href="../css/0-3-A3.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvUA-zwsf7ihPqKggFYt8wOsdNaEXz134" async="async" defer="defer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>

   <div class="main">
    <div class="startup">

<?php

 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];
 $gid = $_POST['gid'];
 $year = $_POST['year'];
//echo $sGID = $_POST['scheduleGID'];

// $location = 'nijo';

 if($mode == 0){
  $modify_mode = "変更";
  $mode_url ="confirm_modify.php";
 }elseif($mode == 1) {
  $modify_mode = "追加";
  $mode_url ="confirm_modify.php";
 }elseif($mode == 2) {
  $modify_mode = "削除";
  $mode_url ="confirm_delete.php";
 }

?>

<script>

  function checkText3() {
 
        //actionメソッドに遷移先のURLを代入する
        //document.myform3.action = "confirm_modify.php";
        document.myform3.action = "<?php echo $mode_url ?>";
    }

</script>

     <form name="myform3" method='post' onsubmit="return checkText3()">

<?php


 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = year' .' type=hidden value="' . $year . '">';
 echo '<input name = month' .' type=hidden value="' . $month . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
// echo '<input name = location' .' type=hidden value="' . $location . '">';
// echo '<input name = sGID' .' type=hidden value="' . $sGID . '">';

 echo  '<p>' . $year . '年' . $month . '月' . $day . '日' . 'のガイド登録' . $modify_mode. '中</p> </div>';
// echo '<div class="message">  <p> ' . $year . '年' . $month . '月' . $day . '日の' . $modify_mode ;

// データベースDB接続

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

if($mode == 0 ){


 echo   '<p class="select-title">' . $modify_mode. 'するスポットを選択して下さい</p>  <select name="scheduleGID" require>';

$date = $month . "-" . $day;
//データ取得
//$sql = "SELECT * FROM G_Schedule WHERE GID = ?";
$sql = "SELECT * FROM G_Schedule WHERE GID = ? AND date = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid, $date));

$guideData[] = array();

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
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['long'],
    'charge'=>$row['charge'],
    'max_num_participant'=>$row['max_num_participant']
        );
    echo '<option value="' . $row['scheduleGID'] . '" >' . $row['location']. ' : ' .$row['start_time'].'-'.$row['end_time']. "</option>";
} 

echo ' </select>
        </div>
        <p></p>
      </div>';

echo 
    ' <div class="select-wrapper"> 
        <p class = "select-title">ガイド開始時間</p>
     </div>';
//    <div class="message">
//         <p> '
//     . $year . '年' . $month . '月' . $day . '日の' 
//     . $modify_mode  
//    . '</p>
//    </div>
echo       ' <div class="select-btn guide-select">
            <select name=starttime required>
              <option value="8:00">8:00</option>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
              <option value="13:00">13:00</option>
              <option value="14:00">14:00</option>
              <option value="15:00">15:00</option>
              <option value="16:00">16:00</option>
              <option value="17:00">17:00</option>
            </select>
        </div> 
        <p class = "select-title">ガイド終了時間</p>
        <div class="select-btn guide-select">
            <select name=endtime required>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
              <option value="13:00">13:00</option>
              <option value="14:00">14:00</option>
              <option value="15:00">15:00</option>
              <option value="16:00">16:00</option>
              <option value="17:00">17:00</option>
              <option value="18:00">18:00</option>
            </select>
        </div> 
        <p class = "select-title">ガイド時間</p>
        <div class="select-btn guide-select">
            <select name=time required>
              <option value="10">10分</option>
              <option value="20">20分</option>
              <option value="30">30分</option>
              <option value="40">40分</option>
              <option value="50">50分</option>
              <option value="60">60分</option>
              <option value="70">70分</option>
              <option value="80">80分</option>
              <option value="90">90分</option>
            </select>
        </div>
        <p class ="select-title">料金</p>
        <div class="select-btn guide-select">
          <select name="fee" required>
            <option value="100">100円</option>
            <option value="200">200円</option>
            <option value="250">250円</option>
            <option value="290">290円</option>
            <option value="350">350円</option>
            <option value="490">490円</option>
            <option value="590">590円</option>
            <option value="690">690円</option>
            <option value="790">790円</option>
            <option value="1000">1,000円~</option>
          </select>
        </div>
        <p class="select-title">最大人数</p>
        <div class="select-btn guide-select">
          <select name="maxsubject" required>
            <option value="5">5人</option>
            <option value="10">10人</option>
            <option value="12">12人</option>
            <option value="15">15人</option>
            <option value="20">20人</option>
          </select>
        </div>

        <p class="select-title">対応可能言語</p>
        <div class="select-btn guide-select">
            <input type="checkbox" name="language[]"  value="JP" checked="checked">日本語</option>
            <input type="checkbox" name="language[]"  value="EN">英語</option>
            <input type="checkbox" name="language[]"  value="CH">中国語</option>
            <input type="checkbox" name="language[]"  value="FR">フランス語</option>
            <input type="checkbox" name="language[]"  value="DE">ドイツ語</option>
          </select>
        </div>

      </div>

    </div>'
;

}elseif($mode == 1){

 echo   '<p class="select-title">' . $modify_mode. 'するスポットを選択して下さい</p>  <select name="location" require>';

$date = $month . "-" . $day;
//データ取得
//$sql = "SELECT * FROM G_Schedule WHERE GID = ?";
$sql = "SELECT * FROM G_Schedule WHERE GID = ? ";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid));

$guideData[] = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $guideData[]=array(
        'GuidScheduleID'=>$row['scheduleGID'],
    'GuideID'=>$row['GID'],
    'year'=>$row['year'],
    'date'=>$row['date'],
    'guidelocation'=>$row['location'],
    'requiredTime'=>$row['period'],
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['long'],
    'charge'=>$row['charge'],
    'max_num_participant'=>$row['max_num_participant']
        );
 if(empty($row['year']) && empty($row['date'])){
    echo '<option value="' . $row['location'] . '" >' . $row['location']. ' : （ガイド時間）' .$row['period'].'分：' .$row['charge'] . '円：最大人数：' .$row['max_num_participant']. '人：（対応言語）' .$row['Language']. "</option>";


 }
} 

echo ' </select>
        </div>
        <p></p>
      </div>';

echo 
    ' <div class="select-wrapper"> 
        <p class = "select-title">時間帯(開始時刻）</p>
     </div>';

echo       ' <div class="select-btn guide-select">
            <select name=starttime required>
              <option value="8:00">8:00</option>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
              <option value="13:00">13:00</option>
              <option value="14:00">14:00</option>
              <option value="15:00">15:00</option>
              <option value="16:00">16:00</option>
              <option value="17:00">17:00</option>
            </select>
        </div> 
        <p class = "select-title">時間帯(終了時刻）</p>
        <div class="select-btn guide-select">
            <select name=endtime required>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
              <option value="13:00">13:00</option>
              <option value="14:00">14:00</option>
              <option value="15:00">15:00</option>
              <option value="16:00">16:00</option>
              <option value="17:00">17:00</option>
              <option value="18:00">18:00</option>
            </select>
        </div> 

      </div>

    </div>'
;

}elseif($mode == 2){

 echo   '<p class="select-title">削除するスケジュールを選択して下さい</p>  <select name="scheduleGID" require>';


$date = $month . "-" . $day;
//データ取得
//$sql = "SELECT * FROM G_Schedule WHERE GID = ?";
$sql = "SELECT * FROM G_Schedule WHERE GID = ? AND date = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid, $date));

$guideData[] = array();

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
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['long'],
    'charge'=>$row['charge'],
    'max_num_participant'=>$row['max_num_participant']
        );
    echo '<option value="' . $row['scheduleGID'] . '" >' . $row['location']. ' : ' .$row['start_time'].'-'.$row['end_time']. "</option>";
} 

//jsonとして出力
// $json_guideData =  json_encode($guideData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
//print_r($json_guideData);

echo '          </select>
        </div>
        <p></p>
      </div>';

}//mode =2 の時

?>


      <p> 

      <div class="next-btn-parent"> 
        <input class="next-btn" type="submit" value="確認"/>
      </div>
      </form>

  </body>
</html>