'use strict';

angular.module('ticketApp.Mail.Ticket', []).controller('TicketController', function ($scope, http) {


  $scope.add = function () {
    console.log($scope.quesText);
    http.isReady(function (http) {
      http.post('turler/create', {title: $scope.quesText})
         .success(function () {
          console.log("Soru kayıdı basarılı");
        });
    });
  };



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


  $scope.edit = function () {
    http.isReady(function (http) {
      http.post('turler/update', {id: $scope.secimler.liste_1.id, title: $scope.changeText})
          .success(function () {
          console.log("update islemi basarılı");
          console.log($scope.secimler.liste_1.id);
          console.log($scope.secimler.liste_1.title);
          console.log($scope.changeText);
        });
    });
  };

  $scope.delete = function () {
    http.isReady(function (http) {
      http.post('turler/delete', {id: $scope.deleteText.id})
          .success(function () {
          console.log("silme islemi basarılı");
        });

    });


  };





});