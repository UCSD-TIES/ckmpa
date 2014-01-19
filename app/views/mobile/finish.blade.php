@extends("mobile.base")

@section('title')Patrol Finished @stop

@section('header')Patrol Finished @stop

@section('content')
<h4 class="center-text"> Want to patrol more sections?</h4>
<a data-role="button" class="center-text" href="{{URL::route('select-section')}}"> YES</a>
@stop
