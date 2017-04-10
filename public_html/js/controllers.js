'use strict';

(function () {
  angular.module('blankonController', [])
    .controller('BlankonCtrl', function ($scope) {
      $scope.splash = false;
      $scope.$on('splash.onClose', function () {
        $scope.splash = false;
      });

      // =========================================================================
      // SUPPORT IE
      // =========================================================================
      $scope.supportIE = function () {
        // IE mode
        var isIE8 = false;
        var isIE9 = false;
        var isIE10 = false;

        // initializes main settings for IE
        isIE8 = !! navigator.userAgent.match(/MSIE 8.0/);
        isIE9 = !! navigator.userAgent.match(/MSIE 9.0/);
        isIE10 = !! navigator.userAgent.match(/MSIE 10.0/);

        if (isIE10) {
          $('html').addClass('ie10'); // detect IE10 version
        }

        if (isIE10 || isIE9 || isIE8) {
          $('html').addClass('ie'); // detect IE8, IE9, IE10 version
        }

        // Fix input placeholder issue for IE8 and IE9
        if (isIE8 || isIE9) { // ie8 & ie9
          // this is html5 placeholder fix for inputs, inputs with placeholder-no-fix class will be skipped(e.g: we need this for password fields)
          $('input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)').each(function () {
            var input = $(this);

            if (input.val() == '' && input.attr("placeholder") != '') {
              input.addClass("placeholder").val(input.attr('placeholder'));
            }

            input.focus(function () {
              if (input.val() == input.attr('placeholder')) {
                input.val('');
              }
            });

            input.blur(function () {
              if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.val(input.attr('placeholder'));
              }
            });
          });
        }
      };

      $scope.tooltip = function () {
        if ($('[data-toggle=tooltip]').length) {
          $('[data-toggle=tooltip]').tooltip({
            animation: 'fade'
          });
        }
      };

      $scope.popover = function () {
        if ($('[data-toggle=popover]').length) {
          $('[data-toggle=popover]').popover();
        }
      };

      $scope.navbarMessages = [];
      $scope.navbarNotifications = [];
      $scope.profile = [];
      $scope.chats = [];

      $scope.supportIE(); // Call cookie sidebar minimize
      $scope.tooltip(); // Call tooltip
      $scope.popover(); // Call popover

    });

}) ();
