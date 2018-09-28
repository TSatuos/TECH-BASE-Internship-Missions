<html>
<body>
<form method="POST" action="mission_1-4.php">
<input  value="コメント" type="text" name="input">
<input type="submit" value="送信">
</label>
</form>
<?php
echo "ご入力ありがとうございます。<br>".date("Y年m月d日H時i分")."に".$_POST["input"]."を受け付けました";
?>
</body>
</html>