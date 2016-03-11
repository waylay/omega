/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        // Sidebar expand list
        $('#expList').find('li:has(ul)')
          .click( function(event) {
              if (this === event.target) {
                  $(this).toggleClass('expanded');
                  $(this).children('ul').toggle('medium');
              }
              return false;
          })
          .addClass('collapsed')
          .children('ul').hide();


      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
         $('.current-cat-parent').toggleClass('expanded').children('ul').show();
         $('.current-cat-parent').parents('.collapsed').toggleClass('expanded').children('ul').show();
      }
    },
    // Home page
    'home': {
      init: function() {

        // Homepage Slider
        $('.flexslider').flexslider({
          animation: "fade",
          controlNav: false,
          prevText: "",
          nextText: "",
          start: function(slider){
            $('header.banner').css('background-image', 'url(' + $(slider.slides[slider.currentSlide]).data('headerbg') + ')');
          },
          before: function(slider){
            $('header.banner').css('background-image', 'url(' + $(slider.slides[slider.animatingTo]).data('headerbg') + ')');
          }
        });

        // Homepage Menu - make the subnav go on top of the slider
        $('#primary_navigation').on('show.bs.collapse', function () {
             $(this).parents('.nav-container').css( "z-index", "11" );
        });

        $('#primary_navigation').on('hidden.bs.collapse', function () {
            $(this).parents('.nav-container').css( "z-index", "1" );
        });

        // Hompage cards - make the "more" link to slide the content up
        $(".homecard .btn").hover(function() {
            $(this).parents('.homecard').find('.card-content').stop().animate({'height': '120px'});
        }, function() {
            $(this).parents('.homecard').find('.card-content').stop().animate({'height': '1px'});
        });
      },
      finalize: function() {

      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
