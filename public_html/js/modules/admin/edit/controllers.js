'use strict';

angular.module('ticketApp.Admin.Edit', []).controller('EditController', function ($scope, http) {



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
      http.post('category/getByRoot', {rootId: rootId})
        .success(function (json) {
          $scope.listeler[listeAdi] = json.response.data;
        });
    });
  };
  $scope.getKategori(-1, 'liste_1');
  $scope.master = {};

  $scope.add = function () {
    http.isReady(function (http) {
      http.post('category/create', {title: $scope.quesText})
         .success(function () {
          console.log("kayıt basarılı");
        });
    });
  };

  $scope.edit = function () {
    console.log($scope.changeText);
    http.isReady(function (http) {
      http.post('category/update',
        {id: $scope.secimler.liste_1.id, title: $scope.changeText})
          .success(function () {
          console.log("update islemi basarılı");
        });
    });
  };

  $scope.delete = function () {
    http.isReady(function (http) {
      http.post('category/delete', {id: $scope.deleteText.id})
          .success(function () {
          console.log("silme islemi basarılı");
        });
    });
  };


});