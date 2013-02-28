$(document).bind('pageinit', function() {

  Number.prototype.pad = function(len)
  {
    return (new Array(len+1).join("0") + this).slice(-len)
  }

  /*
   * Login form scripts
   */
  $('#login-form').find('.submit').on('click', function(e) {
    e.preventDefault();

    // submit the data with ajax

    // get the status messae from the server
      // if invalid, display error message

      // else go to next page
      $.mobile.changePage("primary-location.html");
  })

  /*
   * Primary location form scripts
   */
  $('#primary-location-form').find('.submit').on('click', function(e) {
    e.preventDefault();

    var primaryLocation =  $(this).parent().parent().find(':checked').val();

    // submit the data with ajax

    // get status message from the server

      // if no errors, go to the next page
        // var params = getUrlParams(),
        //     primaryLocation = params['primary-location'];

        $.mobile.changePage('sublocations-' + primaryLocation + '.html');

      // else handle the errors

    // });

  });

  /*
   * Start and end time form scripts
   */
  $('.fill-time-btn').on('click', function() {
      var date = new Date( Date.now() ),
          str  = date.getHours().pad(2) + ':' + date.getMinutes().pad(2) + ':' + date.getSeconds().pad(2);
      $(this).parent().find('.time-input').attr('value', str );
    });

  $('#start-time-submit').on('click', function(e) {
      e.preventDefault();

      // send form data with ajax
      $.mobile.changePage('data-entry.html');
      
  });

  $('#end-time-form').find('.submit').on('click', function(e) {
    e.preventDefault();

    // send data with ajax


    /*
     * Instead of using history, we should check to see what location the user is working on atm
     * by pulling the information from the database
     */

    // go back to the previous location.
    history.go(-3);

  });

  /*
   * Data entry page scripts
   */
  $('#data-entry-form').on('click', 'a', function() {
      var operator = $(this).data('icon'),                                
          input    = $(this).siblings('input'),    
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

  $('#data-entry-form').find('.submit').on('click', function(e) {
    e.preventDefault();

    // send the form data with ajax

    // on successsful submit, change the page
    $.mobile.changePage('end_time.html');
  });

  $('#runoff-entry').on('change', 'input', function(e) {
    $('#runoff-picture').popup("open");
  });


  /**
   * Helper functions
   */

});
