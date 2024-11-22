<?php

include('../Assets/Connection/Connection.php');
include('Head.php');
if(isset($_POST['btn_submit']))
{
	$reply=$_POST['txt_reply'];
	$upQry="update tbl_complaint set complaint_status='1',complaint_reply='".$reply."' where complaint_id='".$_GET['id']."'";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("Replied");
		window.location="ViewComplaintReply.php";
		</script>
        <?php
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reply Form</title>
</head>

<body>
    <form id="form1" name="form1" method="post" action="">
        <table align="center" border="1">
            <tr>
                <td>Reply</td>
                <td>
                    <label for="txt_reply"></label>
                    <textarea name="txt_reply" id="txt_reply" cols="45" rows="5" required 
                              title="Please provide your reply." pattern=".{1,}" 
                              placeholder="Type your reply here..."></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
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
