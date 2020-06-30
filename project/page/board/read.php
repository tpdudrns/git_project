<?php
	include $_SERVER['DOCUMENT_ROOT']."/git_project/db_connection.php"; /* db load */
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<!-- <link rel="stylesheet" type="text/css" href="/git_proejct/project/css/style_board_read.css" /> -->
</head>
<style>
#board_read {
	width:700px;
	position: relative;
	word-break:break-all;
}
#user_info {
	font-size:14px;
}
#user_info ul li {
	float:left;
	margin-left:10px;
}
#bo_line {
	width:700px;
	height:2px;
	background: gray;
	margin-top:20px;
}
#bo_content {
	margin-top:20px;
}
#bo_ser {
	font-size:14px;
	color:#333;
	position: absolute;
	right: 0;
}
#bo_ser > ul > li {
	float:left;
	margin-left:10px;
}
li {list-style:none;}
</style>
<body>
	<?php
		$number = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		$hit = mysqli_fetch_array(mq("select * from board where idx ='".$number."'"));
		$hit = $hit['hit'] + 1;
		$fet = mq("update board set hit = '".$hit."' where idx = '".$number."'");
		$sql = mq("select * from board where idx='".$number."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	?>
<!-- 글 불러오기 -->
<div id="board_read">
	<h2><?php echo $board['title']; ?></h2>
		<div id="user_info">
			<?php echo $board['name']; ?> <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
				<div id="bo_line"></div>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>
			</div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<li><a href="/git_project/project/menu_board.php">[목록으로]</a></li>
			<li><a href="modify_alpha.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
			<li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		</ul>
	</div>
</div>
</body>
</html>