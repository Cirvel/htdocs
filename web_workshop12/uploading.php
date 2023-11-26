<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:session/login.php?msg=none");
	}
?>
<!DOCTYPE html>

<html>
    <body>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Image</td>
                    <td>:</td>
                    <td>
                        <input type="file" name="fileToUpload" id="fileToUpload" accept=".png,.jpg,.jpeg" required>
                    </td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>:</td>
                    <td>
                        <input type="file" name="download" id="download" accept=".zip,.rar,.7zip" required>
                    </td>
                </tr>
                <tr>
                    <td>Text</td>
                    <td>:</td>
                    <td>    
                        <input type="text" name="name" id="name" required>
                    </td>
                </tr>
                <tr>
                    <td>Author</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="author" id="author" required>
                    </td>
                </tr>
            </table>
            Select Image to upload:
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>