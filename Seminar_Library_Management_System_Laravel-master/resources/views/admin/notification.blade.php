@extends('layouts.admin')

@section('title', 'Notification')

@section('styles')

<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<style>
    html *{
        -webkit-font-smoothing: antialiased;
    }
    .title h3{
        font-size: 25px !important;
        margin-top: 20px;
        margin-bottom: 25px;
        line-height: 1.4em !important;
        font-weight: 300;
    }
    .alert {
        border: 0;
        border-radius: 0;
        padding: 20px 15px !important;
        line-height: 20px;
        font-weight: 300;
        color: #fff;
    }
    .alert .alert-icon {
        display: block;
        float: left;
        margin-right: 1.071rem;
    }
    .alert b {
        font-weight: 500;
        font-size: 12px;
        text-transform: uppercase;
    }
    .close {
        float: right;
        font-size: 1.5rem;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        opacity: .5;
    }
    .alert .close {
        color: #fff;
        text-shadow: none;
        opacity: .9;
    }
    .alert .close i {
        font-size: 20px;
    }
    .alert .close:hover{
        opacity: 1;
        color: #fff;
    }
    .alert.alert-info {
        background-color: #00cae3;
        color: #fff;
    }
    .alert.alert-success {
        background-color: #55b559;
        color: #fff;
    }
    .alert.alert-warning {
        background-color: #ff9e0f;
        color: #fff;
    }
    .alert.alert-danger {
        background-color: #f55145;
        color: #fff;
    }
    .alert.alert-primary {
        background-color: #a72abd;
        color: #fff;
    }
</style>
@endsection

@section('content')
    <div style="margin-top:-50px;">
    @include('includes.alerts')
    <?php $count=0; ?>
    @foreach($notification as $row)
        <?php $count++; ?>
    @endforeach

    @if($count > 0)
    <h1 style="margin-top:-50px; padding-left:380px; padding-bottom:50px">Notification</h1>
    @endif

    @foreach($notification as $row)
    <div class="alert alert-danger">
        <div class="container">
            <div class="alert-icon">
                <i class="material-icons">info_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <b>Info:</b> {{ $row->Name }} send a request...
        </div>
    </div>
    @endforeach

    @if($count==0)
      <h5 style="margin-top:100px; padding-left:360px; padding-bottom:50px;color:red;">No Notification is available !</h5>
    @endif
    </div>

    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        $('body').bootstrapMaterialDesign();
      });
    </script>
@endsection
