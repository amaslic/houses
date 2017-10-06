

!function($) {
    "use strict";
	// Minimalize menu
    $('.navbar-minimalize').on('click', function () {
		if($(window).width() > 991)
		{
			 $("body").toggleClass("mini-navbar");
		}
		else
		{
        $("body").toggleClass("mini-navbar-show");
		}


    });
   $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover()
	// $.material.init();
	
$(function(){
    $('.scroller').slimScroll({
        height: '250px'
    });
	//$('#input-date-added').datepicker();
	//$('#input-date-modified').datepicker();
	$('#menu').metisMenu();
});
	
	
	
	}(window.jQuery);	


	$('.panel-body').hide();
	
	$(document).on('click', '.card-header .btn-clickable', function(e){
		var $this = $(this);
		
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.addClass('panel-collapsed');
			
			$this.find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
		} else {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
		}
	});