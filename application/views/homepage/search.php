<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Xinling Image Sharing</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
      <link rel="stylesheet" href="<?php echo ' '. base_url(). '/assets/css/style.css '?>">
      <link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link href="http://bladephp.co/front/js/jquery-ui.css" rel="Stylesheet">
      <script src="http://bladephp.co/front/js/jquery-ui.js"></script> 
    </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
      <div class="container">
      <?php echo '<a class="navar-brand " href="'.base_url().'homepage">Image Sharing</a>' ?>

  
      
    
          <!-- <button class="navbar-toggler border-5" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
              &#9776;
          </button> -->
      </div>
      <div class="text-right">
      <?php 
          if ($this->session->userdata('id')) {
              echo '<a class="btn btn-outline-primary" href="'.base_url().'homepage/logout">Sign out</a>',
              '<button type="button" class="btn btn-primary" data-toggle="modal" data-role="profile" 
              data-target="#exampleModal">
              Personal Profile
            </button>';
          } else {
              echo '<a class="btn btn-outline-primary" href="login">Sign in</a>';
          }
      ?>

      </div>
  </nav>
  <br>
  <hr>


<div class="jumbotron">
  <div class="container">
    <h1>Welcome to photo sharing website!</h1>
    <p>Safely upload and store your photos from anywhere.Share your photos quickly and easily without having to pay a cent. Donate for the photographer if you want!</p>
      <p>Now, Start your photo journey</p>
      <?=form_open_multipart('homepage/search');?>
        <?php $search = array('name'=>'search',);?>
        <div id = "searchbutton">
        <?=form_input($search);?><input type=submit value="Search" /></p>
        </div>
        <?=form_close();?>
            <!-- Search form -->

    <!-- <div id="prefetch">
    <input type="text" name="search_box" id="search_box" class="form-control input-lg typeahead" placeholder="Search Here" />
    </div>
    
    <button class="btn btn-outline-secondary text-center" type="submit">Go</button> -->
      </div>
  </div>
  <?php
  if ($this->session->userdata('id')){ ?>
  <!-- /container -->
  <div class="container">
    <!-- Example row of columns -->
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Upload Image</h5>
              <p class="card-text">Upload your own images through this link</p>
              <?php echo '<a class="btn btn-primary" href="'.base_url().'posts">Upload</a>' ?>
              
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Find Photo Spots</h5>
              <p class="card-text">Find your the nearest photography locations around you, and plan your trip today!</p>
              <?php echo '<a class="btn btn-primary" href="'.base_url().'location">Go</a>' ?>
            </div>
          </div>
        </div>
    <hr>
  </div> <?php } ?>


  <div class="gallery">
          <?php foreach($query as $post) : ?>
          <div class="mb-3 pics" id="uploaded_image">
          <a class="btn btn-default" href="<?php echo site_url('/posts/'.$post['slug']); ?>"><img class="img-fluid" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>" alt="Post image"></a>
                
          </div>
          <?php endforeach; ?>
          </div>
     </div>
    <div class="pagination-links">
        <?php echo $this->pagination->create_links(); ?>
    </div>
  </div>
  <hr>
  <footer class="text-center">
      <p>&copy; WIS Website Xinling_XU 2019</p>
  </footer>
  
          
  </body>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
  window.onbeforeunload = function () {
    var scrollPos;
    if (typeof window.pageYOffset != 'undefined') {
        scrollPos = window.pageYOffset;
    }
    else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
        scrollPos = document.documentElement.scrollTop;
    }
    else if (typeof document.body != 'undefined') {
        scrollPos = document.body.scrollTop;
    }
    document.cookie = "scrollTop=" + scrollPos; //store scroll postion inside cookies
}
 
window.onload = function () {
    if (document.cookie.match(/scrollTop=([^;]+)(;|$)/) != null) {
        var arr = document.cookie.match(/scrollTop=([^;]+)(;|$)/); // if cookies is not empty, then read cookies
        document.documentElement.scrollTop = parseInt(arr[1]);
        document.body.scrollTop = parseInt(arr[1]);
    }
}
  </script>
</html>