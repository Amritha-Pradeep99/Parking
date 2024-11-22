

<?php
include('../Assets/connection/connection.php');

include("Head.php");
$selQry="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();
$dbpwd=$data['user_password'];
if(isset($_POST["btn_changepassword"]))
{
	$oldpassword=$_POST["txt_oldpassword"];
	$newpassword=$_POST['txt_newpassword'];
	$confirmpassword=$_POST['txt_cpassword'];
	
	if($dbpwd==$oldpassword)
	{
		if($newpassword==$confirmpassword)
		{
			$upqry="update tbl_user set user_password='".$newpassword."' where user_id='".$_SESSION['uid']."'";
			if($Con->query($upqry))
			 {
				 ?>
				 <script>
				 alert('password changed');
				 window.location="changepassword.php";
				 </script>
				 <?php
			 }
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>
</head>
<body>
    <h1 align="center">Change Password</h1>
    <div align="center">
        <form id="form1" name="form1" method="post" action="">
            <table border="1">
                <tr>
                    <td>Old Password</td>
                    <td>
                        <input type="password" name="txt_oldpassword" id="txt_oldpassword" required />
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="txt_newpassword" id="txt_newpassword" 
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                               title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                               required />
                    </td>
                </tr>
                <tr>
                    <td>Re-Type Password</td>
                    <td>
                        <input type="password" name="txt_cpassword" id="txt_cpassword" required />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="center">
                            <input type="submit" name="btn_changepassword" id="btn_changepassword" value="Change Password" />
                            <input type="button" name="txt_cancel" id="txt_cancel" value="Cancel" onclick="window.history.back();" />
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>
