<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

$sel="select * from tbl_owner where owner_id='".$_SESSION['oid']."'";
$row=$Con->query($sel);
$data=$row->fetch_assoc();
if(isset($_POST["btn_submit"]))
{
	$name=$_POST["txt_name"];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	
	

	$upqry="update tbl_owner set owner_name='".$name."',owner_email='".$email."',owner_contact='".$contact."'where owner_id='".$_SESSION['oid']."'";
	if($Con->query($upqry))
	 {
		 ?>
         <script>
		 alert('updated');
		 window.location="Editprofile.php";
		 </script>
        <?php
	 }
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Profile</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <h1 align="center">Edit Profile</h1>
    <table border="1" align="center">
        <tr>
            <td>Name</td>
            <td>
                <label for="txt_name"></label>
                <input type="text" name="txt_name" id="txt_name" 
                       value="<?php echo htmlspecialchars($data['owner_name']); ?>" 
                       required 
                       title="Name allows only alphabets, spaces, and must start with a capital letter." 
                       pattern="^[A-Z][a-zA-Z ]*$" />
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <label for="txt_email"></label>
                <input type="email" name="txt_email" id="txt_email" 
                       value="<?php echo htmlspecialchars($data['owner_email']); ?>" 
                       required 
                       title="Please enter a valid email address." />
            </td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>
                <label for="txt_contact"></label>
                <input type="text" name="txt_contact" id="txt_contact" 
                       value="<?php echo htmlspecialchars($data['owner_contact']); ?>" 
                       required 
                       title="Phone number must start with 7-9 and be followed by 9 digits." 
                       pattern="[7-9]{1}[0-9]{9}" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Edit" />
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
