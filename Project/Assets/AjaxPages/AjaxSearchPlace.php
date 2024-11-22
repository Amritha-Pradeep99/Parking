
<?php
include("../Connection/Connection.php");
$selqry="select * from tbl_place where district_id IN(".$_GET["data"].")";
$result=$Con->query($selqry);
while($row=$result->fetch_assoc())
{
	?>
        <li class="list-group-item">
            <div class="form-check">
                <label class="form-check-label">
                    <input onchange="productCheck()"  type="checkbox" class="form-check-input product_check" value="<?php echo $row["place_id"]; ?>" id="place"><?php echo $row["place_name"]; ?>
                </label>
            </div>
        </li>
    <?php 
}
?>
