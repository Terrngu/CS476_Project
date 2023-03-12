<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="<?php echo base_url(); ?>assets/js/UA-90680653-2.js"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@dev2friend">
    <meta name="twitter:creator" content="@dev2friend">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dev2Friend">
    <meta name="twitter:description" content="Dev2Friend">
    <meta name="twitter:image" content="<?php base_url(); ?>assets/img/meta-logo.png"> 

    <!-- Facebook -->
    <meta property="og:url" content="https://www.dev2friend.com/">
    <meta property="og:title" content="Dev2Friend">
    <meta property="og:description" content="Dev2Friend">

    <meta property="og:image" content="<?php base_url(); ?>assets/img/meta-logo.png">
    <meta property="og:image:secure_url" content="<?php base_url(); ?>assets/img/meta-logo.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Dev2Friend">
    <meta name="author" content="Dev2Friend">

    <title><?php echo $title; ?></title>

    <!-- vendor css -->
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/spectrum-colorpicker/spectrum.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/pickerjs/picker.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/azia.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/meta-logo.png">

  </head>

  <body>

     <div class="az-header shadow-none">
      <div class="container">
        <div class="az-header-left">
            <!--<a href="<?php echo base_url(); ?>" class="az-logo">Home</a>-->
            <a href="<?php echo base_url(); ?>" class="az-logo"><img src="<?php echo base_url(); ?>assets/img/meta-jilr-logo.png" alt="logo.png"></a>
          <a href="" id="azNavShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-center">
          <input type="search" class="form-control" placeholder="Search for schedules and events...">
          <button class="btn"><i class="fas fa-search"></i></button>
        </div><!-- az-header-center -->
        <div class="az-header-right">
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="<?php echo base_url(); ?>assets/img/meta-logo.png" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="<?php echo base_url(); ?>assets/img/meta-logo.png" alt="">
                </div><!-- az-img-user -->
                <h6>System User</h6>
                <span>System Administrator</span>
              </div><!-- az-header-profile -->

              <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
              <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
              <a href="<?php echo base_url(); ?>Login/Logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->

    <div class="az-navbar az-navbar-dashboard-four">
      <div class="container">
        <ul class="nav">
          <li class="nav-label">Main Menu</li>
          <li class="nav-item active show">
            <a href="index.html" class="nav-link with-sub"><i class="typcn typcn-clipboard"></i>Main Menu</a>
            <ul class="nav-sub">
              <li class="nav-sub-item"><a href="<?php echo base_url(); ?>Members" class="nav-sub-link">Members</a></li>
              <li class="nav-sub-item"><a href="<?php echo base_url(); ?>Ministries" class="nav-sub-link">Ministries</a></li>
              <li class="nav-sub-item"><a href="<?php echo base_url(); ?>Lifegroups" class="nav-sub-link">Life Groups</a></li>
              <li class="nav-sub-item"><a href="<?php echo base_url(); ?>Calendar" class="nav-sub-link">Calendar of Activities</a></li>
            </ul>
          </li><!-- nav-item -->
          <li class="nav-item">
            <a href="index.html" class="nav-link with-sub"><i class="typcn typcn-folder"></i>Reporting</a>
            <ul class="nav-sub">
              <li class="nav-sub-item">
                <a href="<?php echo base_url(); ?>Events" class="nav-sub-link">Attendance</a>
                <a href="<?php echo base_url(); ?>Lifegroup" class="nav-sub-link">Life Group</a>
                <a href="<?php echo base_url(); ?>Finance" class="nav-sub-link">Finances</a>
              </li>
            </ul>
          </li><!-- nav-item -->

        </ul><!-- nav -->
      </div><!-- container-fluid -->
    </div><!-- az-navbar -->