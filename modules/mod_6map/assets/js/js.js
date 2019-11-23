jQuery(window).load(function(){
	var widthWind = jQuery(window).height()-120;
	jQuery('#module-form').height(widthWind);

	// jQuery('#myTabTabs li a[href="#general"]').before("<i class='fa fa-bars'></i>");
	// jQuery('#myTabTabs li a[href="#assignment"]').before("<i class='fa fa-file-text'></i>");
	// jQuery('#myTabTabs li a[href="#permissions"]').before("<i class='fa fa-users'></i>");
	// jQuery('#myTabTabs li a[href="#attrib-advanced"]').before("<i class='fa fa-wrench'></i>");

	// jQuery('#myTabTabs li').filter(':eq(3)').prepend("<i class='fa fa-cloud-upload'></i>");
	// jQuery('#myTabTabs li').filter(':eq(4)').prepend("<i class='fa fa-folder-o'></i>");
	// jQuery('#myTabTabs li').filter(':eq(5)').prepend("<i class='fa fa-cog'></i>");
	jQuery('.form-horizontal').append("<div class='right-block'></div>");
	
	jQuery(window).resize(function() {
		var widthWind = jQuery(window).height()-120;
	jQuery('#module-form').height(widthWind);
	});
});
jQuery(document).ready(function(){
	
	var cloneContent = jQuery('.form-inline.form-inline-header').clone();
	jQuery('.form-inline.form-inline-header').remove();
	jQuery('#general').prepend(cloneContent);
	jQuery( "#jform_params_module_background" ).change(function() {
		var backgroundIMG = jQuery('#jform_params_module_background').val();
		if ( backgroundIMG != "" ) {
			jQuery('.form-horizontal').css('background-image', 'url(../' + backgroundIMG + ')');
		}
	}).trigger( "change" );
});