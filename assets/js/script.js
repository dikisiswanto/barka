(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

var _slider = _interopRequireDefault(require("./slider"));

var _menu = _interopRequireDefault(require("./menu"));

function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : {
    "default": obj
  };
}

window.addEventListener('DOMContentLoaded', function () {
  (0, _slider["default"])();
  (0, _menu["default"])();
  AOS.init({
    once: true
  });
});

},{"./menu":2,"./slider":3}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
/* eslint-disable func-names */

/* eslint-disable prefer-arrow-callback */

var setMobileMenuAction = function setMobileMenuAction() {
  var menuButton = document.querySelector('.menu-button');
  var menu = document.querySelector('.menu');
  var body = document.querySelector('body');
  var backdrop = document.querySelector('.backdrop');
  var hasDropdownMenuItems = document.querySelectorAll('.has-submenu > .menu-link');
  menuButton.addEventListener('click', function () {
    menuButton.classList.toggle('text-white');
    var menuButtonIcon = menuButton.querySelector('.fa');

    if (menuButtonIcon.classList.contains('fa-bars')) {
      menuButtonIcon.classList.remove('fa-bars');
      menuButtonIcon.classList.add('fa-times');
    } else {
      menuButtonIcon.classList.remove('fa-times');
      menuButtonIcon.classList.add('fa-bars');
    }

    menu.classList.toggle('is-open');
    body.classList.toggle('is-disabled');
  });
  backdrop.addEventListener('click', function () {
    menuButton.classList.remove('text-white');
    var menuButtonIcon = menuButton.querySelector('.fa');

    if (menuButtonIcon.classList.contains('fa-bars')) {
      menuButtonIcon.classList.remove('fa-bars');
      menuButtonIcon.classList.add('fa-times');
    } else {
      menuButtonIcon.classList.remove('fa-times');
      menuButtonIcon.classList.add('fa-bars');
    }

    menu.classList.remove('is-open');
    body.classList.remove('is-disabled');
  });
  hasDropdownMenuItems.forEach(function (menuItem) {
    menuItem.addEventListener('click', function (event) {
      event.preventDefault();
      this.parentNode.querySelector('.menu-dropdown').classList.toggle('is-open');
    });
  });
};

var _default = setMobileMenuAction;
exports["default"] = _default;

},{}],3:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
/* eslint-disable no-undef */

/* eslint-disable no-new */

var setSlider = function setSlider() {
  var slider = document.querySelector('.o-slider');

  if (slider) {
    $('.o-slider').owlCarousel({
      animateOut: 'fadeOutLeft',
      animateIn: 'fadeInRight',
      items: 1,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      loop: true,
      smartSpeed: 450,
      navs: false
    });
  }
};

var _default = setSlider;
exports["default"] = _default;

},{}]},{},[1])

