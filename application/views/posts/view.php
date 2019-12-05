<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post you own image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.5/css/star-rating.min.css">
    <link rel="stylesheet" href="<?php echo ' '. base_url(). '/assets/css/post.css '?>">
    <script src="http://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

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
    <h2><?php echo $post['title']; ?></h2>
    <small class="post-date">Posted on:<?php echo $post['created_at']; ?></small><br>
    <img class="img-fluid" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>" alt="Post image">
    <div class="post-body">
        <?php echo $post['body']; ?>
    </div>
    <?php if($this->session->userdata('id') == $post['user_id']): ?>
        <hr>
        <a class="btn btn-primary pull-left" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
        <?php echo form_open('/posts/delete/'.$post['id']); ?>
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <?php endif; ?>
    <hr>
    <h3 class="text-center">Comments</h3>
    <?php if($comments) : ?>
        <?php foreach($comments as $comment) : ?>
            <div class="card card-body bg-light text-center">
                <h5><?php echo $comment['body']; ?> [by <strong><?php echo $comment['name']; ?></strong>]</h5>
                <small>Posted on:<?php echo $comment['created_at']; ?></small>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-center">No Comments To Display</p>
    <?php endif; ?>
    <hr>
    <h3>Add Comment</h3>
    <?php echo validation_errors(); ?>
    <?php echo form_open('comments/create/'.$post['id']); ?>
        <div class="form-group col-8">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group col-8">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group col-10">
            <label>Body</label>
            <textarea id="editor1" name="body" class="form-control"></textarea>
        </div>
        <input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>  

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
    <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
</script>
</html>


