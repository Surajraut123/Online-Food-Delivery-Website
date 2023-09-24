<?php 
   session_start();
   include('functions.php');
   include('connection.php');

   //checking if something was posted i.e. user filled the form and pressed submit button
   if($_SERVER['REQUEST_METHOD'] == 'POST')  
   {
       $user_name = $_POST['user_name'];
       $password = $_POST['password']; 

       //checking if username and password fields are not empty while pressing signup button
       if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
       {
           //read from database
           
           
           $query = "select * from users where user_name = '$user_name' limit 1";
           $result = mysqli_query($con,$query);
           if($result)
           {

                if($result && mysqli_num_rows($result)>0)
                    {
                        $user_data = mysqli_fetch_assoc($result);
                        if($user_data['password'] === $password)
                        {   
                            $_SESSION['user_name'] = $user_data['user_name'];
                            $_SESSION['user_id'] = $user_data['user_id'];
                            header('Location:indexs.php');
                            die;
                        }
                
                    }
                
                
            }   
            echo "<h4>Wrong Username/Password!</h4>";     
       }else{
           echo "<h4> Please enter username/password!</h4>";
       }
   }
    

?>


<html>
<title>Welcome to my Website</title>
<!-- <link rel="stylesheet" href="styles-login.css"> -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@600&family=Playfair+Display&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.min.css">
    <style>
    <?php include "login-style/styles-login.css"?>
    </style>
<!-- <link rel="stylesheet" href="styles-login.css"> -->

<body>
<div class="container" id="blur"> 
    <div class="home">
        <div id="content">
            <h1>Welcome To Foodies</h1>
            <p class="info tag">Online Food Ordering Website.</p>
            <div><p class="info">Order delicious food from our website cooked with atmost care.<br>
            Explore varities of food.</p>
            </div>

            <button id="getPosition">Set Position</button>
            <div id="line"></div>
            <div id="logins">
                <p>Have an account?</p>
                <a href="#" onclick="toggle()">Login</a>
            </div>    
                
        </div>
    </div>
</div>
    <div id="popup">
        <div class="login">
            <div class="login-container">
                <div class="login-header"><h2 class="header">Login</h2>
                </div>
            
                    <form method="post">
                       <div class="inputs"> <input class="nm" type="text" name="user_name" placeholder="User Name..."></div>
                       <div class="inputs">  <input class="pwd" type="password" name="password" placeholder="Password..."></div>
                       <div class="inputs">  <input class="button" type="submit" value="Login"></div>
                    </form>
                
                <div class="signup inputs">
                    <span>Don't have an account?  <a href="signup.php">Sign Up</a></span>
                </div>
            </div> 
        </div>
    
        <a href="#" onclick="toggle()">close</a>
    </div>
<script>
       document.getElementById("getPosition").addEventListener("click", getPosition);
        function getPosition() {

            var watchID = navigator.geolocation.getCurrentPosition(onSuccess, onError);

            function onSuccess(position) {
                // alert('Latitude: ' + position.coords.latitude + '\n' +
                //     'Longitude: ' + position.coords.longitude + '\n'
                // );
                
                // document.write("This is your location :")
                document.getElementById('line').innerHTML='Your location : Latitude: ' + position.coords.latitude +  "   " + 'Longitude: ' + position.coords.longitude + '\n';

                // alert('Location is Set Successfully');
                swal({
                    icon: "success",
                    title:"Location is Set Successfully",
                    });
            };

            function onError(error) {
                alert('code: ' + error.code + '\n' + 'message: ' + error.message + '\n');
            }
            
        }
        function toggle()
        {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var popup = document.getElementById('popup');
            popup.classList.toggle('active');
        }
    </script>
</body>

</html>

