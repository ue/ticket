<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8" data-ng-app="ticketApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9" data-ng-app="ticketApp"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" data-ng-app="ticketApp"> <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Polisoft Ticket System">
        <meta name="keywords" content="polisoft, ticket, system">
        <meta name="author" content="Polisoft">
        <title data-ng-bind="$state.current.data.pageTitle + ' | BLANKON AngularJS'"></title>

        <!-- START @FAVICONS -->
        <link data-ng-href="{{settings.globalImagePath}}/ico/angularjs/apple-touch-icon-144x144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
        <link data-ng-href="{{settings.globalImagePath}}/ico/angularjs/apple-touch-icon-114x114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
        <link data-ng-href="{{settings.globalImagePath}}/ico/angularjs/apple-touch-icon-72x72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
        <link data-ng-href="{{settings.globalImagePath}}/ico/angularjs/apple-touch-icon-57x57-precomposed.png" rel="apple-touch-icon-precomposed" sizes="57x57">
        <link data-ng-href="{{settings.globalImagePath}}/ico/angularjs/apple-touch-icon.png" rel="shortcut icon" sizes="16x16">
        <!--/ END FAVICONS -->

        <!-- START @FONT STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Oswald:700,400" rel="stylesheet">
        <!--/ END FONT STYLES -->

        <!-- START @GLOBAL MANDATORY STYLES -->
        <link data-ng-href="{{settings.pluginPath}}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link data-ng-href="{{settings.pluginPath}}/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link data-ng-href="{{settings.pluginPath}}/animate.css/animate.min.css" rel="stylesheet">
        <link data-ng-href="{{settings.pluginPath}}/angular-loading-bar/build/loading-bar.min.css" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link id="load_css_before"/>
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link data-ng-href="{{settings.cssPath}}/reset.css" rel="stylesheet">
        <link data-ng-href="{{settings.cssPath}}/layout.css" rel="stylesheet">
        <link data-ng-href="{{settings.cssPath}}/components.css" rel="stylesheet">
        <link data-ng-href="{{settings.cssPath}}/plugins.css" rel="stylesheet">
        <link data-ng-href="{{settings.cssPath}}/themes/angularjs-theme.css" rel="stylesheet" id="theme">
        <link data-ng-href="{{settings.cssPath}}/custom.css" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @ANGULARJS STYLES -->
        <link data-ng-href="{{settings.cssPath}}/angular-custom.css" rel="stylesheet">
        <!-- END @ANGULARJS STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/assets/global/plugins/bower_components/html5shiv/dist/html5shiv.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/respond-minmax/dest/respond.min.js?suid=<?=time()?>"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
    </head>
    <!--/ END HEAD -->

    <body data-ng-controller="BlankonCtrl" class="page-header-fixed page-sidebar-fixed">

        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="splash text-center" ng-if="splash == true">
            <br><br><br>
            <h1 class="text-danger" style="font-weight:bold;">
                Ticket <small>Polisoft</small>
            </h1>
            <br><br>
            <i class="fa fa-spin fa-spinner fa-5x"></i>
        </div>

        <!-- START @WRAPPER -->
        <section id="wrapper">

            <!-- START @HEADER -->
            <header data-ng-include="'partials/header.html'" id="header"></header> <!-- /#header -->
            <!--/ END HEADER -->

            <aside data-sidebar-left-nicescroll data-sidebar-minimize data-ng-include="'partials/sidebar-left.html'" id="sidebar-left" class="sidebar-circle"></aside><!-- /#sidebar-left -->
            <!--/ END SIDEBAR LEFT -->

            <!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content" data-ng-include="'partials/header-content.html'"></div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div data-ui-view class="body-content animated fadeIn"></div><!-- /.body-content -->
                <!--/ End body content -->

                <!-- Start footer content -->
                <footer class="footer-content" data-ng-include="'partials/footer.html'"></footer><!-- /.footer-content -->
                <!--/ End footer content -->

            </section><!-- /#page-content -->
            <!--/ END PAGE CONTENT -->

        </section><!-- /#wrapper -->
        <!--/ END WRAPPER -->

        <!-- START @BACK TOP -->
        <div data-back-top id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div><!-- /#back-top -->
        <!--/ END BACK TOP -->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->

        <!-- START @CORE PLUGINS -->
        <script src="/assets/global/plugins/bower_components/jquery/dist/jquery.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/jquery-cookie/jquery.cookie.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/jquery-nicescroll/jquery.nicescroll.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/jquery.sparkline.min/index.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/ionsound/js/ion.sound.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/bootbox/bootbox.js?suid=<?=time()?>"></script>
        <!--/ END CORE PLUGINS -->

        <!-- BEGIN @CORE ANGULARJS PLUGINS -->
        <script src="/assets/global/plugins/bower_components/angular/angular.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/angular/angular-sanitize.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/angular/angular-touch.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/angular/angular-animate.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/oclazyload/dist/ocLazyLoad.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/angular-ui-router/release/angular-ui-router.min.js?suid=<?=time()?>"></script>
        <script src="/assets/global/plugins/bower_components/angular-loading-bar/build/loading-bar.min.js?suid=<?=time()?>"></script>
        <!-- END @CORE ANGULARJS PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="/js/app.js?suid=<?=time()?>"></script>
        <script src="/js/config.js?suid=<?=time()?>"></script>
        <script src="/js/directives.js?suid=<?=time()?>"></script>
        <script src="/js/controllers.js?suid=<?=time()?>"></script>
        <script src="/dist/angular.min.js?suid=<?=time()?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->


    </body>
    <!--/ END BODY -->

</html>