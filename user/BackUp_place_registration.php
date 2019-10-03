<!DOCTYPE html>
  <head>
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
   <script>

      var map;
      var marker = [];
      var markerData = [];
      var areaVal = "<?php $area = $_POST['area']; echo $area ?>";

      $(function(){
        $.ajax({
          type:"POST",
          url:"poi_dbconnect.php",
          dataType:"json",
          data:{
             area : areaVal 
          }
        }).done(function(data){
          console.log(data);
          //alert(data[0].lat);
          markerData = data;
        }).fail(function(xhr,err){
          console.log(err);
        });
      });

      var MKData = JSON.parse('{"lat":35.004089,"lng":135.758452}');
      var timerID = 0;

      StartTimer = function() {
        timerID = setInterval(ajaxMap, 500);
      };

      StopTimer = function() {
        clearInterval(timerID);
      };

      function initMap(){
        // #mapに地図を埋め込む
        //var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']});
        var mapLatLng = new google.maps.LatLng(MKData['lat'], MKData['lng']);
        //var mapLatLng = new google.maps.LatLng(35.700000,139.772000);
        map = new google.maps.Map(document.getElementById('map'), {
          center: mapLatLng,
          zoom: 14 // 地図のズームを指定
        });

        for (var i = 0; i < markerData.length; i++) {
          markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']}); // 緯度経度のデータ作成
          marker[i] = new google.maps.Marker({ // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map // マーカーを立てる地図を指定
        });
         markerEvent(i);//メソッド呼び出し
	       //console.log(markerData[0]['lat']);
	       //console.log(MKData['lat'], MKData['lng']);
       }
      }

      function add_marker() {
        for (var i = 0; i < mapData.length; i++) {
          var item = mapData[i];

          // マーカーの設置
          var marker = new google.maps.Marker({
            position: item['latlng'],
            map: map
          });
        }
      }

      function markerEvent(i) {
        google.maps.event.addListener(marker[i], 'click', (function(JPname,lat,lng){
          return function(){
            $form_name = JPname;
            $form_lat = lat;
            $form_lng = lng;
            target = document.getElementById("output");
            target.innerHTML = JPname;
            target.style.display = "block";
           // target.innerHTML = "【　" + JPname + "  】";
           // target = document.getElementById("message");
           // target.innerHTML = "ガイド可能な場所";
          };
        })(markerData[i].JPname, markerData[i].lat, markerData[i].lng));
      }
      function ajaxMap(){
        initMap();
        if( $('#map').find('div').length ){
          // マーカー毎の処理
          StopTimer();
        }
      }
      $(function() {
        StartTimer();
      });

//formにactionとvalueを代入する
  function checkText3() {
 
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "confirm.php";
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
        //alert( document.myform3.location.value );
    }

    </script>
  </head>
  <body>


   <form name="myform3" method='post' onsubmit="return checkText3()">
    <input name = "location" type="hidden" />
    <input name = "lat" type="hidden" />
    <input name = "lng" type="hidden" />
<?php

 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];
 $gid = $_POST['gid'];

 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = month' .' type=hidden value="' . $month . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
//echo '<p>text' .  $month . '<br>' . $area;

?>
    <div class="main">
      <div class="startup">
        <p>名所登録中</p>
      </div>
      <div class="message">
        <p>ガイド可能な場所のピンを
        クリックして下さい。</p>
      </div>
      <div class="map-wrapper">
          <div id="map"></div>
      </div>
      <div class="destination-wrapper">
         <p id = "message">ガイド可能な場所</p>
        <div class = "destination" id = "output"></div>
        <script>
          document.getElementById("output").style.display = "none";
        </script>
      </div>

     <div class="select-wrapper">
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

    </div>

      <p> 

      <div class="next-btn-parent"> 
        <input class="next-btn" type="submit" value="Next"/>
      </div>
      </form>

  </body>
</html>
