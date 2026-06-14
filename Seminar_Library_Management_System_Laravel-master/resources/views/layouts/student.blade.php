<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title', 'Student Dashboard')</title>
   
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
            @if(isset($student))
                @foreach($student as $row)
                <img src="{{ asset($row->Image) }}" style="width:80px; height:80px; border-radius:50%;" alt="">
            </div>
            <div class="details" style="margin-top:25px">
              <p class="user-name" style="color:; margin-left:10px; font-size:20px;font-family: 'Pacifico', cursive;" >{{ $row->Name }}</p>
                @endforeach
            @else
                <div class="profile"></div>
                <div class="details"><p>Student</p></div>
            @endif
            </div>
    </div>
<ul>
<li class="{{ Request::is('student/dashboard') ? 'active' : '' }}"><a href="{{ url('student/dashboard') }}"><i class="fas fa-tachometer-alt"></i>  Dashboard</a></li>
<li class="{{ Request::is('student/notification') ? 'active' : '' }}">
    <a href="{{ url('student/notification') }}"><i class="fas fa-bell"></i>   Notification
    <span class="count" id="student_notify_number"></span>
    </a>
</li>

<li class="{{ Request::is('student/books') || Request::is('student/book-list/*') ? 'active' : '' }}">
    <a href="#" class="feat-btn"><i class="fas fa-book-open"></i>   Book List
        <span class="fas fa-caret-down first"></span>
    </a>
    <ul class="feat-show {{ Request::is('student/books') || Request::is('student/book-list/*') ? 'show' : '' }}">
        <li><a href="{{ url('student/books') }}">All Books (Search)</a></li>
        <li><a href="{{ url('student/book-list/programming') }}">Programming</a></li>
        <li><a href="{{ url('student/book-list/networking') }}">Networking</a></li>
        <li><a href="{{ url('student/book-list/database') }}">Database</a></li>
        <li><a href="{{ url('student/book-list/electronics') }}">Electronics</a></li>
        <li><a href="{{ url('student/book-list/software-development') }}">Software Development</a></li>
    </ul>
</li>

<li class="{{ Request::is('student/shelf-list') ? 'active' : '' }}"><a href="{{ url('student/shelf-list') }}"><i class="fas fa-list-ul"></i>   Shelf List</a></li>
<li class="{{ Request::is('student/my-collection') ? 'active' : '' }}"><a href="{{ url('student/my-collection') }}"><i class="fas fa-book"></i>   My Collection</a></li>
<li class="{{ Request::is('student/my-submission') ? 'active' : '' }}"><a href="{{ url('student/my-submission') }}"><i class="fas fa-arrow-alt-circle-down"></i>  My Submission</a></li>

<li>
          <a href="#" class="serv-btn"><i class="fas fa-cog"></i>   Settings
            <span class="fas fa-caret-down second"></span>
          </a>
          <ul class="serv-show {{ Request::is('student/edit-info') || Request::is('student/change-password') ? 'show' : '' }}">
<li><a href="{{ url('student/edit-info') }}">Edit Info</a></li>
<li><a href="{{ url('student/change-password') }}">Change Password</a></li>

</ul>

</li>
<li class=""><a href="{{ url('student/log-out') }}"><i class="fas fa-sign-out-alt"></i>   Log out</a></li>

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
            document.getElementById("student_notify_number").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "{{ Url('student/notify/count/') }}", true);
        xhttp.send();
        },1000);
    }
    loadDoc();
</script>
  </body>
</html>
