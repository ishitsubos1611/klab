<!DOCTYPE html>
 <head>
     <!--
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     -->
     <meta cherset="UTF-8">
    <title>シェアリングツアーガイドサービス</title>

    <style type='text/css'> 

#map {
 width: 100%;
 height: 450px;
}
</style>
    <link rel="stylesheet" href="../css/0-3-A1.css">
    <link rel="stylesheet" href="../css/0-3-A3.css">
    <link rel="stylesheet" href="../css/calender.css">

<?php

 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];
 $gid = $_POST['gid'];
 $year = $_POST['year'];
 $location = $_POST['location'];
 $start_time = $_POST['start_time'];
 $end_time = $_POST['end_time'];
 $stime = $_POST['start_time'];

// $location = 'nijo';

 if($mode == 0){
  $modify_mode = "変更";
 }elseif($mode == 1) {
  $modify_mode = "追加";
 }

?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvUA-zwsf7ihPqKggFYt8wOsdNaEXz134" async="async" defer="defer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>

//formにactionとvalueを代入する
  function checkText3() {
 
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "user_confirm_modify.php";
        //document.myform3.action = mode;
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
        //alert( document.myform3.location.value );
      //console.log($start_time);
    }

    </script>
  </head>
  <body margin:auto; text-align:center;>


   <div class="main">
    <div class="startup">
        ガイドさんの選択
       </div>
    <form name="myform3" method='post'>
<!--    <form name="myform3" method='post' onsubmit="return checkText3()">
    <input name = "location" type="hidden"/>
    <input name = "lat" type="hidden" />
    <input name = "lng" type="hidden" />
    <div class="main">
      <div class="startup">
-->
   <?php
 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = year' .' type=hidden value="' . $year . '">';
 echo '<input name = month' .' type=hidden value="' . $month . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 //echo  '<p>' . $year . '年' . $month . '月' . $day . '日' . 'のスケジュール修正中</p>';


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
$sql = "SELECT * FROM G_Schedule WHERE (? between start_time and end_time) AND location=?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($stime,$location));

$guideData[] = array();
$start_time = 0;
$end_time = 0;


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $guideData[]=array(
        'GuidScheduleID'=>$row['scheduleGID'],
    'GuideID'=>$row['GID'],
    'year'=>$row['year'],
    'date'=>$row['date'],
    'start_time'=>$row['start_time'],
    'end_time'=>$row['end_time'],
    'language'=>$row['Language'],
    'guidelocation'=>$row['location'],
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['long'],
    'charge'=>$row['charge'],
    'max_num_participant'=>$row['max_num_participant'],
    'payment_date'=>$row['payment_date'],
    'period'=>$row['period']
        );
  //$start_time = $row['start_time'];
  //$end_time = $row['end_time'];

}

