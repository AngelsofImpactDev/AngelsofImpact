$(document).ready(function() {
	//Disable Enter on Submit for Multi Checkbox START  
	$('.multiCheckInput').keydown(function(event){
		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
	});
	//Disable Enter on Submit for Multi Checkbox END
});

function confirmSubmit() {
	var agree=confirm("Are you sure?");
	if (agree)
		return true ;
	else
		return false ;
}

function calculateDiscPercent(isInit) {
	curPurePrice = parseInt($('#price').val());
	if(isInit == 'init') {
		curPureSalePrice = parseInt($('#saleprice').val());
		if(curPureSalePrice > 0) {
			curSalePercent = 100 - Math.round((curPureSalePrice/curPurePrice)*100);
			$('#salepercent').val(curSalePercent);
		}
		else {
			$('#salepercent').val('0');
		}
	}
	else {
		curPurePercent = parseInt($('#salepercent').val());
		if(curPurePercent > 0 && curPurePercent <= 100 && curPurePrice > 0) {
			discAmount = Math.round((curPurePercent / 100) * curPurePrice);
			curPriceAfterDisc = curPurePrice - discAmount;
			if(curPriceAfterDisc > 0) {
				$('#saleprice').val(curPriceAfterDisc);
			}
			else {
				$('#saleprice').val('0');
			}
		}
		else {
			$('#saleprice').val('0');
		}
	}
}

function checkSaleMode() {
	curSaleMode = $("input[type='radio'][name='saleMode']:checked").val();
	if(curSaleMode == 'percentage') {
		$('#saleprice').attr('readonly','readonly');
		$('#salepercent').removeAttr("readonly");
		$('#saleprice').css('background-color','#eee');
		$('#salepercent').css('background-color','#fff');
	}
	else {
		$('#saleprice').removeAttr("readonly");
		$('#salepercent').attr('readonly','readonly');
		$('#saleprice').css('background-color','#fff');
		$('#salepercent').css('background-color','#eee');
	}
}

function calcWeight() {
	currentVolume = $('#volume').val();
	currentVolumeArr = currentVolume.split("x");
	if(currentVolumeArr[0] > 0 && currentVolumeArr[1] > 0 && currentVolumeArr[2] > 0) {
		currentWeightTotal = Math.round((currentVolumeArr[0]*currentVolumeArr[1]*currentVolumeArr[2])/6000);
		if(currentWeightTotal <= 0) {
			currentWeightTotal = 1;
		}
	}
	else {
		currentWeightTotal = 0;
	}
	//alert(currentWeightTotal);
	$('#weight').val(currentWeightTotal);
}

function checkShipMode(checkShipModeInit) {
	if(checkShipModeInit == 'init') {
		currentVolume = $('#volume').val();
		currentVolumeArr = currentVolume.split("x");
		if(currentVolumeArr[0] > 0 && currentVolumeArr[1] > 0 && currentVolumeArr[2] > 0) {
			$("input[type='radio'][name='shipMode']").removeAttr("checked");
			$("input[type='radio'][name='shipMode'][value='volume']").attr("checked","checked");
		}
	}
	curShipMode = $("input[type='radio'][name='shipMode']:checked").val();
	if(curShipMode == 'volume') {
		$('#weight').attr('readonly','readonly');
		$('#volume').removeAttr("readonly");
		$('#weight').css('background-color','#eee');
		$('#volume').css('background-color','#fff');
		
		calcWeight();
	}
	else {
		$('#weight').removeAttr("readonly");
		$('#volume').attr('readonly','readonly');
		$('#weight').css('background-color','#fff');
		$('#volume').css('background-color','#eee');
	}
}

function startAutoLogout() {
	autoLogVar = setTimeout(function(){
		window.location.href = 'action-logout.php?why=idle'
	}, 10000);
}

function stopAutoLogout() {
	clearTimeout(autoLogVar);
}

function multiCheckBarShowOrNot() {
	multiCheckNumChecked = $('.multiCheckInput:checked').length;
	if(multiCheckNumChecked > 0) {
		$('#multiCheckBar').slideDown();
	}
	else {
		$('#multiCheckAllMode').val('');
		$('#multiCheckBar').slideUp();
	}
}