jQuery(document).ready(function ($) {
	
	$(".reward-list").on('click', '.btn-main.enabled', function(e) {
    e.preventDefault();
	var $this = $(this);
    $.ajax({
      url: corsivalab_vars.ajax_url,
      type: "POST",
      data: {
		  action: "check_reward_status",
		  type: $this.parents('.reward-item').data("type"),
      },
      beforeSend: function (xhr) {
		  $this.html('CHECKING');
		  $this.removeClass('enabled');
        canBeLoaded = false;
      },
		context: $this,
      success: function (response) {
        if (response.success && response.success == true) {
			$this.html('COMPLETED');
			$this.removeClass('btn-outline-v3').addClass('btn-main-v2');
        } else {
			$this.addClass('enabled');
		}
      },
    });
  });
	

	
	
	
	
});