<!DOCTYPE html>
<html lang="en">
<head>
    <title>ImageSharing</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ' '. base_url(). '/assets/css/post.css '?>">
</head>
<body>

    <nav class="px-4 py-3 bg-grey">
        <?php echo '<a class="btn btn-outline-primary" href="'.base_url().'homepage">Homepage</a>' ?>
    </nav>

    <header class="my-5 text-center">
        <h1 class="mx-3">Image Sharing Website</h1>
    </header>
    
    <main class="container text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <?php
                if($this->session->flashdata('message')){
                    echo '
                    <div class="alert alert-success">
                        '.$this->session->flashdata('message').'
                        </div>
                    ';
                }
                ?>
                <form id="form-login" class="mx-4" action="<?php echo base_url();?>register/validation" method="POST">
                    <h2 class="mb-">Please Register</h2>
                    <input type="email" name="email" placeholder="Email address" class="form-control mt-3 mb-1" value="<?php echo set_value('email'); ?>" >
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                    <input type="text" name="username" placeholder="Username" class="form-control mt-3 mb-1" value="<?php echo set_value('username'); ?>" >
                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                    <input type="password" name="password" placeholder="Password" class="form-control mb-3" value="<?php echo set_value('password'); ?>" >
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                    <input type="password" name="rpassword" placeholder="Retype Password" class="form-control mb-3" value="<?php echo set_value('rpassword'); ?>" > 
                    <span class="text-danger"><?php echo form_error('rpassword'); ?></span> 
                    <input type="submit" name="register" value="Register" class="btn btn-info" />
                </form>
            </div>
            <div class="col"></div>
        </div>
    </main>

    <footer class="mt-5 text-center">
        <p>@ 2019 by Xinling</p>
    </footer>
        
</body>
</html>
