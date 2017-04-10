'use strict';

angular.module('blankonConfig', [])
  .factory('settings', ['$rootScope', function ($rootScope) {
    var settings = {
        baseURL                 : '',
        pluginPath              : '/assets/global/plugins/bower_components',
        pluginCommercialPath    : '/assets/commercial/plugins',
        globalImagePath         : '/assets/global/img',
        adminImagePath          : '/assets/admin/img',
        cssPath                 : '/assets/admin/css',
        dataPath                : '/data'
      };
    $rootScope.settings = settings;
    return settings;
  }])

  // Configuration angular loading bar
  .config(function (cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })

  // Configuration event, debug and cache
  .config(['$ocLazyLoadProvider', function ($ocLazyLoadProvider) {
    $ocLazyLoadProvider.config({
      events: true,
      debug: false,
      cache: false,
      cssFilesInsertBefore: 'ng_load_plugins_before',
      modules: [
        {
          name: 'ticketApp.core.demo',
          files: ['js/modules/core/demo.js']
        }
      ]
    });
  }])

  .config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('dashboard');

    $stateProvider
      .state('signin', {
        url: '/sign-in',
        templateUrl: 'views/sign/sign-in.html',
        data: {
          pageTitle: 'GİRİŞ'
        },
        controller: 'SigninCtrl',
        resolve: {
          deps: ['$ocLazyLoad', 'settings', function ($ocLazyLoad, settings) {
            var cssPath = settings.cssPath, // Create variable css path
              pluginPath = settings.pluginPath; // Create variable plugin path

            // you can lazy load files for an existing module
            return $ocLazyLoad.load(
              [
                {
                  insertBefore: '#load_css_before',
                  files: [
                    cssPath + '/pages/sign.css'
                  ]
                },
                {
                  files: [
                    pluginPath + '/jquery-validation/dist/jquery.validate.min.js'
                  ]
                },
                {
                  name: 'ticketApp.account.signin',
                  files: [
                    'js/modules/sign/signin.js'
                  ]
                },
                {
                  name: 'ticketApp.animate',
                  files: [
                    'js/modules/animate.js'
                  ]
                }
              ]
            );
          }]
        }
      })

      .state('dashboard', {
        url: '/dashboard',
        templateUrl: 'views/dashboard.html',
        data: {
          pageTitle: 'Anasayfa',
          pageHeader: {
            icon: 'fa fa-home',
            title: 'Anasayfa',
            subtitle: 'Polisoft Ticket'
          }
        },
        controller: 'DashboardCtrl',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load( // you can lazy load files for an existing module
              [
                {
                  name: 'ticketApp',
                  files: [
                    'js/modules/dashboard.js'
                  ]
                }
              ]
            );
          }]
        }
      })

      .state('ticket', {
        url: '/ticket',
        templateUrl: 'views/mail/ticket/index.html',
        data: {
          pageTitle: 'Soru',
          pageHeader: {
            icon: 'fa fa-comments',
            title: 'Soru',
            subtitle: 'Yeni Soru'
          },
          breadcrumbs: [
            {title: 'Soru'}, {title: 'Yeni'}
          ]
        },
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load( // you can lazy load files for an existing module
              [
                {
                  name: 'ticketApp.Mail.Ticket',
                  files: [
                    'js/modules/mail/ticket/controllers.js'
                  ]
                }
              ]
            );
          }]
        }
      })

      .state('edit', {
        url: '/edit',
        templateUrl: 'views/mail/edit/index.html',
        data: {
          pageTitle: 'EDİT',
          pageHeader: {
            icon: 'fa fa-cogs',
            title: 'Düzenle',
            subtitle: 'Yönetici'
          },
          breadcrumbs: [
            {title: 'Destek'}, {title: 'Düzenle'}
          ]
        },
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load( // you can lazy load files for an existing module
              [
                {
                  name: 'ticketApp.Mail.Ticket',
                  files: [
                    'js/modules/mail/edit/controllers.js'
                  ]
                },
                {
                  insertBefore: '#load_css_before',
                  files: [
                    'assets/admin/css/pages/edit.css'

                  ]
                },
                {
                  name: 'ticketApp.animate',
                  files: [
                    'js/modules/animate.js'
                  ]
                }
              ]
            );
          }]
        }
      })

      .state('questions', {
        url: '/questions',
        templateUrl: 'views/mail/questions/index.html',
        data: {
          pageTitle: 'Sorularım',
          pageHeader: {
            icon: 'fa fa-cogs',
            title: 'Sorularım',
            subtitle: ''
          },
          breadcrumbs: [
            {title: 'Destek'}, {title: 'Düzenle'}
          ]
        },
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load( // you can lazy load files for an existing module
              [
                {
                  name: 'ticketApp.Mail.Ticket',
                  files: [
                    'js/modules/mail/questions/controllers.js'
                  ]
                },
                {
                  insertBefore: '#load_css_before',
                  files: [
                    'assets/admin/css/pages/edit.css'

                  ]
                },
                {
                  name: 'ticketApp.animate',
                  files: [
                    'js/modules/animate.js'
                  ]
                }
              ]
            );
          }]
        }
      });


  })

  .run(["$rootScope", "settings", "$state", function ($rootScope, settings, $state, $location) {
    $rootScope.$state = $state; // state to be accessed from view
    $rootScope.$location = $location; // location to be accessed from view
    $rootScope.settings = settings; // global settings to be accessed from view
  }]);
