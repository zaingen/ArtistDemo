<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Artist</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/bootstrap.css" integrity="" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo url('/'); ?>/css/jquery-ui.css" integrity="" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>    
</head>

<body id="page-container">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                        <?php  /*
                            <li><a href="{{ url('/register') }}">Register</a></li>*/
                        ?>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php 
        /*<div id='sidebar-wrapper'>
            <ul style='position: fixed;top: 11px;background-color: #1d1d1d;' class='nav sidebar-nav'>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                            <i class='fa fa-fw fa-plus'></i>menu
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu' role='menu'>
                                <li><a href='#'>submenu</a></li>
                        </ul>
                    </li>
            </ul>
        </div>*/
     ?>
    <?php echo $__env->yieldContent('content'); ?>
    <!-- JavaScripts -->
    <script src="<?php echo url('/'); ?>/js/handlebars-latest.js" integrity="" crossorigin="anonymous"></script>
    <script src="<?php echo url('/'); ?>/js/jquery.js" integrity="" crossorigin="anonymous"></script>
    <script src="<?php echo url('/'); ?>/js/jquery-ui.js" integrity="" crossorigin="anonymous"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>    
</body>
</html>


