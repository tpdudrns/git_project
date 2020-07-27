<?php
	include $_SERVER['DOCUMENT_ROOT']."/db_connection.php"; /* db load */
	session_start();
	$get_index = $_GET['idx'];
	$sql = mq("delete from freeboard where idx='$get_index';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/project/menu_board.php" />