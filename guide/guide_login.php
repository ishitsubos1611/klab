<?php
// セッション開始
session_start();

$host = "localhost";  // DBサーバのURL
$dbuser = "ishi";  // ユーザー名
$dbpass = "asdf1611";  // ユーザー名のパスワード
$dbname = "account_db";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
  // １．ユーザIDの入力チェック

  if (empty($_POST["userid"])) {
    $errorMessage = "ユーザIDが未入力です。";
  }

  if (empty($_POST["password"])) {
    $errorMessage = "パスワードが未入力です。";
  }

  // ２．ユーザIDとパスワードが入力されていたら認証する
  if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
      try {
      $dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, [PDO::ATTR_EMULATE_PREPARES => false]);

    } catch (PDOException $e) {
      var_dump($e->getMessage());
      echo '接続失敗';
      exit;
    }

    // 入力したユーザIDを格納
    $userid = $_POST["userid"];

    $stmt = $dbh->prepare('SELECT * FROM G_account WHERE Gname = ?');
    $stmt->execute(array($userid));


    if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // パスワード(暗号化済み）の取り出し
      $db_hashed_pwd = $row['password'];
    }

    // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
    if (password_verify($_POST["password"], $db_hashed_pwd)) {
      // ４．認証成功なら、セッションIDを新規に発行する
      session_regenerate_id(true);
      $_SESSION["USERID"] = $_POST["userid"];
      header("Location: ../top.html");
      exit;
    }else {
      // 認証失敗
      $errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
    }
  }
}

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ログイン画面</title>
</head>
<body>
  <h1>ログイン画面</h1>
  <form id="loginForm" name="loginForm" action="" method="POST">
    <div><?php echo $errorMessage ?></div>
    <p>ユーザID<input type="text" id="userid" name="userid" value="<?php echo htmlspecialchars($_POST["userid"], ENT_QUOTES); ?>"></p>
    <p>パスワード<input type="password" id="password" name="password" value=""></p>
    <input type="submit" id="login" name="login" value="ログイン">
  </form>
  <p><a href="guide_signup.php">ユーザー情報登録ページへ</a></p>
</body>
</html>
