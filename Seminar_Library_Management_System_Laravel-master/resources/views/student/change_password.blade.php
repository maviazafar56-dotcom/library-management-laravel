<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


</head>
<body>
    <link rel="stylesheet" href="{{ asset('css/style5.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <link rel="stylesheet" href="css/multilevel-dropdown.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script><a href="{{ url('/admin') }}" class="btn btn-danger" style="margin-left:1140px; margin-top:14px;">Go to Admin Panel</a>
    <div class="content" style="margin-left:100px;margin-top:30px;padding:30px 30px 30px 30px;width:50%; text-align:left; border: 2px solid blue; border-radius:25px">
    @include('includes.alerts')
    <h1 style="color:blue">Change Password</h1>
<form method="post" action="{{ url('student/recover-password/process') }}">

    @csrf 
    
    <div id="wrapper">
        
        <div class="login">
            <div class="logo"> 
                <img src="image/librarylogo.png" alt="">
            </div>
            <div class="loginBox">
                
                
               
                <strong><i class="fa fa-key"></i>New Password</strong><br>
                <input type="password" name="new_password" required><br>
                <strong><i class="fa fa-key"></i>Confirm Password</strong><br>
                <input type="password" name="confirm_password" required><br>
                <input id="loginButton" type="submit"; value="Submit">
                </form>
            </div>
            
        </div>
       
    </div>
  
  
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>