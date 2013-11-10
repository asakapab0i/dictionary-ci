<!DOCTYPE html>

<html lang="en">
  <head>
  
    <title>{page_title}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/custom.css'?>">
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col-md-6">
              <img class="custom-logo" src="<?php echo base_url() . 'assets/img/logo.png'?>">
        </div>
        <div class="col-md-6">
          <div class="custom-searchPanel pull-right">
          <span>search something or type your name..</span> 
            <form  method="get" action="http://localhost/dict/define">
            <input value="{word}" placeholder="search here" id="search" name="term" type="text" size="50" class="custom-bigFatSearch" value="" autocomplete="off"> 
            <input class=" custom-fontSize btn btn-default" id="searchbutton" type="submit" value="search">
            </form>
          </div>
        </div>
    </div>
<!-- Navigation -->
    <div class="row">

      <div class="col-md-12 custom-menu">{main_menu}</div>
      <div class="col-md-12 custom-subMenu">{sub_menu}</div>

    </div>
    <hr/>
  </div>
  
