<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seminar Library Management System - Admin Signup</title>
    <link rel="stylesheet" href="{{ asset('css/style4.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
</head>
<body>
</head>
<body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script><a href="{{ url('/') }}" class="btn btn-danger" style="margin-left:1140px; margin-top:14px;">Go to User Panel</a>

<form method="post" action="{{ url('/admin/sign-up/process') }}" enctype="multipart/form-data">

    @csrf 
    
    <div id="wrapper">
        @include('includes.alerts')
        
        <div class="login">
            <div class="logo"> 
                <img src="image/librarylogo.png" alt="">
            </div>
            <div class="loginBox">
                
                <strong><i class=""></i>Full Name</strong><br>
                <input type="text" name="name" required><br>
                <strong><i class=""></i>Username</strong><br>
                <input type="text" name="username" required><br>
                <strong><i class="fas fa-envelope"></i>Email</strong><br>
                <input type="email" name="email" required><br>
                
                <strong><i class="fa fa-key"></i>Password</strong><br>
                <input type="password" name="password" required><br>
                <strong><i class="fa fa-key"></i>Confirm Password</strong><br>
                <input type="password" name="confirm_password" required><br>
                <input id="loginButton" type="submit"; value="Sign Up">
                </form>
            </div>
            <div class="forgottenPasswoard"> 
                <span><a href="{{ url('/admin') }}">Already have an account?</a></span>
            </div>
        </div>
        <div class="side">
    
    <h1><span style="color:#00FFFF;">Admin </span><br><span style="color:;">Registration </span> <br><span style="color:#000000;"> Portal</span> <br><span style="color:#6495ED;">System</span></h1>

</div>
    </div>
  
  
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
