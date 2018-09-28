<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="POST" action="mission_1-6.php">
		<input type="text" name="input" value="コメント">
		<input type="submit" value="送信">
		</form>
		<?php
		header('Content-Type: text/html; charset=UTF-8');
		$data=$_POST["input"];
		if($data==""){
		}else{
			if($data=="完成!"){
				echo "おめでとう!";
			}else{
				echo "ご入力ありがとうございます。<br>".date("Y年m月d日H時i分")."に".$data."を受け付けました";
			}
		$filename = 'mission_1-6_SOTASATO.txt';
		$fp = fopen($filename,'ab');
		fputs($fp,$data."\n");
		fclose($fp);
		}
		?>
	</body>
</html>