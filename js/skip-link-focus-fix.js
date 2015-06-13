(function($) {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function(el, index, selector){
      var $element = $(el);
      return $element.is(':input:enabled, a[href], area[href], object, [tabindex]') && !$element.is(':hidden');
    }
  });

  function focusOnElement($element) {
    if (!$element.length) {
      return;
    }
    if (!$element.is(':focusable')) {
      // add tabindex to make focusable and remove again
      $element.attr('tabindex', -1).on('blur focusout', function () {
        $(this).removeAttr('tabindex');
      });
    }
    $element.focus();
  }

  $(document).ready(function(){
    // if there is a '#' in the URL (someone linking directly to a page with an anchor)
    if (document.location.hash) {
      focusOnElement($(document.location.hash));
    }

    // if the hash has been changed (activation of an in-page link)
    $(window).bind('hashchange', function() {
      var hash = "#"+window.location.hash.replace(/^#/,'');
      focusOnElement($(hash));
    });
  });

})(jQuery);
