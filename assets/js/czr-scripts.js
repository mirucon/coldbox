'use strict';

var czr = function czr() {
  var _api = wp.customize;

  // Shows concatenated JS files option when hljs option checked.
  var hljs = _api.control('does_use_hljs').setting._value;
  var hljsWeb = _api.control('use_hljs_web_pack').setting._value;

  if (!hljs && !hljsWeb) {
    _api.control('concat_js').deactivate();
  } else {
    _api.control('concat_js').activate();
  }

  // Shows Use Narrower Padding when Scrolling option when Horizontal selected.
  var headerDirection = _api.control('header_direction').setting._value;

  if (headerDirection !== 'row') {
    _api.control('use_narrower_padding').deactivate();
  } else {
    _api.control('use_narrower_padding').activate();
  }
  console.log('inside - hi');
};

document.addEventListener('DOMContentLoaded', function () {
  czr();
});