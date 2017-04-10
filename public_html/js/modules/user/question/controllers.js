'use strict';

angular.module('ticketApp.User.Questions', []).controller('QuestionController', function (http, $scope, sweet, auth) {

  //sweet.success('Örnek mesaj.');
  // sweet.info('Örnek mesaj.');
  // sweet.warning('Örnek mesaj.');
  // sweet.error('Örnek mesaj.');
  $scope.userName = auth.getUser().name;
  $scope.userid = auth.getUser().authority;
  if ($scope.userid === 'support') {

    $scope.userid = false;

  } else {

    $scope.userid = true;

  }
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

  $scope.newQuestion = {
    title: '',
    content: ''
  };

  console.log("user_id");


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

  $scope.create = function () {
    if ($scope.newQuestion.title === "" &&
        $scope.newQuestion.content === "" &&
        $scope.secimler.liste_1 === null) {
      sweet.warning("Lütfen Tüm  Alanları Doldurun");
    } else if ($scope.newQuestion.content === "") {
      sweet.warning('İcerik boş bırakılamaz !');
    } else if ($scope.secimler.liste_1 === null ||
               $scope.secimler.liste_3 === null ||
               $scope.secimler.liste_4 === null) {
      sweet.warning('Kategori boş bırakılamaz !');
    } else if ($scope.newQuestion.title === "") {
      sweet.warning('Başlık boş bırakılamaz');

    } else {
      sweet.warning('Başlık boş bırakılamaz !');
      $scope.newQuestion.category_id = $scope.secimler.liste_3.id;
      http.isReady(function (http) {
        http.post('question/create', $scope.newQuestion)
           .success(function () {
            sweet.success("Sorunuz tarafımıza iletilmiştir..");
            $scope.openorclose = false;
            $scope.getQuestionList();
          });
      });
    }
  };

  $scope.getQuestionList = function () {
    $scope.questions = [];
    http.isReady(function (http) {
      http.post('Question/get')
          .success(function (json) {
          $scope.questions = json.response.data;
          console.log($scope.questions);
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

  $scope.answerSend = function (content) {
    $scope.getAnswer($scope.idQuestion);
    $scope.answerContent = content;
    http.isReady(function (http) {
      http.post('Answer/create', {content: $scope.answerContent,
        question_id: $scope.idQuestion})
          .success(function () {
          $scope.getAnswer($scope.idQuestion);
        });
    });
    $scope.status = 0;
    http.isReady(function (http) {
      http.post('question/update',
        {id: $scope.idQuestion, status: $scope.status})
          .success(function () {
          $scope.getQuestionList();
        });
    });
  };
/*
  $scope.closed = function (idQuestion) {
    $scope.idQuestion = idQuestion;
    http.isReady(function (http) {
      http.post('question/update',
        {id: $scope.idQuestion, closed_id: "123"})
          .success(function () {
          console.log("Kapatılma islemi basarılı");
        });
    });
  };
*/
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

  $scope.lock = function (idQuestion) {
    sweet.question('Sorunu çözdüğümü düşünüyorum.')
      .cancel(function () {
        console.log('cancel');
      })
      .success(function () {
        $scope.status = 2;
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