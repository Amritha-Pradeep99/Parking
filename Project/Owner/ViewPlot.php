<?php

include("../Assets/Connection/Connection.php");

include("Head.php");
if(isset($_GET['id']))
{
	$delQry="delete from tbl_plot where plot_id='".$_GET['id']."'";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Deleted")
		window.location="ViewPlot.php"
		</script>
        <?php
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  &nbsp;
<h1 align="center">ViewPlot</h1>
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>Disrtict</td>
      <td>Place</td>
      <td>Address</td>
      <td>Photo</td>
      <td>Proof</td>
      <td>Bike Fee</td>
      <td>Car Fee</td>
      <td>Date</td>
       <td>Action</td>
    </tr>
     <?php
	$i=0;
	$selQry="select * from tbl_plot p inner join tbl_place pl on p.place_id=pl.place_id inner join tbl_district d on d.district_id=pl. district_id where owner_id='".$_SESSION['oid']."'";
	$row=$Con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['district_name'] ?></td>
      <td><?php echo $data['place_name'] ?></td>
      <td><?php echo $data['plot_address'] ?></td>
      <td><img src="../Assets/Files/Plot/<?php echo $data['plot_photo'] ?>" width="50px" height="50px"/></td>
      <td><img src="../Assets/Files/Plot/<?php echo $data['plot_proof'] ?>" width="50px" height="50px"/></td>
      <td><?php echo $data['bike_fee'] ?></td>
      <td><?php echo $data['car_fee'] ?></td>
      <td><?php echo $data['plot_date'] ?></td>
       <td><a href="ViewPlot.php?id=<?php echo $data['plot_id'] ?>">Delete</a>
       <a href="Addslot.php?pid=<?php echo $data['plot_id'] ?>">AddSlot</a></td>
    </tr>
    <?php } ?>
  </table>
</form>
</body>
</html>
<?php
include("Foot.php");
?>