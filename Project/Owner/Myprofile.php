<?php
include('../Assets/Connection/Connection.php');

include("Head.php");
$sel="select * from tbl_owner where owner_id='".$_SESSION['oid']."'";
$row=$Con->query($sel);
$data=$row->fetch_assoc();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1 align="center">Myprofile</h1>
  <table width="200" border="1" align="center">
    <tr>
      <td>Name</td>
      <td><?php echo $data['owner_name']?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $data['owner_email']?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php echo $data['owner_contact']?></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><a href="Editprofile.php">Editprofile</a>&nbsp;&nbsp;<a href="Changepassword.php">Changepassword</a></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
include("Foot.php");
?>