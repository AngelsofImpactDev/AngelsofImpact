		</td>
    </tr>
</table>
<div id="footerPreload">
	<img src="js/menuAccordion/plus.png" />
	<img src="js/menuAccordion/minus.png" />
	<img src="../upload/watermark/watermark.png" />
</div>
<?php
	include('ue-includes/ue-imageEditor.php');
?>
<div id="autoLogoutAlert" class="centerText ue-modal mfp-hide">
	<script type="text/javascript">
		var autoLogVar;
	</script>
	Your session have been idle for sometime,<br />
	You will be automatically logged out unless you press the button below.
	<div>
		<a href="javascript:stopAutoLogout();$.magnificPopup.close()">I'm still here!</a>
	</div>
</div>
<script type="text/javascript">
	//Tooltips
	$('.tooltip').tooltipster();
</script>
<script type="text/javascript">  
	$(document).on('click','.addCloneRow',function() {
		addCloneCurrentTableId = '#' + $(this).parent().parent().parent().parent().attr('id');
		$(addCloneCurrentTableId + ' tr').last().clone().appendTo(addCloneCurrentTableId);
		$(addCloneCurrentTableId + ' tr:last input').attr('value','');
		new jscolor.init($(addCloneCurrentTableId + ' tr:last input[class="colorPickerField"]'), {});
	});
	
	$(document).on('click','.removeCloneRow',function() {
		addCloneCurrentTableId = '#' + $(this).parent().parent().parent().parent().attr('id');
		numberOfCurrentElement = $(addCloneCurrentTableId + ' tr input[type="hidden"][value=""]').length;
		if(numberOfCurrentElement > 1) {
			$(this).parent().parent().remove();
		}
	});
</script>
<script type="text/javascript">
	$(document).on('click','.addClone',function() {
		addCloneCurrentTableId = '#' + $(this).parent().parent().parent().parent().parent().attr('id');
		$(addCloneCurrentTableId + ' .eachMultiImageTableClass').last().clone().appendTo(addCloneCurrentTableId);
		$(addCloneCurrentTableId + ' table:last').find('.chosen-container').remove();
		$(addCloneCurrentTableId + ' table:last select').show();
		$(addCloneCurrentTableId + ' table:last select').removeAttr('id');
		$(addCloneCurrentTableId + ' table:last select').removeAttr('data-placeholder');
		$(addCloneCurrentTableId + ' table:last select').removeClass('chzn-done');
		$(addCloneCurrentTableId + ' table:last select').chosen();
		$(addCloneCurrentTableId + ' table:last select').prop('selectedIndex',0);
		$(addCloneCurrentTableId + ' table:last input').val('');
		$(addCloneCurrentTableId + ' table:last #multiImagePreview img').removeAttr('src');
		<?php
			if($ue_globvar_watermarkdefaultchecked) {
		?>
			$(addCloneCurrentTableId + ' table:last input[type="checkbox"]').prop('checked',true);
		<?php
			}
			else {
		?>
			$(addCloneCurrentTableId + ' table:last input[type="checkbox"]').prop('checked',false);
		<?php
			}
		?>
	});
	$(document).on('click','.removeClone',function() {
		addCloneCurrentTableId = '#' + $(this).parent().parent().parent().parent().parent().attr('id');
		numberOfCurrentElement = $(addCloneCurrentTableId + ' table input[type="hidden"][name="productimagedetaileditid[]"][value=""]').length;
		if(numberOfCurrentElement > 1) {
			$(this).parent().parent().parent().parent().remove();
		}
	});
</script>
<script type="text/javascript">
//Watermark Flag Multiple
	$(document).on("click",".watermarkFlagMulti", function() {
		if($(this).is(":checked")) {
			currentWatermarkDummyVal = $(this).attr('data-watermarkflag-value');
			$(this).parent().prev().children('input').val(currentWatermarkDummyVal);
		}
		else {
			$(this).parent().prev().children('input').val('');
		}
	});
</script>
<script type="text/javascript">
//Multi Selector START	
	$('#multiCheckAllToggler').click(function() {
		multiCheckNumChecked = $('.multiCheckInput:checked').length;
		if(multiCheckNumChecked <= 0) {
			$('.multiCheckInput').prop('checked',true);
		}
		else {
			$('.multiCheckInput').prop('checked',false);
		}
		multiCheckBarShowOrNot();
	});

	$('.multiCheckInput').change(function() {
		multiCheckBarShowOrNot();
	});
//Multi Selector END
</script>
<script type="text/javascript">
//Auto Logout START
	function idleLogout() {
		var t;
		window.onload = resetTimer;
		window.onmousemove = resetTimer;
		window.onmousedown = resetTimer; // catches touchscreen presses
		window.onclick = resetTimer;     // catches touchpad clicks
		window.onscroll = resetTimer;    // catches scrolling with arrow keys
		window.onkeypress = resetTimer;
	
		function logout() {
			$.magnificPopup.open({items: {src: '#autoLogoutAlert'}, type: 'inline'});
			startAutoLogout();
		}
	
		function resetTimer() {
			clearTimeout(t);
			t = setTimeout(logout, 2700000);  // 45 Minutes
		}
	}
	idleLogout();
//Auto Logout END
</script>
<script type="text/javascript" src="js/uepopup/magnific-init.js"></script>
<script type="text/javascript">
	$("select[data-chosen!='disabled'][data-chosen='multiselect']").chosen({allow_single_deselect:true,width: '99.9%'});
	$("select[data-chosen!='disabled'][data-chosen!='fixedwidth']").chosen({allow_single_deselect:true});
	$("select[data-chosen!='disabled'][data-chosen='fixedwidth']").chosen({allow_single_deselect:true,width: '220px'});
</script>
<!-- Tab START -->
<script type="text/javascript" src="../ue-js/uetab/ue-tab.js"></script>
<link rel="stylesheet" type="text/css" href="../ue-js/uetab/ue-tab.css" />
<!-- Tab END -->
<!-- Image Editor START -->
<script type="text/javascript" src="js/imageeditor/imageeditor.js"></script>
<!-- Image Editor END -->
<!-- Image Preview Before Upload START -->
<script type="text/javascript">
	$(document).on("change",".ueInputFile",function() {
		currentInputTypeFileName = $(this).attr('name').replace('[]','');
		currentInputTypeFileType = $(this).attr('type');
		
		if(currentInputTypeFileType == 'file') {
			if($('.ueImagePreview-'+currentInputTypeFileName).length) {
				imagePreviewRenderFlag = window.URL.createObjectURL(this.files[0]);
				$(this).closest('table').find('.ueImagePreview-'+currentInputTypeFileName).attr('src',imagePreviewRenderFlag);
			}
		}
	});
</script>
<!-- Image Preview Before Upload END -->
<script type="text/javascript" src="../ue-js/uedatepicker/zebra_datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../ue-js/uedatepicker/style.css" />
<script>
$(document).ready(function() {
	$('.datepicker').Zebra_DatePicker();
});
</script>
</body>
</html>
<?php
	@ ue_close($GLOBALS['mysql_connect_init']);
?>