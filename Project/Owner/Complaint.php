<?php 
include('../Assets/Connection/Connection.php');

include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$title=$_POST["txt_title"];
	$content=$_POST["txt_content"];
	$insqry="insert into tbl_complaint(complaint_title,complaint_content,complaint_date,owner_id)values('".$title."','".$content."',curdate(),'".$_SESSION['oid']."')";
	if($Con->query($insqry))
	{
		?>
		<script>
		alert('inserted');
		window.location='Complaint.php';
		</script>
		<?php
	}
}
if(isset($_GET['id']))
{
	$delQry="delete from tbl_complaint where complaint_id='".$_GET['id']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="Complaint.php"
		</script>
        <?php
	}
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Submit Complaint</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="200" border="1" align="center">
        <tr>
            <td>Title</td>
            <td>
                <label for="txt_title"></label>
                <input type="text" name="txt_title" id="txt_title" required 
                       title="Title is required and must be less than 100 characters." 
                       maxlength="100" />
            </td>
        </tr>
        <tr>
            <td>Content</td>
            <td>
                <label for="txt_content"></label>
                <input type="text" name="txt_content" id="txt_content" required 
                       title="Content is required and must be less than 500 characters." 
                       maxlength="500" />
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
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table align="center">
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Description</td>
            <td>Date</td>
            <td>Reply</td>
            <td>Action</td>
        </tr>
        <?php
        $i = 0;
        $selQry = "SELECT * FROM tbl_complaint WHERE owner_id=" . $_SESSION['oid'];
        $row = $Con->query($selQry);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo htmlspecialchars($data['complaint_title']); ?></td>
                <td><?php echo htmlspecialchars($data['complaint_content']); ?></td>
                <td><?php echo htmlspecialchars($data['complaint_date']); ?></td>
                <td><?php
                    if ($data['complaint_status'] == 1) {
                        echo htmlspecialchars($data['complaint_reply']);
                    } else {
                        echo "Not Replied";
                    }
                    ?></td>
                <td><a href="Complaint.php?id=<?php echo $data['complaint_id']; ?>">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</form>
</body>
</html>
<?php
include("Foot.php");
?>
