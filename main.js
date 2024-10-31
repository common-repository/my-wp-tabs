	
jQuery(document).ready(function($) {
	// Tabs
	//When page loads...
	jQuery('.tabs-wrapper').each(function() {
		jQuery(this).find(".tab_content").hide(); //Hide all content
		jQuery(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		jQuery(this).find(".tab_content:first").show(); //Show first tab content
	});
	
	//On Click Event
	jQuery("ul.tabs li").click(function(e) {
		jQuery(this).parents('.tabs-wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(this).parents('.tabs-wrapper').find(".tab_content").hide(); //Hide all tab content

		var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		jQuery(this).parents('.tabs-wrapper').find(activeTab).fadeIn(); //Fade in the active ID content
		
		e.preventDefault();
	});
	
	jQuery("ul.tabs li a").click(function(e) {
		e.preventDefault();
	})

});