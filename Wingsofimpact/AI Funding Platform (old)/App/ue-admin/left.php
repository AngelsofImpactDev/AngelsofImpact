    	<td valign="top" id="leftContainer">
        	<div id="userContainer">
            	<div>
	            	<a href="detail-editprofile.php" title="Click to edit your profile">
                    	<?php
							$admAvtId = ue_real_escape_string($_SESSION['currentUserIdAdm']);
							$admAvtQue = ue_query("SELECT adminuserlogin_image FROM adminuserlogin WHERE adminuserlogin_id = '$admAvtId' LIMIT 1");
							@ $admAvtRes = ue_fetch_row($admAvtQue);
							if(!$admAvtRes['0']) {
						?>
                    	<img src="images/noUserImage.gif" id="userAvatar" />
                        <?php
							}
							else {
						?>
                        <img src="upload/admavatar/<?php echo $admAvtRes['0']?>" id="userAvatar" />
                        <?php
							}
						?>
                    </a>
                </div>
                <div id="username">
                	<a href="detail-editprofile.php" title="Click to edit your profile" class="capitalize"><?php echo $globalCurrentLoggedUserDataRes['adminuserlogin_username']?></a>
                </div>
                <div id="usertitle" class="colorGrey">
                	<a href="detail-editprofile.php" title="Click to edit your profile" class="capitalize"><?php echo $globalCurrentLoggedUserDataRes['adminuserlevel_name']?></a>
                </div>
                <div id="usertitle" class="colorGrey">
                    <a href="detail-editprofile.php" class="tooltip" title="Last login date"><?php echo unixtodatefull($_SESSION['currentUserLastLogin'],true)?></a>
                </div>
            </div>
			<div id="menuContainer">
                <div class="glossymenu">
                    <a class="menuitem" href="panel.php">Dashboard</a>
					<!--
                    <a class="menuitem submenuheader" href="#">News</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="newsauthor.php">View News Author</a></li>
                        <li><a href="detail-newsauthor.php">Create News Author</a></li>
                        <li><a href="news.php">View News</a></li>
                        <li><a href="detail-news.php">Create News</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Testimonial</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="testimonial.php">View Testimonial</a></li>
                        <li><a href="detail-testimonial.php">Create Testimonial</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Gallery</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="gallery.php">View Gallery</a></li>
                        <li><a href="detail-gallery.php">Create Gallery</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Lookbook</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="lookbook.php">View Lookbook</a></li>
                        <li><a href="detail-lookbook.php">Create Lookbook</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Slider</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="slider.php">View Slider</a></li>
                        <li><a href="detail-slider.php">Create Slider</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Promo</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="promo.php">View Promo</a></li>
                        <li><a href="detail-promo.php">Create Promo</a></li>
                        <li><a href="detail-bulkpromo.php">Create Bulk Promo</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Shipping</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="shipping.php">View Shipping</a></li>
                        <li><a href="detail-shipping.php">Create Shipping</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Bank</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="bank.php">View Bank</a></li>
                        <li><a href="detail-bank.php">Create Bank</a></li>
                        </ul>
                    </div>
                    <a class="menuitem" href="advertising.php">Advertising</a>
                    <a class="menuitem submenuheader" href="#">Product Class</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="productclass.php">View Product Class</a></li>
                        <li><a href="detail-productclass.php">Create Product Class</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Product Category</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="productcategory.php">View Product Category</a></li>
                        <li><a href="detail-productcategory.php">Create Product Category</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Product Type</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="producttype.php">View Product Type</a></li>
                        <li><a href="detail-producttype.php">Create Product Type</a></li>
                        </ul>
                    </div>
                    <a class="menuitem submenuheader" href="#">Product Brand</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="productbrand.php">View Product Brand</a></li>
                        <li><a href="detail-productbrand.php">Create Product Brand</a></li>
                        </ul>
                    </div>
					<?php
						if($ue_globvar_productgroup_enabled) {
					?>
                    <a class="menuitem submenuheader" href="#">Product Group</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="productgroup.php">View Product Group</a></li>
                        <li><a href="detail-productgroup.php">Create Product Group</a></li>
                        </ul>
                    </div>
					<?php
						}
					?>
                    <a class="menuitem submenuheader" href="#">Product</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="product.php">View Product</a></li>
                        <li><a href="detail-product.php">Create Product</a></li>
                        </ul>
                    </div>
                    <a class="menuitem" href="purchase.php">Purchase</a>
					-->
                    <a class="menuitem" href="user.php">Registered Users</a>
					<a class="menuitem" href="startup.php">Social Enterprises</a>
					<a class="menuitem" href="transaction.php">Transaction</a>
					<a class="menuitem" href="repayment.php">Repayment</a>
                    <!--
					<a class="menuitem submenuheader" href="#">Subscriber</a>
                    <div class="submenu">
                        <ul>
                        	<li><a href="subscriber.php">View Subscriber</a></li>
                            <li><a href="detail-subscriber.php">Create Subscriber</a></li>
                        </ul>
                    </div>
                    <a class="menuitem" href="return.php">Return</a>
                    -->
					<a class="menuitem submenuheader" href="#">Administrator</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="rights.php">Access Level</a></li>
                        <li><a href="detail-accesslevel.php">Create Access Level</a></li>
                        <li><a href="adminlist.php">Administrators List</a></li>
                        <li><a href="detail-adminlist.php">Create Administrator</a></li>
                        </ul>
                    </div>
                    <a class="menuitem" href="sitedata.php">Site Data</a>
                    <a class="menuitem submenuheader" href="#">Analytics</a>
                    <div class="submenu">
                        <ul>
                        <li><a href="insights.php">Search Engine Insights</a></li>
                        <li><a href="analyticsoverview.php">Overview</a></li>
                        <li><a href="campaign">View Campaign</a></li>
                        <li><a href="detail-campaign.php">Create Campaign</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </td>
		<td valign="top" id="rightContainer">
			<?php
                include('ue-includes/ue-messageShow.php');
            ?>
        <noscript>
            <div id="ueShowError">
                <div class="messageBox">
                    Please Enable JavaScript to Use All The Features
                </div>
            </div>
        </noscript>