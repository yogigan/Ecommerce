<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - <?php echo $judul; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font.css') ?>">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.sea.css') ?>" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/style.sea.css') ?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url('gambar/logo.png')?>">
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="<?php echo base_url('backend/Admin')?>" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Halaman&nbsp;</strong><strong>Admin</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="<?php echo base_url('gambar/user.png')?>" class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"><?php echo $this->session->userdata('nama') ?></h1>
            <p>Web Developer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li class="<?php if($this->uri->segment(2)=="Admin"){echo("active");}?>"><a href="<?php echo base_url('backend/Admin')?>">Home </a></li>
          <li class="<?php if($this->uri->segment(2)=="Upload"){echo("active");}?>"><a href="<?php echo base_url('backend/Upload')?>">Upload File </a></li>
          <li class="<?php if($this->uri->segment(2)=="Order"){echo("active");}?>"><a href="<?php echo base_url('backend/Order')?>">Order </a></li>
          <li class="<?php if($this->uri->segment(2)=="Customer"){echo("active");}?>"><a href="<?php echo base_url('backend/Customer')?>">Customer </a></li>
          <li class="<?php if($this->uri->segment(2)=="Product"){echo("active");}?>"><a href="<?php echo base_url('backend/Product')?>">Product </a></li>
          <li class="<?php if($this->uri->segment(2)=="Category"){echo("dropdown show active");}?>">
            <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">Category </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
              <li class="<?php if($this->uri->segment(3)=="1"){echo("active");}?>"><a href="<?php echo base_url('backend/Category/converse')?>">Converse</a></li>
              <li class="<?php if($this->uri->segment(3)=="2"){echo("active");}?>"><a href="<?php echo base_url('backend/Category/running')?>">Running</a></li>
              <li class="<?php if($this->uri->segment(3)=="3"){echo("active");}?>"><a href="<?php echo base_url('backend/Category/boots')?>">Boots</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url('backend/Login/logout')?>">Logout </a></li>
        </ul>
      </nav>