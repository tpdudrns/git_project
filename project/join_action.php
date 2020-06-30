<?php
 
include  $_SERVER['DOCUMENT_ROOT']."/git_proejct/db_info.php";
 
    $id=$_POST['id'];
    $pw=$_POST['pw'];
    $nickname=$_POST['nickname'];
    $date = date('Y-m-d H:i:s');
 
    //입력받은 데이터를 DB에 저장
    $query = "insert into member (id, pw, nickname, date) values ('$id', '$pw', '$nickname', '$date')";
    $result = $connect->query($query);
 
    //저장이 됬다면 (result = true) 가입 완료
        if($result) {
?>          <script>
                alert('가입 되었습니다.');
                location.replace("test_login.php");
            </script>

<?php   }else{
?>          <script>
                alert("fail");
            </script>
<?php   }
        mysqli_close($connect);
?>
