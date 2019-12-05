<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post you own image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="./assets/css/post.css"> -->
    <link rel="stylesheet" href="<?php echo ' '. base_url(). '/assets/css/post.css '?>">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="#">Image Sharing</a>
            <!-- <button class="navbar-toggler border-5" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                &#9776;
            </button> -->
            <?php echo '<a class="btn btn-outline-primary" href="'.base_url().'homepage">Homepage</a>' ?>
        </div>
    
        <?php 
            if ($this->session->userdata('id')) {
                echo '<a class="btn btn-outline-primary" href="'.base_url().'homepage/logout">Sign out</a>',
                '<button type="button" class="btn btn-primary" data-toggle="modal" data-role="profile" 
                data-target="#exampleModal">
                Personal Profile
            </button>';
            } else {
                echo '<a class="btn btn-outline-primary" href="'.base_url().'login">Sign in</a>';
            }
        ?>

    
    </nav>
    <br>
    <hr>
    <div>
        <a class="btn btn-primary" href="<?php echo base_url(); ?>posts/create">Create A New Post</a>
    </div>
    <div class="post-display"> 
        <?php foreach($posts as $post) : ?>
        <h3> <?php echo $post['title']; ?> </h3>
        <div class="row pic-intro" style="padding:30px;">
            <div class="col-8 post-image">
                <img class="img-fluid" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>" alt="Post image">
            </div>
            <div class="col-4">
                <small class="post-date">Posted on:<?php echo $post['created_at']; ?> in <strong><?php echo $post['name']?></strong></small><br>
                <?php echo $post['body']; ?>
                <br>
                <p><a class="btn btn-info" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read more</a></p>
            </div>
        </div>
    
        <hr>
            
            <?php endforeach; ?>
    </div>
    <div class="pagination-links">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</body>
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