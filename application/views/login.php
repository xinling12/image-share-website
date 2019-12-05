

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ImageSharing</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ' '. base_url(). '/assets/css/post.css '?>">
</head>
<body>

    <nav class="px-4 py-3 bg-grey">
        <a class="btn btn-outline-dark" href="homepage">Homepage</a>
    </nav>

    <header class="my-5 text-center">
        <h1 class="mx-3">Image Sharing Website</h1>
    </header>

    <main class="container text-center">
        <div class="row d-flex justify-content-center ">
            <div class="loginform col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <?php
                if($this->session->flashdata('message')){
                    echo '
                    <div class="alert alert-success">
                        '.$this->session->flashdata("message").'
                        <div>
                    ';
                }

                if (isset($_POST["email"]) && isset($_POST["password"])) {

                    if (isset($_POST["remember"])) {
                        setcookie("email", $_POST["email"], time() + 60*60*24, "/");
                        $_COOKIE["email"] = $_POST["email"];
                    } else {
                        setcookie("email", null, -1, "/");
                    }
                }
                ?>
                <form id="form-login" class="mx-4" action="<?php echo base_url();?>login/validation" method="POST">
                    <h2 class="mb-">Please sign in</h2>
                    <input type="email" name="email" placeholder="Email address" class="form-control mt-3 mb-1" 
                    value="<?php echo set_value('email'); ?>" >
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                    <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                    <input type="checkbox" id="remember" name="remember" 
                        <?php if (isset($_COOKIE["email"])): echo "checked"; endif ?>
                    class="mb-4">
                    <label for="remember">Remember my email</label>
                    <button type="submit" name="login" value="Login" class="btn btn-primary btn-lg btn-block">Sign in</button>

                </form>
                <hr>
                <p>Don't have an account?</p>
                <a href="register"><button type="button"class="btn btn-primary btn-lg btn-block">Register</button></a>
            </div>
            
            
        </div>
    </main>

    <footer class="mt-5 text-center">
        <p>@ 2019 by Xinling</p>
    </footer>
        
</body>
</html>