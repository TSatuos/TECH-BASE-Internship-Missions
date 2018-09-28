<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		佐藤颯太＠甘党は絶対ではない！が【mission_1-7】を達成しました！！<br><br>
		颯太は祝ってもらった人の名前をメモして、今度お返しにお祝いの言葉を言いに行きたいと考えています。<br><br><br>
		<form method="POST" action="mission_1-7.php">
		<input placeholder="おめでとう!by名前" type="text" name="input"  value="おめでとう!by">
		<input type="submit" value="送信">
		</form>
		<?php
		$data=$_POST["input"];
		if($data==""){
		}else{
			$filename = 'mission_1-7_SOTASATO.txt';
			$fp = fopen($filename,'a');
			fputs($fp,$data."\n");
			fclose($fp);
		}
		$text = file_get_contents('mission_1-7_SOTASATO.txt');
		$array = explode(PHP_EOL, trim($text));
		foreach($array as $note){
			echo $note . "<br>";
		}
		?>
	</body>
</html>