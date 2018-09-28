<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
			//Formデータ
			$data1=$_POST["input_name"];
			$data2=$_POST["input_comment"];
			$data3=$_POST["input_delete_num"];
			$data4=$_POST["input_change"];
			$data5=$_POST["input_change_num"];
			//ファイルの存在確認
			$filename = 'mission_2-4_SOTASATO.txt';
			if(file_exists($filename)){
			}else{
				//存在しない場合、新たに作成、https://www.flatflag.nir87.com/touch-829
				touch($filename);
			}
			//Punctuation(区切り)
			$p="<>";
		?>
		<form method="POST" action="mission_2-4-1.php">
			<input type="text" name="input_name" placeholder="名前"><br>
			<input type="text" name="input_comment" placeholder="コメント">
			<input type="hidden" name="input_change" value="<?php echo $data5?>">
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
		//編集・追記
			if($data4==""){
			//追記モード
				//最新データ番号++
				//最終行取得、参考：http://taramonera.hatenadiary.jp/entry/20100508/1273314893
				$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				$last=$lines[count($lines)-1];//echo $array_pop($lines);でも良い。
				if($last==""){
					$num[0]=0;
				}else{
					$num=explode("<>",$last);
				}
				$n=intval($num[0])+1;
				//日時
				$t=date("Y年m月d日 H:i:s");
				//データベースに書き込み
				if($data1==""){//コメントなしでも送信可能
				}else{
					$fp = fopen($filename,'a');
					fputs($fp,$n.$p.$data1.$p.$data2.$p.$t."\n");
					fclose($fp);
				}
			}else{
			//編集モード
				//データ全取得
				$content = file_get_contents($filename);
					$arr = explode("\n", trim($content));
					//ファイルを空にする
					$fp = fopen($filename,'w');
					fclose($fp);
					//再書き込み
					$fp = fopen($filename,'a');
					foreach($arr as $str){
						$row=explode($p,$str);
						if($row[0]!=$data4){
							fputs($fp,$str."\n");
						}else{
							//日時
							$t=date("Y年m月d日 H:i:s");
							fputs($fp,$data4.$p.$data1.$p.$data2.$p.$t.$p."\n");
						}
					}
					fclose($fp);
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