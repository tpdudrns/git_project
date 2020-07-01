<?php
include  $_SERVER['DOCUMENT_ROOT']."/git_project/db_info.php";
                
$id = $_POST['name'];                      //Writer
//$pw = $_POST['pw'];                        //Password
$title = $_POST['title'];                  //Title
$content = $_POST['content'];              //Content
$date = date('Y-m-d H:i:s');            //Date
$URL = 'https://interiorsy.tk/git_project/project/menu_board.php';                    //return URL
 
$query = "insert into freeboard (idx, title, content, date, hit, name) 
        values(null,'$title', '$content', '$date',0, '$id')";
$result = $connect->query($query);
        if($result){
?>      <script>
                alert("<?php echo "글이 등록되었습니다."?>");
                location.replace("<?php echo $URL?>");
        </script>
<?php
        }
        else{
                echo "FAIL";
                echo "에러메세지" . mysqli_error($query);
                

        }
        mysqli_close($connect);
?>
