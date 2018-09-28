<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="POST" action="mission_2-1.php">
		<input type="text" name="input_name" placeholder="名前"><br>
		<input type="text" name="input_comment" placeholder="コメント"><br>
			<input type="submit" value="送信">
		</form>
		<?php
		//データ番号
			//ファイルの存在確認
			$filename = 'mission_2-1_SOTASATO.txt';
			if(file_exists($filename)){
			}else{
				//存在しない場合、新たに作成、https://www.flatflag.nir87.com/touch-829
				touch($filename);
			}
			//最終行取得、参考：http://taramonera.hatenadiary.jp/entry/20100508/1273314893
			$lines = file("mission_2-1_SOTASATO.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			$last=$lines[count($lines)-1];//echo $array_pop($lines);でも良い。
			if($last==""){
				$num[0]=0;
			}else{
				$num=explode("<>",$last);
			}
			//文字列番号を数値に変換、http://www.24w.jp/study_contents.php?bid=php&iid=php&sid=string&cid=005
			$n=intval($num[0])+1;
		//Punctuation(区切り)
			$p="<>";
		//Formデータ
			$data1=$_POST["input_name"];
			$data2=$_POST["input_comment"];
		//日時
			$t=date("Y年m月d日 H:i:s");
		//データベースに保存
			if($data1==""){
			}else{
				$fp = fopen($filename,'a');
				fputs($fp,$n.$p.$data1.$p.$data2.$p.$t."\n");
				fclose($fp);
			}
		//データベースから履歴データ取得
/*
		$text = file_get_contents('mission_2-1_SOTASATO.txt');
		$array = explode("\n", trim($text));
		foreach($array as $note){
			echo $note . "<br>";
		}
*/
		?>
	</body>
</html>