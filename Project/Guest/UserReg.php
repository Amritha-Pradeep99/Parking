<?php

include("../Assets/Connection/Connection.php");
include("Head.php");
if(isset($_POST["btnsave"]))
{
	$name=$_POST["txtname"];
	$contact=$_POST["txtcontact"];
	$email=$_POST["txtemail"];
	$password=$_POST["txtpassword"];
	
	
	$insQry="insert into tbl_user(user_name,user_contact,user_password,user_email)values('".$name."','".$contact."','".$password."','".$email."')";
	//echo $insQry;	
  if($Con->query ($insQry))
			{
				?>
                <script>
				alert('inserted');
				location.href='UserReg.php';
				</script>
				<?php
			}
		    else
			{
				 ?>
				 <script>
				 alert('failed');
			   	 location.href='UserReg.php';
				 </script>
                 <?php
			}
}

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User Registration</title>
</head>

<body>
<br /><br /><br /><br /><br />
<h1 align="center">User Registration</h1>
<div id="tab">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

        <table border="1" align="center">
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="txtname" id="txtname" autocomplete="off" required 
                           title="Name allows only alphabets and spaces. First letter must be capital." 
                           pattern="^[A-Z][a-zA-Z ]*$"/>
                </td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>
                    <input type="text" name="txtcontact" id="txtcontact" 
                           pattern="[7-9]{1}[0-9]{9}" autocomplete="off" required 
                           title="Phone number must start with 7-9 followed by 9 digits."/>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="txtemail" id="txtemail" autocomplete="off" required />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="txtpassword" id="txtpassword" 
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autocomplete="off" required 
                           title="Must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters."/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btnsave" id="btnsave" value="Submit" />
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
