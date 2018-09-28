<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="POST" action="mission_2-4-1.php">
			<input type="text" name="input_name" placeholder="名前"><br>
			<input type="text" name="input_comment" placeholder="コメント">
			<input type="hidden" name="input_change">
			<input type="submit" value="送信"><br>
		</form>
		<form method="POST" action="mission_2-4-2.php">
			<input type="text" name="input_delete_num" placeholder="削除対象番号">
			<input type="submit" value="削除"><br>
		</form>
		<form method="POST" action="mission_2-4-1.php">
			<input type="text" name="input_change_num" placeholder="編集対象番号">
			<input type="submit" value="編集"><br>
		</form>
		<?php
		//Formデータ
			$data3=$_POST["input_delete_num"];
		//Punctuation(区切り)
			$p="<>";
		//書き込みの消去
			//ファイルの存在確認
			$filename = 'mission_2-4_SOTASATO.txt';
			if(file_exists($filename)){
			}else{
				//存在しない場合、新たに作成、https://www.flatflag.nir87.com/touch-829
				touch($filename);
			}
			//削除
			if($data3==""){//番号なし＝消去なし
			}else{
				//データ全取得
				$content = file_get_contents($filename);
				if($content!=""){//中身が空でなければ次へ進む
					$arr = explode("\n", trim($content));
					//ファイルを空にする
					$fp = fopen($filename,'w');
					fclose($fp);
					//再書き込み
					$fp = fopen($filename,'a');
					foreach($arr as $str){
						$row=explode($p,$str);
						if($row[0]!=$data3){
							fputs($fp,$str."\n");
						}
					}
					fclose($fp);
				}
			}
		//データベースから履歴データ取得し、表示
			$text = file_get_contents($filename);
			$array = explode("\n", trim($text));
			foreach($array as $note){
				$text=explode($p,$note);
				echo $text[0]."\t".$text[1]."\t".$text[2]."\t".$text[3]."\t"."<br>";
			}
		?>
	</body>
</html>