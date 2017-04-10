'use strict';

angular.module('ticketApp.Admin.Answer', []).controller('AnswerController', function (http, $scope, sweet, auth) {

  //sweet.success('Örnek mesaj.');
  // sweet.info('Örnek mesaj.');
  // sweet.warning('Örnek mesaj.');
  // sweet.error('Örnek mesaj.');

  $scope.useridanswer = auth.getUser().authority;
  if ($scope.useridanswer === 'support') {

    $scope.useridanswer = true;

  } else {

    $scope.useridanswer = false;

  }

  $scope.userName = auth.getUser().name;

  $scope.getQuestionList = function () {
    http.isReady(function (http) {
      http.post('Question/get')
          .success(function (json) {
          $scope.questions = json.response.data;
        });
    });
  };

  $scope.sayi = '0';
  http.isReady(function (http) {
    http.post('User/getUser', $scope.sayi)
        .success(function (json) {
        console.log("name geldi");
        $scope.userName = json.response.data;
      });
  });






  $scope.toggleDetail = function (question) {
    if (question.detailOpened === undefined) {
      question.detailOpened = true;
    } else {
      question.detailOpened = !question.detailOpened;
    }

    $scope.getAnswer(question.id);
    $scope.status = question.status;
  };


  $scope.answerSend = function (content) {
    $scope.getAnswer($scope.idQuestion);
    $scope.answerContent = content;
    http.isReady(function (http) {
      http.post('Answer/create', {content: $scope.answerContent,
        question_id: $scope.idQuestion,
        user_id: $scope.userid})
          .success(function () {
          $scope.getAnswer($scope.idQuestion);
        });
    });
    $scope.status = 1;
    http.isReady(function (http) {
      http.post('question/update',
        {id: $scope.idQuestion, status: $scope.status})
          .success(function () {
          console.log("STATUS TAMAMLANDI");
          $scope.getQuestionList();
        });
    });

  };

  $scope.getAnswer = function (idQuestion) {
    $scope.answers = [];
    $scope.idQuestion = idQuestion;
    http.isReady(function (http) {
      http.post('Answer/getById', {question_id: $scope.idQuestion})
         .success(function (json) {
          $scope.answers = json.response.data;
          console.log($scope.answers);
        });
    });
  };
//kapatma islemi icin ugrastım 


  $scope.lock = function (idQuestion) {
    sweet.question('Kapatmak istediginize eminmisiniz ?')
      .cancel(function () {
        console.log('cancel');
      })
      .success(function () {
        $scope.status = 3;
        $scope.idQuestion = idQuestion;
        http.isReady(function (http) {
          http.post('question/update',
            {id: $scope.idQuestion, status: $scope.status})
              .success(function () {
              console.log("STATUS TAMAMLANDI");
              $scope.getQuestionList();
            });
        });
      });
  };

  $scope.getQuestionList();

});