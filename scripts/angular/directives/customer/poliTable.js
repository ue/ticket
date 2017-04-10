angular.module('poliTable')
  .directive('poliTable', function () {
    return {
      restrict : 'E',
      template: '<div>Hello Wordl</div>'
    };
  });



  app.directive('customerBox', function ($state, $data) {
 return {
   restrict: 'E',
   templateUrl: '/views/directives/customer/box.html' + freshDate(),
   scope: {
     customer: '=customer',
     grup: '=grup',
     no: '=no',
     type: '=type',
     back: '=back'
   },
   link: function (scope) {

     scope.titles = ['T.C.', 'Vergi No', 'Yabancı No'];

     scope.backToPreview = function () {
       var abc = {
         type: scope.type,
         no: scope.no
       };
       $state.go('customer.preview', abc);
     };

     scope.newQuery = function () {
       scope.data = $data.getProvider('Customer.PreviewController', function () {
         return {};
       });
       scope.data.query = false;
       scope.data.response = false;
       $state.go('customer.search');
     };

   }
 };
});