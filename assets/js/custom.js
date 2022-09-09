  var isIOS = ((/iphone|ipad/gi).test(navigator.appVersion));
  var myevent = isIOS ? "touchstart" : "click";
  var menter = isIOS ? "touchstart" : "mouseenter";
  var mleave = isIOS ? "touchend" : "mouseleave";
  $(document).ready(function () {
  
      $(".dropdown:has(ul)").hover(function () {
          $(this).find("ul").stop("true", "true").slideDown(500);
      }, function () {
          $(this).find("ul").stop("true", "true").slideUp(500);
      });

      // Hide alert
      $('body').on('click', '.close', function () {
          var dvData = $(this).parent().parent();
          setTimeout(function () {
                  $(dvData).fadeOut("slow",
                      function () {
                          $(dvData).remove();
                      });
              },
              100);
      });


      // Clear input fields on focus
      $('input').each(function () {
          var default_value = this.value;
          $(this).focus(function () {
              if (this.value == default_value) {
                  this.value = '';
              }
          });
          $(this).blur(function () {
              if (this.value == '') {
                  this.value = default_value;
              }
          });
      });



      /* == Tooltip == */
      var targets = $('body'),
          target = false,
          tooltip = false,
          title = false;
      targets.on(menter, ".tooltip", function () {
          target = $(this);
          tip = target.attr('data-title');
          tooltip = $('<div id="tooltip"></div>');
          if (!tip || tip == '') return false;
          target.removeAttr('data-title');
          tooltip.css('opacity', 0)
              .html(tip)
              .appendTo('html');
          var init_tooltip = function (e) {
              if ($(window).width() < tooltip.outerWidth() * 1.5) tooltip.css('max-width', $(window).width() / 2);
              else tooltip.css('max-width', 340);
              var pos_left = target.offset().left + (target.outerWidth() / 2) - (tooltip.outerWidth() / 2),
                  pos_top = target.offset().top - tooltip.outerHeight() - 20;
              if (pos_left < 0) {
                  pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                  tooltip.addClass('left');
              } else tooltip.removeClass('left');
              if (pos_left + tooltip.outerWidth() > $(window).width()) {
                  pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                  tooltip.addClass('right');
              } else tooltip.removeClass('right');
              if (pos_top < 0) {
                  var pos_top = target.offset().top + target.outerHeight();
                  tooltip.addClass('top');
              } else tooltip.removeClass('top');
              tooltip.css({
                  left: pos_left,
                  top: pos_top
              })
                  .animate({
                      top: '+=10',
                      opacity: 1
                  }, 50);
          };
          init_tooltip();

          $(window).resize(init_tooltip);
          var remove_tooltip = function () {
              tooltip.animate({
                  top: '-=10',
                  opacity: 0
              }, 50, function () {
                  $(this).remove();
              });
              target.attr('data-title', tip);
          };
          target.on(mleave, remove_tooltip);
          tooltip.on(myevent, remove_tooltip);
      });

      $('#settingslist').hide();
      $('a#showhide').click(function () {
          $('#settingslist').slideToggle();
          return false;
      });
      $('a.minilist').click(function () {
          $('#settingslist2').toggle();
          return false;
      });

      /* == Admin Menu == */
	  $('ul.nav li').on('click', function () {
		  $(this).addClass("hover");
		  $('ul:first',this).slideToggle("fast");
	  });
	  $("ul.nav li:has(ul)").find("a:first").append("&nbsp;...");

 
	  
	  $("button#do-passreset").click(function () {
		$("#show-passreset").slideToggle();
	  });
  });
  
  function showLoader() {
	  $("#loader").fadeIn(200);
  }

  function hideLoader() {
	  $("#loader").fadeOut(200);
  };
  
  function showsLoader(id) {
	  $(id + ' .loading').fadeIn(200);
  }

  function hidesLoader(id) {
	  $(id + ' .loading').fadeOut(200);
  };