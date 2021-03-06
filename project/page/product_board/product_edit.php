<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
$target_dir = $_SERVER['DOCUMENT_ROOT']."/uploads/";
//$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		/*database에 업로드 정보를 기록한다.
		- 파일이름(혹은 url)
		- 파일사이즈
		- 파일형식
		*/
		$filename = $_FILES["fileToUpload"]["name"];
		$imgurl = "https://interiorsy.tk/uploads/".$_FILES["fileToUpload"]["name"];
		$size = $_FILES["fileToUpload"]["size"];

        //include_once '.:/usr/share/php/config.php';
        $servername = "3.34.52.222";
        $username = "sy";
        $password = "FJ44ouW*zDALcogAwZuUk^J%OtJM4y$8^6VcqBeD"; 
        $dbname = "sydb"; 
    
        $conn = mysqli_connect($servername, $username, $password, $dbname) or die ("db_connection_error");

        $index = $_GET['idx'];
        $product_name = $_POST['name'];                     
        $price = $_POST['price'];                        
        $comment = $_POST['comment'];                  
        $content = $_POST['content'];              
        $date = date('Y-m-d H:i:s');
        
        $sql = "update products set name='$product_name', price='$price', comment='$comment', content='$content', filename='$filename', imgurl='$imgurl', size='$size', date='$date' where idx=$index";
?>
<?php

	
		//images 테이블에 이미지정보를 저장한다.
		mysqli_query($conn,$sql);
		mysqli_close($conn);

        echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
		echo "<br><img src=/uploads/". basename( $_FILES["fileToUpload"]["name"]). " width=400>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
		echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
    }
}

?>
<meta http-equiv="refresh" content="0 url=product_view.php?idx=<?php echo $index; ?>">
