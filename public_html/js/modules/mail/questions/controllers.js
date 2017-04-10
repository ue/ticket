'use strict';

angular.module('ticketApp.Mail.Ticket', []).controller('QuestionController', function ($scope, http) {

  $scope.categorie_id = '12';

  http.isReady(function (http) {
    http.post('Question/get')
        .success(function (json) {
        console.log("Soru cekme işlemi basarılı");
        console.log(json.response.data);
      });
  });




});