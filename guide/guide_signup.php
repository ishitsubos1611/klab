<?php
// セッション開始
session_start();

$host = "localhost";  // DBサーバのURL
$dbuser = "ishi";  // ユーザー名
$dbpass = "asdf1611";  // ユーザー名のパスワード
$dbname = "account_db";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        $password = $_POST["password"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $host, $dbname);

        // 3. エラー処理
        try {
	    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, [PDO::ATTR_EMULATE_PREPARES => false]);
            $stmt = $pdo->prepare("INSERT INTO G_account(Gname, password) VALUES (?, ?)");

            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>新規登録</title>

	    <link rel="stylesheet" href="../css/bootstrap.css">
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
      <div class="main">
        <nav class="navbar navbar-dark bg-dark fixed-top">
          <a class="navbar-brand" href="../top.html">シェアリングツアーガイド</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          </button>
        </nav>
	
        <div class="container-fluid">
          <div class="text-center">
            <br><br><br>
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <div><a href="#"  class = "btn btn-danger disabled btn-lg btn-block" >新規登録画面</a></div>
              </div>
            </div>
            <br>

            <form id="loginForm" name="loginForm" action="" method="POST">
            <div>
                <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
                <div><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></div>
		<br>
		<div class="form-group row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-2">
                    <p>ユーザID</p>
                  </div>
                  <div class="col-sm-5">
		    <input type="text" class="form-control "id="username" name="username" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
		  </div>
		</div>
		<div class="form-group row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-2">
                    <p>パスワード</p>
                  </div>
                  <div class="col-sm-5">
		    <input type="password" class="form-control" id="password" name="password" value="" placeholder="パスワードを入力">
		  </div>
		</div>
		<div class="form-group row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-3">
                    <p>パスワード(確認用)</p>
                  </div>
                  <div class="col-sm-5">
		    <input type="password" class="form-control" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
		  </div>
		</div>
		<br>
		<div class="row">
                  <div class="col-sm-2"></div>
          	  <div class="col-sm-4">
		    <a href="guide_login.php" class="btn btn-outline-info btn-lg btn-block" >戻る</a>
		  </div>
		  <div class="col-sm-4">
		    <p><input class="btn btn-outline-info btn-lg btn-block"  type="submit" id="signUp" name="signUp" value="新規登録"></p>
		  </div>
		</div>
		  
   <!--         </div>
        </form>
        <form action="guide_login.php">
            <p><input type="submit" value="戻る"></p>
        </form>   -->
	      </div>
	    </div>
	  </div>
    </body>
</html>
