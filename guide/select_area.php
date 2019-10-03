<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>STEP 1</title>

  <link rel="stylesheet" href="../css/0-3-A1.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>

<?php 
 $select_step = $_POST['step'];

 if($select_step == 1){
  $step = "./place_registration.php";
 }elseif($select_step == 2) {
  $step = "./select_date.php";
 }

?>
<form name="step1" action="select_date.php" method='post'>
 <div class="main">
      <div class="btn-wrapper">


        <p>IDを入力して下さい</p>
        <div class="select-btn guide-select">
          <input name = "gid" style=text value="1">
        </div>

        <p>エリアを選択してください</p>
        <div class="select-btn guide-select">
          <select name="area" >
            <option value="kyoto" >近畿（京都）</option>
            <option value="kanto" >関東</option>
          </select>
        </div>

        <p>名所か道案内か選択してください</p>
        <div class="select-btn guide-select">
          <select name="style" >
            <option value="1" >名所ガイド</option>
            <option value="2" >道案内ガイド</option>
          </select>
        </div>

        <p></p>

       <input class = "btn resistration" type="submit" value="Next">
        <p></p>
       <input class = "btn resistration" type="reset" value="入力内容をリセットする">
      </div>
 </div>
 </form> 


 </body>
</html>
