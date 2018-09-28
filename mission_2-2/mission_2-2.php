<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="POST" action="mission_2-2.php">
		<input type="text" name="input_name" placeholder="名前"><br>
		<input type="text" name="input_comment" placeholder="コメント">
			<input type="submit" value="送信">
		</form>
		<?php
		//データ番号
			//ファイルの存在確認
			$filename = 'mission_2-2_SOTASATO.txt';
			if(file_exists($filename)){
			}else{
				//存在しない場合、新たに作成、https://www.flatflag.nir87.com/touch-829
				touch($filename);
			}
			//最終行取得、参考：http://taramonera.hatenadiary.jp/entry/20100508/1273314893
			$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			$last=$lines[count($lines)-1];//echo $array_pop($lines);でも良い。
			if($last==""){
				$num[0]=0;
			}else{
				$num=explode("<>",$last);
			}
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
			$text = file_get_contents($filename);
			$array = explode("\n", trim($text));
			foreach($array as $note){
				$text=explode($p,$note);
				echo $text[0]."\t".$text[1]."\t".$text[2]."\t".$text[3]."\t"."<br>";
			}
		?>
	</body>
</html>