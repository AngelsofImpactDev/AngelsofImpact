<script type="text/javascript">
	$('.inputfile').each( function() {
		var $input	 = $( this ),
			$label	 = $input.next( 'label' ),
			labelVal = $label.html();

		$input.on( 'change', function( e )
		{
			var fileName = '';

			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				$label.find( 'span' ).html( fileName );
			else
				$label.html( labelVal );
		});

		// Firefox bug fix
		$input
		.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
	});
	
	<!-- remove this if you use Modernizr -->
	(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
</script>
<script type="text/javascript">
	$('#mobilemenuSelect').change(function() {
		<?php
			if($ue_mysql_connect_mode == 'dev') {
		?>
			curPgMob = 'http://localhost/tlpNeoReloaded/';
		<?php
			}
			else {
		?>
			curPgMob = 'http://<?php echo $globvar_address?>/';
		<?php
			}
		?>
		curPgMob = curPgMob + $(this).val();
		window.location = curPgMob;
		//alert(curPgMob);
	});
	$(".eachClrSel").click(function() {
	   scrollToAnchor('prdList');
	});
	
	writeCartNumberOfItems();
</script>
<script type="text/javascript" src="ue-js/uepopup/magnific-init.js"></script>
<script type="text/javascript">
	$("select[data-chosen!='disabled'][data-chosen!='fixedwidth']").chosen({allow_single_deselect:true});
	$("select[data-chosen!='disabled'][data-chosen='fixedwidth']").chosen({allow_single_deselect:true,width: '220px'});
</script>
<?php
	if($ue_mysql_connect_mode != 'dev' && ueGetSiteData('analytics') != '') {
		echo ueWritePage(ueGetSiteData('analytics'),true);
	}
?>
</body>
</html>
<?php
	@ ue_close($GLOBALS['mysql_connect_init']);
?>