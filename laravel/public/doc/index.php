<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require_once('Documo.php') ;
$documo = new Triggerdesign\Documo();

$documo->defaultDirectory = '../../doc/';

$documo->addFile('Documentation'            , 'Documentation.md', 'docs', true);

$documo->addFile('Use cases'                , 'UseCases.md',  'usecases', true);
$documo->addFile('Use case login'           , 'UseCase_Login.md', 'uc_login', false);
$documo->addFile('Use case exchangestocks'  , 'UseCase_ExchangeStocks.md', 'uc_exchangestocks', false);
$documo->addFile('Use case change password' , 'UseCase_ChangePassword.md', 'uc_changepassword', false);
$documo->addFile('Use case manageclubs'     , 'UseCase_ManageClubs.md', 'uc_manageclubs', false);

$documo->addFile('Software Requirements Specification',  'SoftwareRequirementsSpecification.md', 'srs', true);

$documo->parseMarkdown();

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>3 Broking Club Documentation</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <link href="/css/documo/documo.jquery.css?v=<?php echo time() ?>" rel="stylesheet" />
        <link href="/css/documo/github-markdown.css" rel="stylesheet" />

        <script src="/js/documo/marked.min.js"></script>
        <script src="/js/documo/jquery.viewport.js"></script>
        <script src="/js/documo/documo.jquery.js?v=<?php echo time() ?>"></script>

        <link href="/lib/fancybox/jquery.fancybox.css?v=<?php time() ?>" rel="stylesheet" />
        <script src="/lib/fancybox/jquery.fancybox.js?v=<?php time() ?>"></script>
    </head>
    <body>
        <div class="documentation-container clearfix">
            <div id="markdown-original" style="display: none"><?php $documo->printMarkdown() ?></div>

            <div class="documentation-container-full">
                <div id="documentation-navigation" class="pull-left">
                    <span style="text-align: center;">
                        <img src="/img/logo_250.png"/>
                    </span>
                    <br/>
                    <br/>
                    <b>Documentation</b>
                    <br/>
                   <?php echo $documo->buildNavigationList() ?>
                </div>

                <div id="markdown-viewer" class="documo-viewer pull-left">
                    MarkDown Here 4
                </div>
            </div>

            <script>
                 jQuery( document ).ready(function( $ ){
                    $('#markdown-viewer').documo({'markdownContainer' : '#markdown-original'});



                     $('a.lightbox-image').fancybox({
                         theme : 'dark'
                     });

                });

            </script>

        </div>
    </body>

</html>