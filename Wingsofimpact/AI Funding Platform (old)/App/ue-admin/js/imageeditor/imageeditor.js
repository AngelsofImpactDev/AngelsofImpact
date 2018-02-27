function unselectImageEditarea() {
	imageAreaEditActive.cancelSelection();
	$('#imageAreaEditX').val(0);
	$('#imageAreaEditY').val(0);
	$('#imageAreaEditW').val(0);
	$('#imageAreaEditH').val(0);
}
function deselectImageEditarea() {
	$('#imageEditArea').imgAreaSelect({
		remove:true
	});
	$('#imageAreaEditX').val(0);
	$('#imageAreaEditY').val(0);
	$('#imageAreaEditW').val(0);
	$('#imageAreaEditH').val(0);
}
function startImageAreaEditPlugin() {
	$('#imageEditArea').imgAreaSelect({
		disable: false,
		hide: false
	});
}
function removeImageAreaEditPlugin() {
	$('#imageEditArea').imgAreaSelect({
		disable: true,
		hide: true
	});
}

imageEditInitMasterFlag = '';
$('.imageEditInit').click(function() {
	$('#editTabCropBtn').click(); //Back To CROP Tab
	//Get Init Data
	currentImageEditId = $(this).attr('data-imageedit-id');
	currentImageEditTable = $(this).attr('data-imageedit-table');
	currentImageEditColumn = $(this).attr('data-imageedit-column');
	currentImageEditSrc = $(this).attr('data-imageedit-src');
	currentImageEditFolder = $(this).attr('data-imageedit-folder');
	currentImageEditRealWidth = $(this).attr('data-imageedit-width');
	currentImageEditRealHeight = $(this).attr('data-imageedit-height');
	currentImageEditExif = $(this).attr('data-imageedit-exif').split('|');
	
	//Write To DIV
	writeExifNum = 0;
	
	$('#imageAreaCorrespondingTable').val(currentImageEditTable);
	$('#imageAreaCorrespondingColumn').val(currentImageEditColumn);
	$('#imageAreaCorrespondingId').val(currentImageEditId);
	$('#imageAreaCorrespondingFolder').val(currentImageEditFolder);
	$('#imageAreaCorrespondingSrc').val(currentImageEditSrc);
	
	$('#imageEditArea').attr('src',currentImageEditFolder+currentImageEditSrc);
	$('#imageAreaSrc').html(currentImageEditSrc);
	currentImageEditExif.forEach(function(entry) {
		$('#imageAreaExif'+writeExifNum).html(entry);
		writeExifNum++;
	});
	
	
	if(currentImageEditRealWidth > 430) {
		$('#imageEditArea').attr('width','100%');
	}
	else {
		$('#imageEditArea').removeAttr('width');
	}
	
	setTimeout(function(){
		imageAreaEditActive = $('#imageEditArea').imgAreaSelect({
			instance: true,
			imageWidth: currentImageEditRealWidth,
			imageHeight: currentImageEditRealHeight,
			onSelectEnd: function (img, selection) {
				imageAreaWidthResult = parseInt(selection.x2)-parseInt(selection.x1);
				imageAreaHeightResult = parseInt(selection.y2)-parseInt(selection.y1);
				
				if(imageAreaWidthResult > 0 && imageAreaHeightResult > 0) {
					$('#imageAreaEditX').val(selection.x1);
					$('#imageAreaEditY').val(selection.y1);
					$('#imageAreaEditW').val(imageAreaWidthResult);
					$('#imageAreaEditH').val(imageAreaHeightResult);            
				}
				else {
					$('#imageAreaEditX').val(0);
					$('#imageAreaEditY').val(0);
					$('#imageAreaEditW').val(0);
					$('#imageAreaEditH').val(0);
				}
			}
		});
	},300);
});

$('.imageEditorInfoBtn').click(function() {
	$('.imageEditExifTable').slideToggle('slow');
});