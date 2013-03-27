<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Entrepreneurs Society');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<!-- Designed and Coded by Eduards Torba, Chris White, Levi Lucas, Jake Champion, Louis Harrison. -->
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php echo $this->Html->meta('icon'); ?>

    <!-- STYLESHEET -->
    <?php echo $this->Html->css(array('style.admin', 'redactor')); ?>

    <!-- SCRIPTS -->
    <?php echo $this->Html->script(array('jquery', 'fitvids.min', 'twitter', 'functions', 'redactor.min', 'moderniz.min')); ?>
    <!--[if lt IE 9]> <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

</head>
<body>
<div class="bar">
    <ul>
        <li class="currentMenuItem">
            <?php echo $this->Html->link('<span data-icon="&#xF162;"></span><span class="text">Home</span>', '/admin', array('escape' => false)); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<span data-icon="&#xF139;"></span><span class="text">News</span>', '/admin/blog_posts', array('escape' => false)); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<span data-icon="&#xF05B;"></span><span class="text">Events</span>', '/admin/events', array('escape' => false)); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<span data-icon="&#xF0CD;"></span><span class="text">Users</span>', '/admin/users', array('escape' => false)); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<span data-icon="&#xF0CE;"></span><span class="text">Mass Mail</span>', '/admin/mail', array('escape' => false)); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<span data-icon="&#xF04E;"></span><span class="text">Settings</span>', '/admin/settings', array('escape' => false)); ?>
        </li>
    </ul>
</div><!-- END .bar -->
<div class="mainContainer">
    <div class="contentContainer clearfix">
        <div class="section userMenu">
            <a class="logo" href="./">Entrepreneurs Society</a><a href="#"><?php echo $this->Html->image('profile_pics/user.jpg', array('alt' => 'User', 'class' => 'profilePic')); ?></a>
            <a href="#">ed torba</a> <a href="#">Sign out</a>
        </div><!-- END .section -->
        <div class="section clearfix">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
        </div><!-- END .section -->
    </div><!-- END .contentContainer -->
</div><!-- END .mainContainer -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.redactor').redactor();
    });
</script>
</body>
</html>