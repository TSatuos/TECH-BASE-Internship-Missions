<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="POST" action="mission_1-5.php">
		<input type="text" name="input" value="コメント">
		<input type="submit" value="送信">
		</form>
		<?php
//header('Content-Type: text/html; charset=UTF-8');
		if($_POST["input"]==""){
		}else{
			if($_POST["input"]=="完成!"){
				echo "おめでとう!";
			}else{
				echo "ご入力ありがとうございます。<br>".date("Y年m月d日H時i分")."に".$_POST["input"]."を受け付けました";
			}
		$filename = 'mission_1-5_SOTASATO.txt';
		$fp = fopen($filename,'w');
		fwrite($fp,$_POST["input"]);
		fclose($fp);
		}
		?>
	</body>
</html>