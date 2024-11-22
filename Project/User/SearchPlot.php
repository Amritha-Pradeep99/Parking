<?php

include("../Assets/Connection/Connection.php");
include("Head.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Search Plot</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
    <h1 align="center">Search Plot</h1>
    <table  border="1" align="center">
        <tr>
            <td>District</td>
            <td>
                <label for="sel_dist"></label>
                <select name="sel_dist" id="sel_dist" onchange="getPlace(this.value)" required>
                    <option value="">--select--</option>
                    <?php
                    $selquery ="select * from tbl_district";
                    $row = $Con->query($selquery);
                    while($data = $row->fetch_assoc())
                    {
                    ?>
                    <option value="<?php echo $data['district_id'];?>"><?php echo $data['district_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
            <td>Place</td>
            <td>
                <label for="sel_place"></label>
                <select name="sel_place" id="sel_place" onchange="getPlot(this.value)" required>
                    <option value="">--select--</option>
                </select>
            </td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div id="search"></div>
    <p>&nbsp;</p>
    <!-- <div align="center">
        <input type="submit" name="btn_search" id="btn_search" value="Search" />
    </div> -->
</form>
</body>
</html>
<?php
include("Foot.php");
?>
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
    function getPlot(did) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxSearchPlot.php?did=" + did,
            success: function (result) {
                $("#search").html(result);
            }
        });
    }
</script>
