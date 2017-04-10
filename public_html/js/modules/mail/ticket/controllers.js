'use strict';

angular.module('ticketApp.Mail.Ticket', []).controller('TicketController', function (http, $scope) {

  $scope.listeler = {
    liste_1: [],
    liste_2: [],
    liste_3: []
  };

  $scope.secimler = {
    liste_1: null,
    liste_2: null,
    liste_3: null
  };

  $scope.getKategori = function (rootId, listeAdi) {

    http.isReady(function (http) {
      http.post('turler/get', {rootId: rootId})
        .success(function (json) {
          $scope.listeler[listeAdi] = json.response.data;
        });
    });
  };

  $scope.getKategori(-1, 'liste_1');
  $scope.master = {};

  $scope.update = function () {
    console.log($scope.contents.name);
    http.isReady(function (http) {
      http.post('question/create', {contents: $scope.contents.name, categorie_id: $scope.secimler.liste_3.id})
         .success(function () {
          console.log("kayıt basarılı");
        });
    });
  };

  $scope.add = function () {
    console.log($scope.quesText);
    http.isReady(function (http) {
      http.post('turler/create', {title: $scope.quesText})
         .success(function () {
          console.log("Soru kayıdı basarılı");
        });
    });
  };







});