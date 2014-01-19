@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Select A Section @stop

@section('header')Select A Section @stop

@section('content')

@if($sections)
<ul data-role="listview">
	@foreach( $sections as $section )
	<li><a data-ajax="false" href="{{ URL::route('get-data-collection', $section->id ) }}">{{ $section->name }}</a></li>
	@endforeach
</ul>

@else
No sections available for selection.
@endif

@stop