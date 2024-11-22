<?php

include("../Assets/Connection/Connection.php");

include("Head.php");
if(isset($_POST["btnsave"]))
{
	$bike=$_POST["txt_bike"];
	$car=$_POST["txt_car"];
	$address=$_POST["txtaddress"];
	$place=$_POST["sel_place"];
	$date=$_POST["txtdate"];
	
	$photo=$_FILES["filephoto"]["name"];
	$path=$_FILES["filephoto"]["tmp_name"];
	move_uploaded_file($path,"../Assets/Files/Plot/".$photo);
	
	$proof=$_FILES["fileproof"]["name"];
	$path=$_FILES["fileproof"]["tmp_name"];
	move_uploaded_file($path,"../Assets/Files/Plot/".$proof);
	
	$insQry="insert into tbl_plot(plot_address,place_id,plot_photo,plot_proof,bike_fee,car_fee,plot_date,owner_id)values('".$address."','".$place."','".$photo."','".$proof."','".$bike."','".$car."',curdate(),'".$_SESSION['oid']."')";
	//echo $insQry;	
  if($Con->query ($insQry))
			{
				?>
                <script>
				alert('inserted');
				location.href='ViewPlot.php';
				</script>
				<?php
			}
		    else
			{
				 ?>
				 <script>
				 alert('failed');
			   	 location.href='AddPlot.php';
				 </script>
                 <?php
			}
}

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Plot</title>
   
</head>

<body>
    <div id="tab">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <h1>Add Plot</h1>
            <table>
                <tr>
                    <td>District</td>
                    <td>
                        <select name="sel_district" id="sel_district" onChange="getPlace(this.value)" required>
                            <option value="">---select---</option>
                            <?php
                            $districtQry = "select * from tbl_district";
                            $res = $Con->query($districtQry);
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row["district_id"]; ?>"><?php echo $row["district_name"]; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Place</td>
                    <td>
                        <select name="sel_place" id="sel_place">
                            <option value="">---select---</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>
                        <textarea name="txtaddress" id="txtaddress" cols="45" rows="5" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        <input type="file" name="filephoto" id="filephoto" required />
                    </td>
                </tr>
                <tr>
                    <td>Proof</td>
                    <td>
                        <input type="file" name="fileproof" id="fileproof" required />
                    </td>
                </tr>
                <tr>
                    <td>Bike Fee</td>
                    <td>
                        <input type="text" name="txt_bike" id="txt_bike" pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid amount" required />
                    </td>
                </tr>
                <tr>
                    <td>Car Fee</td>
                    <td>
                        <input type="text" name="txt_car" id="txt_car" pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid amount" required />
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
<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(did) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
            success: function (result) {
                $("#sel_place").html(result);
            }
        });
    }
</script>
</html>
<?php
include("Foot.php");
?>
