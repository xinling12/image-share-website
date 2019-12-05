<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post you own image</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo ' '. base_url(). './assets/css/style.css? '?>">
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
                echo '<a class="btn btn-outline-primary" href="'.base_url().'login">Sign in</a>';
            }
        ?> 
    </nav>
    <br>
    <hr>
    <div id="div3_chatroom">
        <h2 class="chat_title text-center">Random Chat With Strangers Anonymously</h2>
        <div id="chatroom_display"></div>
        <div id="chatroom_input" class="text-center">
            <textarea rows="10" cols="80" name="chatroom_input" id="chatroom_text_input"></textarea>
            <br>
            <div class="btn btn-success" id="chatroom_enter">Enter</div>
        </div>
    </div>
    <footer class="mt-5 text-center">
        <p>@ 2019 by Xinling</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        loadChat();
        window.setInterval(loadChat, 1000);
        function loadChat(){
            $.ajax({
			url:'<?=base_url()?>chat/chatroom_load',
			method: 'post',
			data: {},
			dataType: 'json',
			success: function(response){
                $("#chatroom_display").empty();
				var len = response.length;
                for(var i = 0; i < len; i++){
                    var insertElement = document.createElement("h4");
                    insertElement.innerHTML = response[i].name + " (" + response[i].time + ") :" + response[i].content;  
                    document.getElementById("chatroom_display").appendChild(insertElement);
                }

			}
		});
        }
        document.getElementById("chatroom_enter").onclick = function(){
		var chatcontent = document.getElementById("chatroom_text_input").value;
		$.ajax({
			url:'<?=base_url()?>chat/chatroom_enter',
			method: 'post',
			data: {chatcontent: chatcontent},
			dataType: 'json',
			success: function(response){
                $("#chatroom_display").empty();
				var len = response.length;
                for(var i = 0; i < len; i++){
                    
                    var insertElement = document.createElement("h4");
                    insertElement.innerHTML = response[i].name + " (" + response[i].time + ") :" + response[i].content;  
                    document.getElementById("chatroom_display").appendChild(insertElement);
                }

			}
		});
	}
    </script>
    <!-- <script>

    //not working
        CKEDITOR.replace( 'chatroom_text_input' );
    </script> -->
</body>
</html>