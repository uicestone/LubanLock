<!doctype html>
<html lang="en" ng-app="sys">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <!--[if lt IE 9]><?=$this->javascript('html5')?><![endif]-->
    <?=$this->stylesheet('css/combined')?>
    <link rel="stylesheet" href="/css/select2.css">
    <!-- <link rel="stylesheet" href="http://cdn.staticfile.org/ng-grid/2.0.7/ng-grid.css"> -->
    <!-- <link rel="stylesheet" href="http://cdn.staticfile.org/select2/3.4.1/select2.css"> -->
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
        

    
    <script type="text/javascript" src="/js/lib/jquery.js"></script>
    <script type="text/javascript" src="/js/lib/select2.js"></script>
    <script type="text/javascript" src="/js/lib/angular.js"></script>
    <script type="text/javascript" src="/js/lib/angular-ui-modal.js"></script>
    <script type="text/javascript" src="/js/lib/angular-ui-router.js"></script>
    <script type="text/javascript" src="/components/angular-ui-select2/src/select2.js"></script>

    <title><?=$this->company->sysname?></title>
    <style>
            #global-search{
                margin:8px 48px;
                float:left;
                position:relative;
            }
            #global-search .icon-angle-down{
                z-index: 5;
                position: absolute;
                right: 68px;
                top: 0;
                padding: 8px;
                cursor: pointer;
                color: #666;
                font-size:14px;
            }
            #global-search .span4{
                position: absolute;
                z-index: 10;
                padding: 7px;
                width: 469px;
            }

            #advanced-search{
                background-color: #fff;
                padding: 17px;
                position: absolute;
                z-index: 5;
                left: 0;
                width: 449px;
                border: 1px solid #ddd;
                top: 29px;
                box-shadow:0 2px 3px #ccc;
            }
            #advanced-search .input-xlarge{
                width:435px;
                margin-bottom:10px;
            }
            #advanced-search .icon-remove{
                cursor: pointer;
                font-size: 14px;
                color: #999;
                position: absolute;
                top: 8px;
                right: 8px;
            }
            #advanced-search .btn-container{
                text-align: right;
            }
            #advanced-search .btn-info{
                border-radius: 0;
            }
        
            .page-content .list-meta .icon-plus{
                float:left;
            }

            .page-content .list-meta{
                margin-bottom:10px;
            }

            .page-content .list-meta .paging{
                text-align: right;
            }
            .page-content .list-meta .count{
                margin-right: 10px;
            }
            .page-content .list-meta .count .num{
                font-weight:700;

            }
            
            .table{
                table-layout: fixed;
            }
            .table tr{
               -moz-user-select: none;
               -khtml-user-select: none;
               -webkit-user-select: none;
               -ms-user-select: none;
               user-select: none;
            }
            .table td{
                overflow: hidden;
            }

            .table .editing{
                border:1px solid #39d;
            }

            .table .icon-plus,
            .table .icon-trash{
                font-size:16px;
                cursor: pointer;
            }
    
            .table .icon-trash{
                /*color:#b74635;*/
                color:#666;
            }

            .table-title .icon-plus,.table .icon-plus{
                color:#629b58;
                font-size:16px;
                cursor: pointer;
            }
            .table-title .icon-plus{
                margin-left: 15px;
            }
            .table .grid-content{
                min-height:20px;
                line-height:20px;
            }

            .table .grid-edting{
                height:100%;
                width:100%;
                margin:0;
                border:0;
                padding:0;
            }
            .table .select2-container{
                width:100%;
            }
            .save-object{
                position: absolute;
                right:20px;
            }
    </style>
</head>
<body>