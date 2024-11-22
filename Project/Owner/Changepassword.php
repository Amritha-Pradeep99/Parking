

<?php

include('../Assets/connection/connection.php');
include("Head.php");

$selQry="select * from tbl_owner where owner_id='".$_SESSION["oid"]."'";
$row=$Con->query($selQry);
$data=$row->fetch_assoc();
$dbpwd=$data['owner_password'];
if(isset($_POST["btn_changepassword"]))
{
	$oldpassword=$_POST["txt_oldpassword"];
	$newpassword=$_POST['txt_newpassword'];
	$confirmpassword=$_POST['txt_cpassword'];
	
	if($dbpwd==$oldpassword)
	{
		if($newpassword==$confirmpassword)
		{
			$upqry="update tbl_owner set owner_password='".$newpassword."' where owner_id='".$_SESSION['oid']."'";
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Change Password</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <h1 align="center">Change Password</h1>
    <table border="1" align="center">
        <tr>
            <td>Old Password</td>
            <td>
                <label for="txt_oldpassword"></label>
                <input type="password" name="txt_oldpassword" id="txt_oldpassword" required 
                       title="Please enter your old password." />
            </td>
        </tr>
        <tr>
            <td>New Password</td>
            <td>
                <label for="txt_newpassword"></label>
                <input type="password" name="txt_newpassword" id="txt_newpassword" required 
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                       title="New password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters." />
            </td>
        </tr>
        <tr>
            <td>Re-Type Password</td>
            <td>
                <label for="txt_cpassword"></label>
                <input type="password" name="txt_cpassword" id="txt_cpassword" required 
                       title="Please re-type your new password." />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" name="btn_changepassword" id="btn_changepassword" value="Change Password" />
                    <!-- <input type="button" name="txt_cancel" id="txt_cancel" value="Cancel" onclick="window.history.back();" /> -->
                </div>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
include("Foot.php");
?>
