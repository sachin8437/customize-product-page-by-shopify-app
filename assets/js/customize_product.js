alert('45645'); 
   jQuery(document).ready(function ($) {
            $('#customizP_popup').on('click', function () {
                $('.main-popup').show();
                $('.top').show();
                $('.selected-popup').show();
                $('.bottom').hide();
                $('.upload_product').hide();
                $(".main-popup").css({"height": "100%"});

                // Custom product functionality
                $('.custom_pro').on('click', function () {
                  //  window.location.href = '/pages/customize-product//';
                   $('.top').hide();
                    $('.bottom').show();
                    $(".main-popup").css({"height": "100%"});

                }); 

                // Custom Upload functionality
                $('.upload_pro').on('click', function () {
                    $('.top').show();
                    $('.upload_product').show();
                    $('.bottom').hide();
                    $('.selected-popup').hide();
                });
            });

  
            $("#fs").change(function() {
                //alert($(this).val());
                $('.changeMe').css("font-family", $(this).val());

            });

            $("#size").change(function() {
                $('.changeMe').css("font-size", $(this).val() + "px");
            });
  
            // Popup close button
            $('.custom_close').on('click', function () {
                $('.main-popup').hide();
            });

  var $textOverlay = $('<div id="textOverlay" contenteditable="true"></div>').appendTo('.bottom');

      $textOverlay.draggable().resizable({
        handles: 'n, e, s, w, ne, se, sw, nw',
        minWidth: 50,
        minHeight: 50,
        start: function (event, ui) {
          // Set editing flag when dragging or resizing starts
          isEditing = true;
        },
        stop: function (event, ui) {
          // Reset editing flag when dragging or resizing stops
          isEditing = false;
        }
      });

      $('.custom_product img').on('click', function (event) {
        if (!$textOverlay.is(':focus')) {
          $textOverlay.css({
            left: event.pageX,
            top: event.pageY
          }).show().focus();
        }
      });

      $textOverlay.on('keyup', function () {
        $('.custom_product input[type="text"]').val($(this).text());
      });

      $('#textColorPicker').on('input', function () {
        $textOverlay.css('color', $(this).val());
      });
 	var colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF'];
    for (var i = 0; i < colors.length; i++) {
      $('#colorContainer').append('<div class="color-box" style="background-color: ' + colors[i] + '"></div>');
    }
  });  

