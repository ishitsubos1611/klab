<!DOCTYPE html> <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>シェアリングツアーガイドサービス</title>

    <style type='text/css'>

#map {
 width: 100%;
 height: 450px;
}
</style>

    <link rel="stylesheet" href="../css/0-3-A3.css">

<?php

 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];
 $gid = $_POST['gid'];
 $year = $_POST['year'];
 $location = $_POST['location'];

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
        document.myform3.action = "confirm_modify.php";
        //document.myform3.action = mode;
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
        //alert( document.myform3.location.value );
    }

    </script>
  </head>
  <body>


   <div class="main">
    <div class="startup">
    <form name="myform3" method='post'">
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
 echo  '<p>' . $year . '年' . $month . '月' . $day . '日' . 'のスケジュール修正中</p>';

?>
      </div>
<!--      <div class="message">
        <p><?php echo $modify_mode; ?>希望のスポットを
        クリックして下さい。</p>
      </div>
      <div class="map-wrapper">
          <div id="map"></div>
      </div>
      <div class="destination-wrapper">
         <p id = "message"><?php echo $modify_mode; ?>のスポット</p>
        <div class = "destination" id = "output"></div>
        <script>
          document.getElementById("output").style.display = "none";
        </script>
      </div>
-->
     <div class="message">
         <p><?php echo $location; ?>の<?php echo $modify_mode; ?></p>
     </div>

     <div class="select-wrapper">
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

      </div>

    </div>

      <p> 

      <div class="next-btn-parent"> 
        <input class="next-btn" type="submit" value="確認"/>
      </div>
      </form>

  </body>
</html>
