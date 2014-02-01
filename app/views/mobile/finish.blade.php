@extends("mobile.base")

@section('title')Patrol Finished @stop

@section('header')Patrol Successfully Submitted @stop

@section('content')
	<h4 class="center-text"> Patrol More Transects in <br>{{$mpa->name}}?</h4>
	<a class="ui-btn" href="{{ URL::route('select-transect', $mpa->id) }}"> Yes</a>
	<a class="ui-btn" href="{{ URL::to('users/logout') }}"> No</a>

	<a class="ui-btn" href="{{ URL::route('select-MPA')}}"> Change MPA</a>
@stop

{{--@section('logoutBtn') @overwrite--}}
