<body>
<table width="100%" cellpadding="0" cellspacing="0" height="100%">
	<tr>
    	<td width="220" valign="top" height="1">
        	<a href="index.php"><img src="images/ue-logo.gif" alt="UltimaEngine Logo" title="Powered By Ultima Engine" /></a>
        </td>
        <td id="topBar">
        	<table width="100%" cellpadding="0" cellspacing="0">
            	<tr>
                	<td width="300">
                        <span class="bold">Server Time: </span><span id="servertime"><?php echo date("d F Y, H:i:s")?></span><span id="servertime"> GMT<?php echo substr(date('O',time()),0,3)?></span>
						<script type="text/javascript">
							var currenttime = '<?php print date("F d, Y H:i:s", time())?>' //PHP method of getting server date
							
							var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
							var serverdate=new Date(currenttime)
							
							function padlength(what){
								var output=(what.toString().length==1)? "0"+what : what
								return output
							}
							
							function displaytime(){
								serverdate.setSeconds(serverdate.getSeconds()+1)
								var datestring=padlength(serverdate.getDate())+" "+montharray[serverdate.getMonth()]+" "+serverdate.getFullYear()+", "
								var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
								document.getElementById("servertime").innerHTML=datestring+" "+timestring
							}
							
							setInterval("displaytime()", 1000);
                        </script>
                    </td>
                    <td align="center">
						<?php
							$disabledSearchPagesArr = array(
								'panel.php',
								'detail-editprofile.php',
								'insights.php'
							);
						?>
                    	<form method="get"<?php
							if($pageType == 'detail') {
								echo ' action="'.$namaPageUtama.'"';
							}
							else if(currentPage() == 'overview.php') {
								echo ' action="'.$_GET['ovmainpage'].'"';
							}
							else if(currentPage() == 'detail-productsold.php') {
								echo ' action="'.$namaPageUtama.'"';
							}
                        ?>>
	                    	<input type="text" placeholder="Search" id="searchInputTop" class="rounded" name="search" value="<?php
								if(in_array(currentPage(),$disabledSearchPagesArr)) {
									echo 'Nothing to search on this page';
								}
								else {
									echo $_GET['search'];
								}
							?>" <?php
								if(in_array(currentPage(),$disabledSearchPagesArr)) {
									echo 'disabled="disabled" readonly="readonly"';
								}
							?> />
                            <?php
								if(currentPage() == 'detail-rightspages.php') {
							?>
                            <input type="hidden" name="idmenu" value="<?php echo $_GET['idmenu']?>" />
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
                            <?php
								}
							?>
                        </form>
                    </td>
                    <td width="300">
                    	<a href="action-logout.php" id="logoutBtn" class="tooltip" title="Sign Out">
                        	<img src="images/powerBtn.png" alt="powerBtn" title="Sign Out" />
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>