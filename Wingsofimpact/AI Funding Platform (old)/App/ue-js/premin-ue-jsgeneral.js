function setCookie(c_name,value,expiredays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}

function getCookie(c_name) {
	if (document.cookie.length>0) {
	  c_start=document.cookie.indexOf(c_name + "=");
	  if (c_start!=-1)  {
		c_start=c_start + c_name.length+1;
		c_end=document.cookie.indexOf(";",c_start);
		if (c_end==-1) c_end=document.cookie.length;
		return unescape(document.cookie.substring(c_start,c_end));
		}
	  }
	return "";
}

function scrollToAnchor(aid){
	var aTag = $("a[name='"+ aid +"']");
	$('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

function moneyFormat(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function numericOnly(numericOnlyStr) { 
	numericOnlyStrRes = numericOnlyStr.replace(/\D/g,'');
	return parseInt(numericOnlyStrRes);
}

function writeCartNumberOfItems() {
	writeCartNumberOfItemsInitTotal = 0;
	writeCartNumberOfItemsStr = getCookie('ueCartCookie');
	splitted = writeCartNumberOfItemsStr.split('|');
	splittedNumber = (parseInt(splitted.length) - 1);
	for(i=0;i<splittedNumber;i++) {
		splittedVals = splitted[i].split(',');
		writeCartNumberOfItemsInitTotal += parseInt(splittedVals[2]);
	}
	//alert(writeCartNumberOfItemsInitTotal);
	$('#numberOfItems').html(writeCartNumberOfItemsInitTotal);
	$('#numberOfItemsMobile').html(writeCartNumberOfItemsInitTotal);
}

function viewcartSubTotal(viewcartSubTotalCurrency) {
	viewcartSubTotalGrand = 0;
	$(".currentPrdTotal").each(function() {
		viewcartSubTotalGrand += parseInt(numericOnly($(this).text()));
	});
	
	$("#viewCartSubTotal").text(viewcartSubTotalCurrency+' '+moneyFormat(viewcartSubTotalGrand));
}

function viewcartAddQuantity(viewcartAddQuantityRowNumber,viewcartAddQuantityBulk) {
	//Quantity
	cartSizeValIdStr = '#cartSizeVal'+viewcartAddQuantityRowNumber;
	cartSizeValCurVal = parseInt($(cartSizeValIdStr).val());
	if(cartSizeValCurVal < 99 && cartSizeValCurVal > 0) {
		cartSizeValCurVal++;
	}

	//Currency
	cartCurrencyValIdStr = '#currentGlbCurrency'+viewcartAddQuantityRowNumber;
	cartCurrencyValIdVal = $(cartCurrencyValIdStr).val();
	
	//Price
	if(parseInt(viewcartAddQuantityBulk) > 0) {
		cartPriceContainerStr = 'priceContainer'+viewcartAddQuantityRowNumber;
		cartPriceValIdStr = '#currentPrdGrosirPrice'+viewcartAddQuantityRowNumber;
		writePriceNow = parseInt($(cartPriceValIdStr).val());
		
		if(cartSizeValCurVal >= viewcartAddQuantityBulk && writePriceNow > 0) {
			document.getElementById(cartPriceContainerStr).innerHTML = cartCurrencyValIdVal+' '+moneyFormat(writePriceNow);
		}
		else {
			cartPriceValIdStr = '#currentPrdPrice'+viewcartAddQuantityRowNumber;
			writePriceNow = parseInt($(cartPriceValIdStr).val());
			document.getElementById(cartPriceContainerStr).innerHTML = cartCurrencyValIdVal+' '+moneyFormat(writePriceNow);
		}
	}
	else {
		cartPriceValIdStr = '#currentPrdPrice'+viewcartAddQuantityRowNumber;
	}
	cartPriceValIdVal = parseInt($(cartPriceValIdStr).val());
	viewcartAddQuantityPriceRes = cartCurrencyValIdVal+' '+moneyFormat(cartPriceValIdVal*cartSizeValCurVal);
	
	//Get Row Total ID
	cartTotalValIdStr = '#currentPrdTotal'+viewcartAddQuantityRowNumber;
	
	$(cartSizeValIdStr).val(cartSizeValCurVal);
	$(cartTotalValIdStr).text(viewcartAddQuantityPriceRes);
	//alert(viewcartAddQuantityPriceRes);
	viewcartSubTotal(cartCurrencyValIdVal);
}

function viewcartSubsQuantity(viewcartAddQuantityRowNumber,viewcartAddQuantityBulk) {
	//Quantity
	cartSizeValIdStr = '#cartSizeVal'+viewcartAddQuantityRowNumber;
	cartSizeValCurVal = parseInt($(cartSizeValIdStr).val());
	if(cartSizeValCurVal < 99 && cartSizeValCurVal > 1) {
		cartSizeValCurVal--;
	}

	//Currency
	cartCurrencyValIdStr = '#currentGlbCurrency'+viewcartAddQuantityRowNumber;
	cartCurrencyValIdVal = $(cartCurrencyValIdStr).val();
	
	//Price
	if(parseInt(viewcartAddQuantityBulk) > 0) {
		cartPriceContainerStr = 'priceContainer'+viewcartAddQuantityRowNumber;
		cartPriceValIdStr = '#currentPrdGrosirPrice'+viewcartAddQuantityRowNumber;
		writePriceNow = parseInt($(cartPriceValIdStr).val());
		
		if(cartSizeValCurVal >= viewcartAddQuantityBulk && writePriceNow > 0) {
			document.getElementById(cartPriceContainerStr).innerHTML = cartCurrencyValIdVal+' '+moneyFormat(writePriceNow);
		}
		else {
			cartPriceValIdStr = '#currentPrdPrice'+viewcartAddQuantityRowNumber;
			writePriceNow = parseInt($(cartPriceValIdStr).val());
			document.getElementById(cartPriceContainerStr).innerHTML = cartCurrencyValIdVal+' '+moneyFormat(writePriceNow);
		}
	}
	else {
		cartPriceValIdStr = '#currentPrdPrice'+viewcartAddQuantityRowNumber;
	}
	cartPriceValIdVal = parseInt($(cartPriceValIdStr).val());
	viewcartAddQuantityPriceRes = cartCurrencyValIdVal+' '+moneyFormat(cartPriceValIdVal*cartSizeValCurVal);
	
	//Get Row Total ID
	cartTotalValIdStr = '#currentPrdTotal'+viewcartAddQuantityRowNumber;
	
	$(cartSizeValIdStr).val(cartSizeValCurVal);
	$(cartTotalValIdStr).text(viewcartAddQuantityPriceRes);
	//alert(viewcartAddQuantityPriceRes);
	viewcartSubTotal(cartCurrencyValIdVal);
}