<?php
	include $_SERVER['DOCUMENT_ROOT']."/db_info.php";

    $number = $_GET['idx'];
    
    if($number && $_POST['dat_user'] && $_POST['content']){
        $sql = mq("insert into reply(con_num,name,content) values('".$number."','".$_POST['dat_user']."','".$_POST['content']."')");
        echo "<script>alert('댓글이 작성되었습니다.'); 
        location.href='/project/page/board/read.php?idx=$number';</script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
	
?>