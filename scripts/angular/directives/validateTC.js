app.directive('validateTc', function () {
  return {
    require: 'ngModel',
    link: function (scope, elem, attr, ngModel) {

      scope.TC = function (value) {
        var toplam, strtoplam = 0, onunbirlerbas;
        toplam = Number(value.substring(0, 1)) + Number(value.substring(1, 2)) +
          Number(value.substring(2, 3)) + Number(value.substring(3, 4)) +
          Number(value.substring(4, 5)) + Number(value.substring(5, 6)) +
          Number(value.substring(6, 7)) + Number(value.substring(7, 8)) +
          Number(value.substring(8, 9)) + Number(value.substring(9, 10));
        strtoplam = String(toplam);
        onunbirlerbas = strtoplam.substring(strtoplam.length, strtoplam.length - 1);

        if (onunbirlerbas === value.substring(10, 11)) {
          return true;
        }

        return false;
      };

      //For DOM -> model validation
      ngModel.$parsers.unshift(function (value) {
        if (attr.validateTc === 'false') {
          var valid = true;
        } else {
          var valid = scope.TC(value);
        }
        ngModel.$setValidity('validate-tc', valid);
        return valid ? value : undefined;
      });

      //For model -> DOM validation
      ngModel.$formatters.unshift(function (value) {
        var valid = true;
        if (attr.validateTc !== 'false') {
          valid = scope.TC(value);
        }
        ngModel.$setValidity('validate-tc', valid);
        return value;
      });

    }
  };
});