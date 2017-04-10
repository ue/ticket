'use strict';

angular.module('ticketApp.User.Archives', []).controller('ArchivesController', function (http, $scope) {

  $scope.getKategori(-1, 'liste_1');
  $scope.master = {};
  $scope.getQuestionList = function () {
    $scope.questions = [];
    http.isReady(function (http) {
      http.post('Question/get')
          .success(function (json) {
          $scope.questions = json.response.data;
        });
    });
  };
  $scope.openBtntrue = true;


  $scope.ticketBtn = function () {
    $scope.openorclose = !$scope.openorclose;
    $scope.openBtn = false;
  };
  $scope.asnweshow = function () {
    $scope.answerShow = false;
  };

  $scope.toggleDetail = function (question) {
    if (question.detailOpened === undefined) {
      question.detailOpened = true;
    } else {
      question.detailOpened = !question.detailOpened;
    }
    $scope.getAnswer(question.id);
    $scope.status = question.status;
  };
  $scope.status = 0;
  http.isReady(function (http) {
    http.post('question/update',
      {id: $scope.idQuestion, status: $scope.status})
       .success(function () {
        console.log("STATUS TAMAMLANDI");
      });
  });


  $scope.getAnswer = function (idQuestion) {
    $scope.answers = [];
    $scope.idQuestion = idQuestion;
    console.log($scope.idQuestion);

    http.isReady(function (http) {
      http.post('Answer/getById', {question_id: $scope.idQuestion})
         .success(function (json) {
          $scope.answers = json.response.data;
          console.log($scope.answers);
        });
    });
  };



  $scope.userid = '1';
  $scope.getQuestionList();



});

