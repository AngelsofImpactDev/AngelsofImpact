tinymce.init({
	selector: 'textarea.editme',
	resize: false,
	menubar : true,
	statusbar: true,
	menubar: "insert,edit,table",
	plugins: "paste,textcolor,colorpicker,insertdatetime,table,searchreplace,code,preview,link,charmap,fullscreen,autoresize,hr,wordcount,autolink",
	toolbar: "undo,redo,|,forecolor backcolor,|,fontsizeselect,|,alignleft,aligncenter,alignright,alignjustify,|,bold,italic,underline,strikethrough,subscript,superscript,removeformat,|,bullist,numlist,hr,|,searchreplace,|,fullscreen,|,code,preview",
	fontsize_formats: "8px 9px 10px 11px 12px 14px 20px 26px 36px 48px 72px",
	forced_root_block : '', 
	force_br_newlines : true,
	force_p_newlines : false,
	autoresize_min_height: 10,
	autoresize_max_height: 300
});

tinymce.init({
	selector: 'textarea.editmeImage',
	resize: false,
	menubar : true,
	statusbar: true,
	menubar: "insert,edit,table",
	//plugins: "paste,textcolor,colorpicker,insertdatetime,table,searchreplace,code,preview,link,charmap,fullscreen,autoresize,hr,wordcount,autolink,media,image,doksoft_easy_image,imagetools",
	plugins: "paste,textcolor,colorpicker,insertdatetime,table,searchreplace,code,preview,link,charmap,fullscreen,autoresize,hr,wordcount,autolink,media,image,doksoft_easy_image,ue_image_editor",
	toolbar: "undo,redo,|,forecolor backcolor,|,fontsizeselect,|,alignleft,aligncenter,alignright,alignjustify,|,bold,italic,underline,strikethrough,subscript,superscript,removeformat,|,bullist,numlist,hr,|,doksoft_easy_image,image,ue_image_editor,media,|,searchreplace,|,fullscreen,|,code,preview,",
	fontsize_formats: "8px 9px 10px 11px 12px 14px 20px 26px 36px 48px 72px",
	forced_root_block : '', 
	force_br_newlines : true,
	force_p_newlines : false,
	autoresize_min_height: 300,
	autoresize_max_height: 500
});