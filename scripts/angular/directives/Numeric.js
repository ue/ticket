app.directive('numericInput', function () {
  return {
    restrict: 'A',
    scope: {},
    link: function (scope, elem, attr, ctrl) {
      elem.bind("keydown keypress", function (evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (charCode > 40 && (charCode < 48 || charCode > 57) && (charCode!=46&&charCode!=190)) {
            return false;          
        }

        return true;
      });
    }
  }
});