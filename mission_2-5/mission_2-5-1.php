<html lang="ja">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
			//Formデータ
			$data1=$_POST["input_name"];
			$data2=$_POST["input_comment"];
			$data4=$_POST["input_change"];
			$data5=$_POST["input_change_num"];
			$data6=$_POST["input_passwd"];
			$data8=$_POST["input_change_passwd"];
			$edit_mode=$_POST["mode"];
			//ファイルの存在確認
			$filename = 'mission_2-5_SOTASATO.txt';
			if(file_exists($filename)){
			}else{
				//存在しない場合、新たに作成、https://www.flatflag.nir87.com/touch-829
				touch($filename);
			}
			//Punctuation(区切り)
			$p="<>";
			//編集フォームから来たか判断
			if($data5!=""){//編集フォームから来ました！
				//データ全取得
				$content = file_get_contents($filename);
					$arr = explode("\n", trim($content));
					foreach($arr as $str){
						$row=explode($p,$str);
						if($row[0]!=$data5){
						}else{
							//passwd認証
							if($row[4]!=$data8){
								echo "パスワードが違います。<br>";
								$edit_mode=0;
							}else{
								$data1=$row[1];
								$data2=$row[2];
								$edit_mode=1;
							}
						}
					}
			}else{//編集以外のフォームから来ました！
				//編集・追記
				if(intval($edit_mode)==0){
				//追記モード
					//最新データ番号++
					//最終行取得、参考：http://taramonera.hatenadiary.jp/entry/20100508/1273314893
					$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					$last=$lines[count($lines)-1];//echo $array_pop($lines);でも良い。
					if($last==""){
						$num[0]=0;
					}else{
						$num=explode($p,$last);
					}
					$n=intval($num[0])+1;
					//日時
					$t=date("Y年m月d日 H:i:s");
					//データベースに書き込み
					if($data1==""){//コメントなしでも送信可能
					}else{
						$fp = fopen($filename,'a');
						fputs($fp,$n.$p.$data1.$p.$data2.$p.$t.$p.$data6."\n");
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
							fputs($fp,$data4.$p.$data1.$p.$data2.$p.$t.$p.$data6."\n");
						}
					}
					fclose($fp);
					$edit_mode=0;
				}
			}
		?>
		<form method="POST" action="mission_2-5-1.php">
			<input type="text" name="input_name" placeholder="名前" value="<?php echo $data1?>"><br>
			<input type="text" name="input_comment" placeholder="コメント" value="<?php echo $data2?>"><br>
			<input type="hidden" name="input_change" value="<?php echo $data5?>">
			<input type="text" name="input_passwd" placeholder="パスワード">
			<input type="submit" value="送信"><br>
			<input type="hidden" name="mode" value="<?php echo $edit_mode ?>">
		</form>
		<form method="POST" action="mission_2-5-2.php">
			<input type="text" name="input_delete_num" placeholder="削除対象番号"><br>
			<input type="text" name="input_delete_passwd" placeholder="パスワード">
			<input type="submit" value="削除"><br>
		</form>
		<form method="POST" action="mission_2-5-1.php">
			<input type="text" name="input_change_num" placeholder="編集対象番号"><br>
			<input type="text" name="input_change_passwd" placeholder="パスワード">
			<input type="submit" value="編集"><br>
		</form>
		<?php
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