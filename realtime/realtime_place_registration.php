<!DOCTYPE html>
  <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>シェアリングツアーガイドサービス</title>

<script>
history.pushState(null, null, null);
$(window).on("popstate", function (event) {
  if (!event.originalEvent.state) {
    history.pushState(null, null, null);
    return;
  }
});
</script>

    <style type='text/css'>
#map {
 width: 100%;
 height: 450px;
}
</style>

    <link rel="stylesheet" href="../css/0-3-A3.css">
    <script src="https://maps.googleapis.com/maps/api/js?language=jakey=AIzaSyCvUA-zwsf7ihPqKggFYt8wOsdNaEXz134" async="async" defer="defer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script>
      var map;
      var marker = [];
      var markerData = [];
      var guideData = [];
      var areaVal = "<?php echo $area = $_POST['area']; ?>";
      var gidVal = "<?php echo $gid = $_POST['uid']; ?>";
      var nowdateVal = "<?php echo date('n-j'); ?>";
      var nowtimeVal = "<?php echo date('H:i:s'); ?>";
      var categoryVal = "<?php $area= $_POST['category']; echo $area ?>";
      var nowLat, nowLng;
      
      $(function(){
        $.ajax({
          type:"POST",
          url:"poi_dbconnect.php",
          dataType:"json",
          data:{

            area : 'kyoto', 
            //category : categoryVal
            category : 'all',
      lat : '35.069162899999995',
      long : '135.7556467'

          }
        }).done(function(data,nowdate,nowtime){
          console.log(data);
      //alert(data[0].lat);
      alert(nowdateVal);
      alert(nowtimeVal);
          markerData = data;
        }).fail(function(xhr,err){
          console.log(err);
        });
      });
      $(function(){
        $.ajax({
          type:"POST",
          url:"guide_dbconnect.php",
          dataType:"json",
          data:{
      gid : gidVal,
      nowdate : nowdateVal,
      nowtime : nowtimeVal
          }
        }).done(function(data){
          console.log(data);
      guideData = data;
      //alert(nowdateVal);
      //alert(nowtimeVal);
        }).fail(function(xhr,err){
          console.log(err);
        });
      });
      // 位置取得成功した場合
      function success(position) {
	var data = position.coords ;
　　　	nowLat = data.latitude ;
	nowLng = data.longitude;
	//nowLat = 35.010174;
        //nowLng = 135.759193;
	//alert("緯度["+ nowLat +"] 経度["+ nowLng +"]");
      }
      // 取得失敗した場合
      function error(error) {
        switch(error.code) {
            case 1: //PERMISSION_DENIED
            alert("位置情報の利用が許可されていません");
            break;
            case 2: //POSITION_UNAVAILABLE
            alert("現在位置が取得できませんでした");
            break;
            case 3: //TIMEOUT
            alert("タイムアウトになりました");
            break;
            default:
            alert("その他のエラー(エラーコード:"+error.code+")");
            break;
        }
      }
      
      navigator.geolocation.getCurrentPosition(success, error);
      var timerID = 0;
      StartTimer = function() {
        timerID = setInterval(ajaxMap, 500);
      };
      StopTimer = function() {
        clearInterval(timerID);
      };
      function initMap(){
	// alert("緯度["+ nowLat +"] 経度aaaa["+ nowLng +"]");    
	// #mapに地図を埋め込む
	 
	 var mapLatLng = new google.maps.LatLng(nowLat, nowLng);
	map = new google.maps.Map(document.getElementById('map'), {
        center: mapLatLng,
      scaleControl: true ,//スケールバー表示
      zoom: 16 // 地図のズームを指定

       	});
        for (var i = 0; i < markerData.length; i++) {
          //アイコンの種類指定
          icon = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/icons/blue-dot.png',new google.maps.Size(70,84),new google.maps.Point(0,0));
          for (j = 0; j <guideData.length; j++){
            if( markerData[i]['JPname'] == guideData[j]['location']){
               icon = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/icons/pink-dot.png',new google.maps.Size(70,84),new google.maps.Point(0,0));
            }
          }
 
          // 緯度経度のデータ作成^M
          markerLatLng = new google.maps.LatLng({
           lat: markerData[i]['lat'], 
           lng: markerData[i]['lng']
          }); 
          // マーカーの追加
          marker[i] = new google.maps.Marker({ 
            position: markerLatLng, // マーカーを立てる位置を指定
            icon: icon, //色を指定
            map: map // マーカーを立てる地図を指定
					   
	  });
          markerEvent(i);//メソッド呼び出し
       }
      } 

      var currentInfoWindow = null; //吹き出しチェック
      function markerEvent(i) {
        google.maps.event.addListener(marker[i], 'click', (function(JPname,lat,lng){
          return function(){
            $form_name = JPname;
            $form_lat = lat;
            $form_lng = lng;
            target = document.getElementById("output");
            target.innerHTML = JPname;
            target.style.display = "block";

					   
          // 吹き出しに出す文
          myInfoWindow = new google.maps.InfoWindow({
            content: markerData[i]['JPname'],
            disableAutoPan: true //自動移動を解除
	  });

	  // 開いている他の吹き出しがあれば非表示
          if (currentInfoWindow) {
              currentInfoWindow.close();
          }				   
					   
           // 吹き出しを開く
          myInfoWindow.open(map, marker[i]);
          //markerEvent(i);//メソッド呼び出し
          // 開いている吹き出しを記憶
	  currentInfoWindow = myInfoWindow;
          };
	//}
      //}
      //function markerEvent(i) {
        //google.maps.event.addListener(marker[i], 'click', (function(JPname,lat,lng){
          //return function(){
            //$form_name = JPname;
            //$form_lat = lat;
            //$form_lng = lng;
            //target = document.getElementById("output");
            //target.innerHTML = JPname;
            //target.style.display = "block";
          //};
        })(markerData[i].JPname, markerData[i].lat, markerData[i].lng));
      //}
        google.maps.event.addListener(marker, 'mouseover', function(){
          infowin.open(map, marker);
        });
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
        document.myform3.action = "user_select_date.php";
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
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
 $uid = $_POST['uid'];
 $thisday = date('j');
 $thismonth = date('n');
 $thisyear = date('Y');
 $thisdate = date('n-j');
      
 if($style = '1') $famous = '名所';
 else if($style = '2') $teach = '道案内';
 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = thisdate' .' type=hidden value="' . $thisdate . '">';
 echo '<input name = thisyear' .' type=hidden value="' . $thisyear . '">';
 echo '<input name = thismonth' .' type=hidden value="' . $thismonth . '">';
 echo '<input name = thisday' .' type=hidden value="' . $thisday . '">';
 echo '<input name = uid' .' type=hidden value="' . $uid . '">';
?>
    <div class="main">
      <div class="startup">
<!--        <p><?php echo $thisyear ?> 年<?php echo $thismonth ?>月から2ヶ月間の名所登録中</p> -->
        <p><?php echo $famous; ?>ガイド</p>
      </div>
      <div class="message">
        <p>ガイドしてほしい<?php echo $famous; ?>のピンを
        クリックして下さい。</p>
      </div>
     <p align="center"> ピンク色のピンは既にガイドさんが登録しているスポットです </p>
      <div class="map-wrapper">
          <div id="map"></div>
      </div>
      <div class="destination-wrapper">
         <p id = "message">選択した名所</p>
        <div class = "destination" id = "output"></div>
        <script>
          document.getElementById("output").style.display = "none";
          //console.log(document.getElementById("output"));
        </script>
      </div>

     <div class="select-wrapper">
          <p class = "select-title">ガイド時間</p>
          <div class="select-btn guide-select">
            <select name=time>
              <option value="10">~10分</option>
              <option value="20">10~20分</option>
              <option value="30">20~30分</option>
              <option value="40">30~40分</option>
              <option value="50">40~50分</option>
              <option value="60">50~60分</option>
              <option value="70">60~70分</option>
              <option value="80">70~80分</option>
              <option value="90">80~90分</option>
            </select>
        </div>

       <p class="select-title">参加人数</p>
        <div class="select-btn guide-select">
          <select name="maxsubject">
           <option value="1">1人</option>
           <option value="2">2人</option>
           <option value="3">3人</option>
           <option value="4">4人</option>
           <option value="5">5人</option>
           <option value="6">6人</option>
           <option value="7">7人</option>
           <option value="8">8人</option>
           <option value="9">9人</option>
          </select>
        </div>

        <p class="select-title">あなたの言語</p>
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

