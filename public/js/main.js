$(document).bind('pageinit', function() {

  Number.prototype.pad = function(len)
  {
    return (new Array(len+1).join("0") + this).slice(-len)
  }

  /*
   * Start and end time form scripts
   */
  $('.fill-time-btn').on('click', function() {
      var date = new Date( Date.now() ),
          str  = date.getHours().pad(2) + ':' + date.getMinutes().pad(2) + ':' + date.getSeconds().pad(2);
      $(this).parent().find('.time-input').attr('value', str );
    });

  /*
   * Data entry page scripts
   */
  $('#data-entry-form').on('click', 'a', function() {
      var operator = $(this).attr('name'),
          input    = $(this).siblings('.ui-input-text').children('input'),
          val      = input.attr('value');

      if( operator === 'minus' ) {

          // check if val is positive
          if ( val > 0 ) {
              input.attr( 'value', --val );
          }

      } else {

          input.attr( 'value', ++val );
      }
  });

  $('#runoff-entry').on('change', 'input', function(e) {
    $('#runoff-picture').popup("open");
  });


  /**
   * Helper functions
   */

});

 $(document).bind("mobileinit", function(){
        $.mobile.ajaxEnabled = false;
    });