//jsonとして出力
 //console.log($guideData);
 //header('Content-type: application/json');
 //echo json_encode($guideData,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
 //echo json_encode($guideData,JSON_UNESCAPED_UNICODE);
 //$json_guideData =  json_encode($guideData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
 $json_guideData =  json_encode($guideData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
//print_r($json_guideData);
//echo '<input name = json_guideData' .' type=hidden value="' . $json_guideData . '">';

?>

      <div class="message">
        <!--<p><?php echo $modify_mode; ?>希望のガイドさんを
        クリックしてください。</p>-->
           <p>希望のガイドさんをチェックしてください。</p> 
      </div>
    
        <input type="checkbox" name="sample" value="1">ガイド1
        <input type="checkbox" name="sample" value="2">ガイド2
        <input type="checkbox" name="sample" value="3">ガイド3
        
        <div id="guide"></div>
<!--
      <div id="cal">
        <input type="checkbox" name="sample" value="1">ガイド1
        <input type="checkbox" name="sample" value="2">ガイド2
        <input type="checkbox" name="sample" value="3">ガイド3
      </div>

<!--      <div class="map-wrapper">
          <div id="map"></div>
      </div>
-->
<!--      <div class="destination-wrapper">
         <p id = "message"><?php echo $modify_mode; ?>のスポット</p>
        <div class = "destination" id = "output"></div>
        <script>
          document.getElementById("output").style.display = "none";
        </script>
      </div>

     <div class="message">
         <p><?php echo $location; ?>の<?php echo $modify_mode; ?></p>
     </div>
-->
    <script>
    console.log("<?php $start_time = $_POST['start_time']; echo $start_time ?>");
    //console.log("<?php $json_guideData = $_POST['json_guideData']; echo $json_guideData ?>");
    </script>
  <script>
    //$(function(){
        var guideData = [];
        var locationVal = "<?php $location = $_POST['location']; echo $location ?>";
        var stimeVal = "<?php $start_time = $_POST['start_time']; echo $start_time ?>";
        //$.post('select_date.php','cellnum');
        //var data = JSON.parse('<?php echo addslashes($json_guideData);  ?>');
        $(function(){
            $.ajax({
                type:"POST",
                url:"guide_recommend.php",
                dataType:"json",
                data:{
                    location : locationVal,
                    stime    : stimeVal 
                }
            }).done(function(data){
                console.log(data);
                //alert(data[0].lat);
                guideData = data;
                console.log(stimeVal);
                console.log(locationVal);
                //console.log(dateVal);
            }).fail(function(xhr,err){
                console.log(err);
            });
        });
        //var json_guideData = json_encode(guideData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        //var data = JSON.parse('<?php echo addslashes($json_guideData);  ?>');
        /*if(guideData === []){
            $('#cal').append('<div id="guide" class="info"><p>申し訳ありませんが、現在ご希望の名所をガイドできるものがいません。</p></div>');
        }*/
        for(var i =0; i < guideData.length; i++){
            //var div = $('<div id="guide" class="info"><p>ガイドID：'+guideData[i].GID+'</p></div>');
            $('#guide').html('<div class="info"><p>ガイドID：'+guideData[i].GID+'</p></div>');
            /*$('#cal').append('<div id="guide" class="info"><p>　(人気)　'+guideData[i].location+'ガイド </p>'
          +'<table id="states"><tr><td>Date</td><td>'+monthVal+'月'+dayVal+'日</td></tr><tr><td>GuideID</td><td>'+guideData[i].GID+'</td></tr><tr><td>Boarding time</td><td>'+guideData[i].start_time+'</td></tr>'
          +'<tr><td>END</td><td>'+guideData[i].end_time+'</td><td>('+guideData[i].period+'min)</td></tr>'
          +'<tr><td>Language</td><td>'+guideData[i].language+'</td></tr>'
          +'<tr><td>Total fee</td><td>¥'+guideData[i].charge+'</td><td>('+guideData[i].max_num_participant+'名)</td></tr></table></div>');*/
        }
    //});
   </script>

<!--     <div class="select-wrapper">
        <p class = "select-title">ガイド開始時間</p>
        <div class="select-btn guide-select">
            <select name=starttime required>
              <option value="8:00">8:00</option>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
            </select>
        </div> 
        <p class = "select-title">ガイド終了時間</p>
        <div class="select-btn guide-select">
            <select name=endtime required>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
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
            </select>
        </div>
        <p class ="select-title">料金</p>
        <div class="select-btn guide-select">
          <select name="fee" required>
            <option value="100">100円</option>
            <option value="200">200円</option>
            <option value="300">300円</option>
            <option value="400">400円</option>
            <option value="500">500円</option>
            <option value="600">600円</option>
            <option value="700">700円</option>
            <option value="800">800円</option>
            <option value="900">900円</option>
            <option value="more">1,000円~</option>
          </select>
        </div>
        <p class="select-title">最大人数</p>
        <div class="select-btn guide-select">
          <select name="maxsubject" required>
            <option value="10">10人</option>
            <option value="12">12人</option>
            <option value="15">15人</option>
            <option value="18">18人</option>
            <option value="20">20人</option>
          </select>
        </div>
-->
      </div>

    </div>

      <p> 

      <div class="next-btn-parent"> 
        <input class="next-btn" type="submit" value="確認"/>
      </div>
      </form>

  </body>
</html>