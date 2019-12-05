<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post you own image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/post.css">
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
                echo '<a class="btn btn-outline-primary" href="homepage">Sign out</a>',
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

    <?php echo validation_errors(); ?>
    <?php echo form_open('homepage/edit'); ?>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="title" 
        placeholder="Edit username" value="<?php echo $user['username']; ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <textarea class="form-control"  name="body" 
        placeholder="Edit Email"><?php echo $user['email']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</body>
</html>
