<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	@section('meta')
	@show

	<title>@if(!empty($title)){{$title}} | @endif{{ config('admin.title', 'Admin') }}</title>

  @section('default_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">$.widget.bridge('uibutton', $.ui.button);</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <script type="text/javascript" src="{{ asset('modules/admin/js/app.min.js') }}"></script>  @show

  @section('default_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('modules/admin/css/adminlte.min.css' )}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('modules/admin/css/skins/'.config('admin::config.skin','skin-blue').'.min.css' ) }}" />
  @show
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="{{ config('admin::config.skin', 'skin-blue') }}">

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin::dashboard') }}" class="logo">
      @section('logo')
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">L</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">LAX Admin</span>
      @show
    </a>

    @include('admin::partials.navbar')

  </header>

    @include('admin::partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$title}}
          <small>{{$description or ""}}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          @if(!empty($breadcrumbs))
            @foreach($breadcrumbs as $crumb => $link)
              <li><a href="{{ $link }}" class="@if($link == end($breadcrumbs))active @endif">{{ $crumb }}</a></li>
            @endforeach
          @endif
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        @yield('content')
      </section>
    </div><!-- /.content-wrapper -->

  @section('footer')
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.2.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>
  @show

  @include('admin::partials.controlbar')

</div><!-- ./wrapper -->

</body>
</html>