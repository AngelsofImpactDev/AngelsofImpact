tinymce.PluginManager.add('ue_image_editor', function(editor, url) {
	currentNode = '';
	
    // Add a button that opens a window
    editor.addButton('ue_image_editor', {
		tooltip: 'Image Editor',
        icon: true,
		image: tinymce.baseURL+"/plugins/ue_image_editor/img/imageedit_off.gif",
        onclick: function() {
			//Image Editor START
			if(currentNode == 'IMG') {
				//Get Current SRC
				generalImageFolder = '../upload/generalImage/';
				completeTag = tinymce.activeEditor.selection.getContent();
				regexImgSearch = /<img.*?src="(.*?)"/;
				currentSrc = regexImgSearch.exec(completeTag)[1];
				currentSrcArr = currentSrc.split('/');
				currentSrcLen = parseInt(currentSrcArr.length)-1;
				currentSrc = currentSrcArr[currentSrcLen];
				
				if(currentSrcArr[0] == '..') {
					//Get Current Image Size
					var newImg = new Image();
					newImg.src = generalImageFolder+currentSrc;
					curWidth = newImg.naturalWidth;
					curHeight = newImg.naturalHeight;
					
					//Initiate Image Editor START
					$('#editTabCropBtn').click(); //Back To CROP Tab
					//Get Init Data
					currentImageEditId = '';
					currentImageEditTable = '';
					currentImageEditColumn = '';
					currentImageEditSrc = currentSrc;
					currentImageEditFolder = generalImageFolder;
					currentImageEditRealWidth = curWidth;
					currentImageEditRealHeight = curHeight;
					//currentImageEditExif = $(this).attr('data-imageedit-exif').split('|');
					
					//Write To DIV
					//writeExifNum = 0;
					$('#imageAreaCorrespondingFolder').val(currentImageEditFolder);
					$('#imageAreaCorrespondingSrc').val(currentImageEditSrc);
					
					$('#imageEditArea').attr('src',currentImageEditFolder+currentImageEditSrc);
					$('#imageAreaSrc').html(currentImageEditSrc);
					/*
					currentImageEditExif.forEach(function(entry) {
						$('#imageAreaExif'+writeExifNum).html(entry);
						writeExifNum++;
					});
					*/
					
					
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
					//Initiate Image Editor END
					
					//Open Image Editor
					$.magnificPopup.open({
						items: {src: '#imageEditBox'},
						type: 'inline',
						callbacks: {
							close: function() {
								if(imageAreaEditActive) {
									deselectImageEditarea();
								}
							}
						}
					});
				}
				else {
					alert('You can only edit self hosted images');
				}
			}
			else {
				alert('Please select an image');
			}
			//Image Editor END
        }
    });
	
	// Change Button
	editor.on('click', function(e) {
		currentNode = tinymce.activeEditor.selection.getNode().nodeName;
		if(currentNode != 'IMG') {
			currentNode == '';
		}
	});
});