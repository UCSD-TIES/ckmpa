<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css">
  <?= stylesheet_link_tag() ?>
    <title>@yield('title', 'Volunteer Administration')</title>
</head>

<body>
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        @if(Entrust::hasRole('Admin'))
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        @endif
        <a href="{{ URL::route('index') }}" class="navbar-brand">Coastkeeper</a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-1">
        @if(Entrust::hasRole('Admin'))
          <ul class="nav navbar-nav">
            <li @if(isset($view) && $view=='volunteers' )class='active' @endif>
              <a href="{{ URL::route('admin.volunteers.index') }}">Volunteers</a>
            </li>
            <li @if(isset($view) && $view=='mpas' )class='active' @endif>
              <a href="{{ URL::route('admin.mpas.index') }}">MPAs</a>
            </li>
            <li @if(isset($view) && $view=='patrols' )class='active' @endif>
              <a href="{{ URL::route('admin.patrols.index') }}">Patrols</a>
            </li>
            <li @if(isset($view) && $view=='graphs' )class='active' @endif>
              <a href="{{ URL::route('graphs') }}">Graphs</a>
            </li>
            <li @if(isset($view) && $view=='datasheets' )class='active' @endif>
              <a href="{{ URL::route('admin.datasheets.index') }}">Datasheets</a>
            </li>
          </ul>
          <ul class='nav navbar-nav navbar-right'>
            <li><a href="{{ URL::route('logout') }}">Logout</a>
            </li>
          </ul>
        @endif
      </div>
    </div>
  </div>
  <div class="container">
    @include('layouts.notifications')
    @yield('content')
  </div>
  @section('scripts')
    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/plug-ins/e9421181788/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <?= javascript_include_tag() ?>
  @show
</body>

</html>
