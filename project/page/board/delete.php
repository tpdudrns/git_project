<?php
	include "db.php";
	
	$get_index = $_GET['idx'];
	$sql = mq("delete from board where idx='$get_index';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=http://192.168.56.1/project/menu_board.php" />