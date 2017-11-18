$('.panel_body').hide();

$(document).on('click', '.card_header .btn-clickable', function(e){
    var $this = $(this);
    
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel_body').slideDown();
        $this.addClass('panel-collapsed');
        
        $this.find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else {
        $this.parents('.panel').find('.panel_body').slideUp();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }
});