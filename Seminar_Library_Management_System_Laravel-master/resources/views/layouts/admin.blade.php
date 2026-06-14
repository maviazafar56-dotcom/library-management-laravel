<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Dashboard')</title>
   
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    
    <link rel="stylesheet" href="{{ asset('css/style7.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="{{ asset('css/multilevel-dropdown.css') }}">
    
    @yield('styles')
  </head>
  <body><div style="display:inline-flex; width: 100%;">
       
<nav class="sidebar">
    <div class="user-info" style="display:inline-flex;margin:10px 10px 10px 10px">
            <div class="profile" style="padding: 15px 15px 15px 45px;">
              <img src="{{ asset('image/admin.png') }}" style="width:80px; height:80px; border-radius:50%;" alt="">
            </div>
            <div class="details" style="margin-top:30px">
              <p class="user-name" style="color:; margin-left:10px; font-size:20px;font-family: 'Pacifico', cursive;" >Admin</p>
              <p class="designation" style="color:; margin-left:10px; margin-top:-15px; font-size:20px">CSE , RU</p>
            </div>
    </div>
<ul>
<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
    <a href="{{ url('admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i>  Dashboard</a>
</li>
<li class="{{ Request::is('admin/notification') ? 'active' : '' }}">
    <a href="{{ url('admin/notification') }}"><i class="fas fa-bell"></i>   Notification
    <span class="count" id="notify_number"></span>
    </a>
</li>

<li class="{{ Request::is('admin/books') || Request::is('admin/book-list/*') ? 'active' : '' }}">
    <a href="#" class="feat-btn"><i class="fas fa-book-open"></i>   Book List
        <span class="fas fa-caret-down first"></span>
    </a>
    <ul class="feat-show {{ Request::is('admin/books') || Request::is('admin/book-list/*') ? 'show' : '' }}">
        <li><a href="{{ url('admin/books') }}">All Books (Search)</a></li>
        <li><a href="{{ url('admin/book-list/programming') }}">Programming</a></li>
        <li><a href="{{ url('admin/book-list/networking') }}">Networking</a></li>
        <li><a href="{{ url('admin/book-list/database') }}">Database</a></li>
        <li><a href="{{ url('admin/book-list/electronics') }}">Electronics</a></li>
        <li><a href="{{ url('admin/book-list/software-development') }}">Software Development</a></li>
    </ul>
</li>

<li class="{{ Request::is('admin/add-book') || Request::is('admin/update-book') || Request::is('admin/remove-book') ? 'active' : '' }}">
          <a href="#" class="extra-btn"><i class="far fa-edit"></i>   Book Management
            <span class="fas fa-caret-down third"></span>
          </a>
          <ul class="extra-show {{ Request::is('admin/add-book') || Request::is('admin/update-book') || Request::is('admin/remove-book') ? 'show' : '' }}">
<li><a href="{{ url('admin/add-book') }}">Add New Book</a></li>
<li><a href="{{ url('admin/update-book') }}">Update Book</a></li>
<li><a href="{{ url('admin/remove-book') }}">Remove Book</a></li>
</ul>
</li>
<li class="{{ Request::is('admin/shelf-list') ? 'active' : '' }}"><a href="{{ url('admin/shelf-list') }}"><i class="fas fa-list-ul"></i>   Shelf List</a></li>

<li class="{{ Request::is('admin/add-shelf') || Request::is('admin/update-shelf') || Request::is('admin/remove-shelf') ? 'active' : '' }}">
          <a href="#" class="shelf-btn"><i class="far fa-edit"></i>   Shelf Management
            <span class="fas fa-caret-down fourth"></span>
          </a>
          <ul class="shelf-show {{ Request::is('admin/add-shelf') || Request::is('admin/update-shelf') || Request::is('admin/remove-shelf') ? 'show' : '' }}">
<li><a href="{{ url('admin/add-shelf') }}">Add New Shelf</a></li>
<li><a href="{{ url('admin/update-shelf') }}">Update Shelf</a></li>
<li><a href="{{ url('admin/remove-shelf') }}">Remove Shelf</a></li>
</ul>
</li>
<li class="{{ Request::is('admin/book-order') ? 'active' : '' }}"><a href="{{ url('admin/book-order') }}"><i class="fas fa-book-reader"></i>   Book Issue</a></li>
<li class="{{ Request::is('admin/book-received') ? 'active' : '' }}"><a href="{{ url('admin/book-received') }}"><i class="fas fa-arrow-alt-circle-down"></i>  Book Received</a></li>
<li class="{{ Request::is('admin/student-info') ? 'active' : '' }}"><a href="{{ url('admin/student-info') }}"><i class="fas fa-user-graduate"></i>   Student Info</a></li>
<li class="{{ Request::is('admin/student-request') ? 'active' : '' }}"><a href="{{ url('admin/student-request') }}"><i class="fas fa-comments"></i>  Student Request</a></li>
<li class="{{ Request::is('admin/remove-student') ? 'active' : '' }}"><a href="{{ url('admin/remove-student') }}"><i class="fas fa-user-slash"></i>   Remove Student</a></li>

<li class="{{ Request::is('admin/edit-info') || Request::is('admin/change-password') ? 'active' : '' }}">
          <a href="#" class="serv-btn"><i class="fas fa-cog"></i>   Settings
            <span class="fas fa-caret-down second"></span>
          </a>
          <ul class="serv-show {{ Request::is('admin/edit-info') || Request::is('admin/change-password') ? 'show' : '' }}">
<li><a href="{{ url('admin/edit-info') }}">Edit Info</a></li>
<li><a href="{{ url('admin/change-password') }}">Change Password</a></li>

</ul>

</li>
<li class=""><a href="{{ url('admin/log-out') }}"><i class="fas fa-sign-out-alt"></i>   Log out</a></li>

</ul>
</nav>

    <div class="content">
        @yield('content')
    </div>
</div>

<script>
    $(document).ready( function () {
        var table = $('#dataTable').DataTable( {
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    });
</script>
<script>
      $('.feat-btn').click(function(){
        $('nav ul .feat-show').toggleClass("show5");
        $('nav ul .first').toggleClass("rotate");
      });
      $('.extra-btn').click(function(){
        $('nav ul .extra-show').toggleClass("show2");
        $('nav ul .third').toggleClass("rotate");
      });
      $('.serv-btn').click(function(){
        $('nav ul .serv-show').toggleClass("show1");
        $('nav ul .second').toggleClass("rotate");
      });
      $('.shelf-btn').click(function(){
        $('nav ul .shelf-show').toggleClass("show3");
        $('nav ul .fourth').toggleClass("rotate");
      });
      $('nav ul li').click(function(){
        $(this).addClass("active").siblings().removeClass("active");
      });
</script>
     
<script type="text/javascript">
    function loadDoc() {
        setInterval(function(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("notify_number").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "{{ Url('admin/notify/count/') }}", true);
        xhttp.send();
        },1000);
    }
    loadDoc();
</script>
  </body>
</html>
