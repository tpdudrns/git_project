<?php

/* $servername = "192.168.56.1";
$username = "sydb";
$password = "cj642djk82t3qj9t3aydyre8gwjqma585yfd9kef";
$dbname = "myDB"; */
include  $_SERVER['DOCUMENT_ROOT']."/db_info.php";
                $connect = mysqli_connect($servername, $username, $password, $dbname) or die("fail");
                //client가 입력한 데이터를 서버가 받는다. 
                
                $id = $_POST[name];                      //Writer
                $pw = $_POST[pw];                        //Password
                $title = $_POST[title];                  //Title
                $content = $_POST[content];              //Content
                $date = date('Y-m-d H:i:s');            //Date
 
                $URL = 'http://192.168.56.1/project/menu_board.php';                   //return URL
 
                // 받아온 데이터를 DB에 저장한다.
                $query = "insert into board (idx, title, content, date, hit, name, pw) 
                        values(null,'$title', '$content', '$date', 0, '$id', '$pw')";
 
                $result = $connect->query($query);
                if($result){
?>                  <script>
                        alert("<?php echo "글이 등록되었습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>
