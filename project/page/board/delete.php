<?php
//	include "/git_proejct/db_connection.php";
	include "db_connection.php";	
	$get_index = $_GET['idx'];
	$sql = mq("delete from freeboard where idx='$get_index';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=https://interiorsy.tk/git_project/project/menu_board.php" />