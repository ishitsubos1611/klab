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
 $uid = $_POST['uid']; 
 $year = $_POST['year'];
 $location = $_POST['location'];
 $start_time = $_POST['start_time'];
 $end_time = $_POST['end_time'];
 $stime = $_POST['start_time'];
 $period = $_POST['period'];
 $participants = $_POST['participants']; 

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
        document.myform3.action = "user_confirm.php";
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
    <form name="myform3" method='post' onsubmit="return checkText3()">
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
 echo '<input name = uid' .' type=hidden value="' . $uid . '">';    
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = language' .' type=hidden value="' . $language . '">';    
 echo '<input name = stime' .' type=hidden value="' . $stime . '">';
 echo '<input name = end_time' .' type=hidden value="' . $end_time . '">';    
 echo '<input name = period' .' type=hidden value="' . $period . '">';
 echo '<input name = participants' .' type=hidden value="' . $participants . '">';    
 //echo  '<p>' . $year . '年' . $month . '月' . $day . '日' . 'のスケジュール修正中</p>';



?>

      <div class="message">
        <!--<p><?php echo $modify_mode; ?>希望のガイドさんを
        クリックしてください。</p>-->
           <p>希望のガイドさんをチェックしてください。</p> 
      </div>
    <!--
        <input type="checkbox" name="sample" value="1">ガイド1
        <input type="checkbox" name="sample" value="2">ガイド2
        <input type="checkbox" name="sample" value="3">ガイド3
    -->    
      <div id="guide"></div>

      <div id="output"></div>

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
        var guide = [];
        var guideData = [];
        var locationVal = "<?php $location = $_POST['location']; echo $location ?>";
        var stimeVal = "<?php $start_time = $_POST['start_time']; echo $start_time ?>";
	var periodVal = "<?php echo $period=$_POST['period'] ?>";
	var participants = "<?php echo $participants=$_POST['participants'] ?>";
	var language = "<?php echo $language=implode("、",$_POST['language']) ?>";
	//var submit = $('<input>');
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
                console.log(guideData); 
                console.log(stimeVal);
                console.log(locationVal);
	        console.log(periodVal);
	        console.log(participants);
	        console.log(guideData[0].charge);
                //console.log(dateVal);
	        selectGuide();
            }).fail(function(xhr,err){
                console.log(err);
            });
          });
      
        //if(guideData === []){
        //    $('#cal').append('<div id="guide" class="info"><p>申し訳ありませんが、現在ご希望の名所をガイドできるものがいません。</p></div>');
   // }
      function selectGuide(){
	if(guideData.length == 0){
            $('#guide').html('<p>申し訳ありませんが、現在ご希望の名所をガイドできるものがいません。</p>');
	}
	console.log(guideData.length);
	console.log(<?php echo $uid; ?>);
        //console.log(guideData[0]['date']);
	
          for (var i = 0; i <guideData.length; i++){
					       
	    //console.log(guideData[i]['date']);	      
	    //var div = $('<div id="guide" class="info"><p>ガイドID：'+guideData[i].GID+'</p></div>');
	    //function() {				       
		$('#guide').append('<p>ガイドID：'+guideData[i].GID+'　<input type="checkbox"></p>');
		//$('input[type="checkbox"]').attr('id','checkbox'+i);			       
		$('input[type="checkbox"]').attr('name','guide');
		$('input[type="checkbox"]').attr('value',guideData[i].GID);			       
	        //document.getElementById("checkbox").value = guideData[i].GID;
	    //}			       
	    //document.getElementById("checkbox").name = guide[i];
	    //console.log(document.getElementByName("guide[0]").value);				     
	    //$.post('user_confirm.php', name='guideData[i].charge');
					     
            /*$('#cal').append('<div id="guide" class="info"><p>　(人気)　'+guideData[i].location+'ガイド </p>'
          +'<table id="states"><tr><td>Date</td><td>'+monthVal+'月'+dayVal+'日</td></tr><tr><td>GuideID</td><td>'+guideData[i].GID+'</td></tr><tr><td>Boarding time</td><td>'+guideData[i].start_time+'</td></tr>'
          +'<tr><td>END</td><td>'+guideData[i].end_time+'</td><td>('+guideData[i].period+'min)</td></tr>'
          +'<tr><td>Language</td><td>'+guideData[i].language+'</td></tr>'
          +'<tr><td>Total fee</td><td>¥'+guideData[i].charge+'</td><td>('+guideData[i].max_num_participant+'名)</td></tr></table></div>');*/
	  
	}
        //console.log(document.getElementById("checkbox").value);
	
	/*function onCheckBox() {
	    var check = document.myform3.checkbox.checked;
            var value = document.getElement("checkbox").value;
            var target = document.getElementById("output");
            
            if(check == true) {
	       target.innerHTML = "さんをチェックしています。";				     
	    }				     
	    $('#output').html(<p>ガイド'+value+'さんにチェックしました。);				     
	}*/				     

      $('input').on('change',function() {
	   //var vals=[];
  	   //var check=[];				   
	   //$('input[name=guide]:checked').each(function() {
	   var vals = $('input:checked').map(function() {				     
               //var check=$(this).prop('checked');
	       //vals.push($(this).val());
	       return $(this).val();			     
	   }).get();
	       var check = $(this).prop('checked');	 			     
               if(check == true) {
		  $('#output').html('<p>ガイド'+vals+'さんにチェックしました。</p>');
		  //$.post("user_confirm.php",charge=value);
		  //$('form').html('<input id="submit_charge" type="hidden" name="charge" value="">');
		  			     
		  console.log(check);
		  console.log(vals);			     
	       }else{
                  $('#output').html('');
		  console.log(check);
		  console.log(vals);			     
	       }
		  console.log(vals);
		  //console.log(vals[1]);	     
           //});
      }); 
					     
   }				    
      //});
      //showGuide();					    
					     
    //});
   </script>

  
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
