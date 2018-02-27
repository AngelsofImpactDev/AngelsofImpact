<input type="hidden" name="multiCheckAllFrompage" id="multiCheckAllFrompage" value="<?php echo $namaPageUtama?>" />
<?php
	if(currentPage() == 'detail-rightspages.php') {
?>
<input type="hidden" name="multiCheckAllTable" id="multiCheckAllTable" value="adminuseraccess" />
<input type="hidden" name="multiCheckAllcurrentAdminId" id="multiCheckAllTable" value="<?php echo $_GET['id']?>" />
<?php
	}
	else if(currentPage() == 'detail-productsold.php') {
?>
<input type="hidden" name="multiCheckAllTable" id="multiCheckAllTable" value="productsold" />
<input type="hidden" name="multiCheckAllcurrentAdminId" id="multiCheckAllTable" value="<?php echo $_GET['id']?>" />
<?php
	}
	else {
?>
<input type="hidden" name="multiCheckAllTable" id="multiCheckAllTable" value="<?php echo $namaTableDatabase?>" />
<?php
	}
?>
<input type="hidden" name="multiCheckAllMode" id="multiCheckAllMode" value="" />
<div class="transFullWidthWrapper" id="multiCheckBar">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>
                With Checked : 
            </td>
            <?php
				if(currentPage() == 'detail-productsold.php') {
			?>
            <td>
                <input onclick="$('#multiCheckAllMode').val('a'); return confirmSubmit();" type="image" src="images/icon/available.png" <?php echo tooltip('Make All Checked Available',110)?> />
            </td>
            <td>
                <input onclick="$('#multiCheckAllMode').val('s'); return confirmSubmit();" type="image" src="images/icon/soldout.png" <?php echo tooltip('Make All Checked Sold Out',115)?> />
            </td>
            <?php
				}
				else {
			?>
            <td>
                <input onclick="$('#multiCheckAllMode').val('e'); return confirmSubmit();" type="image" src="images/icon/tick.png" <?php echo tooltip('Enable All Checked',110)?> />
            </td>
            <td>
                <input onclick="$('#multiCheckAllMode').val('d'); return confirmSubmit();" type="image" src="images/icon/publish_x.png" <?php echo tooltip('Disable All Checked',115)?> />
            </td>
			<?php
					$topTopDisablePages = array(
						'panel.php',
						'promo.php',
						'shipping.php',
						'advertising.php',
						'purchase.php',
						'user.php',
						'subscriber.php',
						'return.php',
						'rights.php',
						'detail-rightspages.php',
						'adminlist.php',
						'sitedata.php'
					);
					if(!in_array(currentPage(),$topTopDisablePages)) {
			?>
            <td>
                <input onclick="$('#multiCheckAllMode').val('top'); return confirmSubmit();" type="image" src="images/icon/arrowUp.png" <?php echo tooltip('Move Checked to Top',115)?> />
            </td>
			<?php
					}
				}
			?>
            <?php
				if(currentPage() == 'product.php') {
			?>
            <td>
                <input onclick="$('#multiCheckAllMode').val('fon'); return confirmSubmit();" type="image" src="images/icon/starOn.png" <?php echo tooltip('Feature All Checked',115)?> />
            </td>
            <td>
                <input onclick="$('#multiCheckAllMode').val('foff'); return confirmSubmit();" type="image" src="images/icon/starOff.png" <?php echo tooltip('Unfeature All Checked',130)?> />
            </td>
            <?php
				}
			?>
            <td>
            	<?php
					if(currentPage() != 'detail-rightspages.php' && currentPage() != 'detail-productsold.php') {
				?>
                <input onclick="$('#multiCheckAllMode').val('delete'); return confirmSubmit();" type="image" src="images/icon/trash.png" <?php echo tooltip('Delete All Checked',110)?> />
                <?php
					}
				?>
            </td>
        </tr>
    </table>
</div>