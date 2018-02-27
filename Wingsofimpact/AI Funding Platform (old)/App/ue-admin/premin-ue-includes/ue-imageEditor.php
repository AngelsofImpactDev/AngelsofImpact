<div id="imageEditBox" class="ue-modal mfp-hide">
	<form method="post" enctype="multipart/form-data" action="action-imageeditor.php">
		<div class="imageEditBoxTitle">
			Image Editor
		</div>
		<div class="imageEditWhiteBox">
			<div class="imageEditAreaContainer">
				<img src="" width="100%" id="imageEditArea" />
			</div>
			<input type="hidden" name="frompage" value="<?php echo currentPage()?>" />
			<input type="hidden" name="imagelisttable" value="<?php echo $_GET['imagelisttable'] ?>" />
			<input type="hidden" name="parentid" value="<?php echo $_GET['id'] ?>" />
			<input type="hidden" name="imageAreaCorrespondingTable" id="imageAreaCorrespondingTable" value="<?php echo $namaTableDatabase ?>" />
			<input type="hidden" name="imageAreaCorrespondingColumn" id="imageAreaCorrespondingColumn" />
			<input type="hidden" name="imageAreaCorrespondingId" id="imageAreaCorrespondingId" />
			<input type="hidden" name="imageAreaCorrespondingFolder" id="imageAreaCorrespondingFolder" />
			<input type="hidden" name="imageAreaCorrespondingSrc" id="imageAreaCorrespondingSrc" />
			<input type="hidden" name="imageAreaEditX" id="imageAreaEditX" />
			<input type="hidden" name="imageAreaEditY" id="imageAreaEditY" />
			<input type="hidden" name="imageAreaEditW" id="imageAreaEditW" />
			<input type="hidden" name="imageAreaEditH" id="imageAreaEditH" />
		</div>
		<div class="imageName">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<div id="imageAreaSrc"></div>
					</td>
					<td width="1" valign="top">
						<a href="javascript:unselectImageEditarea();" class="imageEditorInfoBtn tooltip" title="Show EXIF Info"><img src="images/icon/infoSmall.png" /></a>
					</td>
				</tr>
			</table>
			<div class="imageEditExifTable">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="130">
							Full Name
						</td>
						<td>
							<div id="imageAreaExif0"></div>
						</td>
					</tr>
					<tr>
						<td>
							Type
						</td>
						<td>
							<div id="imageAreaExif1"></div>
						</td>
					</tr>
					<tr>
						<td>
							Size
						</td>
						<td>
							<div id="imageAreaExif2"></div>
						</td>
					</tr>				
					<tr>
						<td>
							Make
						</td>
						<td>
							<div id="imageAreaExif3"></div>
						</td>
					</tr>
					<tr>
						<td>
							Model
						</td>
						<td>
							<div id="imageAreaExif4"></div>
						</td>
					</tr>
					<tr>
						<td>
							Date
						</td>
						<td>
							<div id="imageAreaExif5"></div>
						</td>
					</tr>
					<tr>
						<td>
							Exposure
						</td>
						<td>
							<div id="imageAreaExif6"></div>
						</td>
					</tr>
					<tr>
						<td>
							Aperture
						</td>
						<td>
							<div id="imageAreaExif7"></div>
						</td>
					</tr>
					<tr>
						<td>
							F-Stop
						</td>
						<td>
							<div id="imageAreaExif8"></div>
						</td>
					</tr>
					<tr>
						<td>
							F-Number
						</td>
						<td>
							<div id="imageAreaExif9"></div>
						</td>
					</tr>
					<tr>
						<td>
							F-Number Value
						</td>
						<td>
							<div id="imageAreaExif10"></div>
						</td>
					</tr>
					<tr>
						<td>
							ISO
						</td>
						<td>
							<div id="imageAreaExif11"></div>
						</td>
					</tr>
					<tr>
						<td>
							Focal Length
						</td>
						<td>
							<div id="imageAreaExif12"></div>
						</td>
					</tr>
					<tr>
						<td>
							Exposure Program
						</td>
						<td>
							<div id="imageAreaExif13"></div>
						</td>
					</tr>
					<tr>
						<td>
							Metering Mode
						</td>
						<td>
							<div id="imageAreaExif14"></div>
						</td>
					</tr>
					<tr>
						<td>
							Flash Status
						</td>
						<td>
							<div id="imageAreaExif15"></div>
						</td>
					</tr>
					<tr>
						<td>
							Creator
						</td>
						<td>
							<div id="imageAreaExif16"></div>
						</td>
					</tr>
					<tr>
						<td>
							Copyright
						</td>
						<td>
							<div id="imageAreaExif17"></div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="editTabContainer">
			<div class="editTabContainerMenu uetab-menucontainer">
				<a href="javascript:startImageAreaEditPlugin()" class="uetab-btn" data-uetab-target="editTabCrop" id="editTabCropBtn">Crop</a><a href="javascript:removeImageAreaEditPlugin()" class="uetab-btn" data-uetab-target="editTabFilter">Filter</a><a href="javascript:removeImageAreaEditPlugin()" class="uetab-btn" data-uetab-target="editTabWatermark">Watermark</a><a href="javascript:removeImageAreaEditPlugin()" class="uetab-btn" data-uetab-target="editTabRotate">Rotate</a><a href="javascript:removeImageAreaEditPlugin()" class="uetab-btn" data-uetab-target="editTabConvert">Convert &amp Compress</a>
			</div>
			<div class="uetab-target editTabContainerContent" id="editTabCrop">
				<div class="centerText">
					<img src="images/cropHelp.jpg" class="helpImage" />
					<div class="spacer10"></div>
					<div>
						Click on the image and draw a rectangle,<br />
						then click <span class="bold">Crop Button</span> below to process.
					</div>
				</div>
				<div class="centerText">
					<div class="spacer20"></div>
					<?php
						if($_GET['detailmode'] == 'edit') {
					?>
						<input type="submit" name="imageEditMode" value="Apply Crop" onclick="return confirmSubmit()" />
					<?php
						}
						else {
					?>
						<input type="button" value="Please Save First" />
					<?php
						}
					?>
					<div class="spacer10"></div>
					<div>
						*This action is <span class="bold">NOT</span> reversible, please backup your image first.
					</div>
					<div class="spacer10"></div>
				</div>
			</div>
			<div class="uetab-target editTabContainerContent" id="editTabFilter">
				<div class="spacer10"></div>
				<div class="imageEditFilterContainer">
					<label>
						<input type="radio" name="filterMode" value="greyscale" />
						<img src="images/filter1.jpg"/>
						<div>Greyscale</div>
					</label>
					<label>
						<input type="radio" name="filterMode" value="greyscaleEnhanced" />
						<img src="images/filter2.jpg" />
						<div>Greyscale Enhanced</div>
					</label>
					<label>
						<input type="radio" name="filterMode" value="greyscaleDramatic" />
						<img src="images/filter3.jpg" />
						<div>Greyscale Dramatic</div>
					</label>
					<label>
						<input type="radio" name="filterMode" value="blackAndWhite" />
						<img src="images/filter4.jpg" />
						<div>Black &amp; White</div>
					</label>
				</div>
				<div class="imageEditFilterContainer">
					<label>
						<input type="radio" name="filterMode" value="sepia" />
						<img src="images/filter5.jpg"/>
						<div>Sepia</div>
					</label>
					<label>
						<input type="radio" name="filterMode" value="negative" />
						<img src="images/filter6.jpg" />
						<div>Negative</div>
					</label>
					<label>
						<input type="radio" name="filterMode" value="vintage" />
						<img src="images/filter7.jpg" />
						<div>Vintage</div>
					</label>
					<label>
						<input type="radio" name="filterMode" value="sharpen" />
						<img src="images/filter8.jpg" />
						<div>Sharpen</div>
					</label>
				</div>
				<div class="centerText">
					<div class="spacer20"></div>
					<?php
						if($_GET['detailmode'] == 'edit') {
					?>
						<input type="submit" name="imageEditMode" value="Apply Filter" onclick="return confirmSubmit()" />
					<?php
						}
						else {
					?>
						<input type="button" value="Please Save First" />
					<?php
						}
					?>
					<div class="spacer10"></div>
					<div>
						*This action is <span class="bold">NOT</span> reversible, please backup your image first.
					</div>
					<div class="spacer10"></div>
				</div>
			</div>
			<div class="uetab-target editTabContainerContent" id="editTabWatermark">
				<div class="spacer20"></div>
				<div class="imageEditWatermarkPreview">
					<img src="upload/watermark/<?php echo ueGetSiteData('watermark'); ?>" <?php
						$watermarkSize = getimagesize('upload/watermark/'.ueGetSiteData('watermark'));
						if($watermarkSize[0] > 125) {
							echo 'width="100%"';
						}
					?> />
				</div>
				<div class="spacer10"></div>
				<div class="centerText">
					Add a watermark to the bottom right corner of the image.<br />
					Click <a href="detail-sitedata.php?&id=4&detailmode=edit" class="bold" title="Change Watermark">HERE</a> to change your watermark image.
				</div>
				<div class="spacer20"></div>
				<div class="centerText">
					<div class="spacer20"></div>
					<?php
						if($_GET['detailmode'] == 'edit') {
					?>
						<input type="submit" name="imageEditMode" value="Apply Watermark" onclick="return confirmSubmit()" />
					<?php
						}
						else {
					?>
						<input type="button" value="Please Save First" />
					<?php
						}
					?>
					<div class="spacer10"></div>
					<div>
						*This action is <span class="bold">NOT</span> reversible, please backup your image first.
					</div>
					<div class="spacer10"></div>
				</div>
			</div>
			<div class="uetab-target editTabContainerContent" id="editTabRotate">
				<div class="spacer20"></div>
				<div class="imageEditFilterContainer">
					<label>
						<input type="radio" name="rotateMode" value="right" />
						<img src="images/rotate1.jpg"/>
						<div>Rotate<br />Left</div>
					</label>
					<label>
						<input type="radio" name="rotateMode" value="upside" />
						<img src="images/rotate2.jpg" />
						<div>Rotate<br />Vertical</div>
					</label>
					<label>
						<input type="radio" name="rotateMode" value="left" />
						<img src="images/rotate3.jpg" />
						<div>Rotate<br />Right</div>
					</label>
				</div>
				<div class="spacer20"></div>
				<div class="centerText">
					<div class="spacer20"></div>
					<?php
						if($_GET['detailmode'] == 'edit') {
					?>
						<input type="submit" name="imageEditMode" value="Apply Rotation" onclick="return confirmSubmit()" />
					<?php
						}
						else {
					?>
						<input type="button" value="Please Save First" />
					<?php
						}
					?>
					<div class="spacer10"></div>
					<div>
						*This action is <span class="bold">NOT</span> reversible, please backup your image first.
					</div>
					<div class="spacer10"></div>
				</div>
			</div>
			<div class="uetab-target editTabContainerContent" id="editTabConvert">
				<div class="spacer10"></div>
				<div class="imageEditFilterContainer">
					<label>
						<input type="radio" name="compressMode" value="10" />
						<img src="images/compress1.jpg"/>
						<div>Very Low Quality</div>
					</label>
					<label>
						<input type="radio" name="compressMode" value="30" />
						<img src="images/compress2.jpg" />
						<div>Low<br />Quality</div>
					</label>
					<label>
						<input type="radio" name="compressMode" value="60" />
						<img src="images/compress3.jpg" />
						<div>Medium<br />Quality</div>
					</label>
					<label>
						<input type="radio" name="compressMode" value="80" />
						<img src="images/compress4.jpg" />
						<div>High<br />Quality</div>
					</label>
				</div>
				<div class="spacer20"></div>
				<div class="centerText">
					Compress an image to minimize file size, thus reduce loading time.<br />
					On most conditions, lower qualities means lower filesize.<br />
					<span class="bold">GIF files will LOSE their animation.</span><br />
					<span class="bold">GIF &amp; PNG files will LOSE their transparency.</span><br />
					<span class="bold">Compressing more than one time, may increase the file size.</span>
				</div>
				<div class="spacer20"></div>
				<div class="centerText">
					<div class="spacer20"></div>
					<?php
						if($_GET['detailmode'] == 'edit') {
					?>
						<input type="submit" name="imageEditMode" value="Apply Compression" onclick="return confirmSubmit()" />
					<?php
						}
						else {
					?>
						<input type="button" value="Please Save First" />
					<?php
						}
					?>
					<div class="spacer10"></div>
					<div>
						*This action is <span class="bold">NOT</span> reversible, please backup your image first.
					</div>
					<div class="spacer10"></div>
				</div>
			</div>
		</div>
	</form>
</div>