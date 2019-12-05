<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post you own image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/post.css">
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
                echo '<a class="btn btn-outline-primary" href="login">Sign in</a>';
            }
        ?>

    
    </nav>
    <br>
    <hr>
    <h2>User Profile</h2>
   
    <div class="post-body">
        <label>Email: </label><?php echo $user['email']; ?>
        <br>
        <hr>
        <label>Username:</label><?php echo $user['username']; ?>
    </div>
    <?php if($this->session->userdata('id') == $user['id']): ?>
        <hr>
        <a class="btn btn-primary pull-left" href="<?php echo base_url(); ?>homepage/profile/edit/<?php echo $user['id']; ?>">Edit</a>
        <?php echo form_open('/posts/delete/'.$user['id']); ?>
            <input type="submit" value="delete" class="btn btn-danger">
        </form>
    <?php endif; ?>

</body>
</html>