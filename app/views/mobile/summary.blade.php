@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Patrol @stop

@section('header')Confirmation for {{$transect->name}} @stop

@section('content')

<ul data-role="listview">
	@for($i = 0; $i < count($inputs); $i++)
	    <li>{{ str_replace('_', ' ', $keys[$i]) }} 
	    	<span class="ui-li-count">
	    		{{$inputs[$keys[$i]]}}
	    	</span>
	    </li>
	@endfor
</ul>

<br><br>
<div class="center-text">
	<form action="{{ URL::route('data-collection') }}" data-ajax='false' method="POST">
	    <label for="comments">Comments:</label>
	    <textarea name="comments" id="comments" rows=6></textarea>
	    <input type='hidden' name='transect_id' value='{{$transect->id}}'>
	    @for($i = 0; $i < count($inputs); $i++)
	    	<input type='hidden' name='{{$keys[$i]}}' value='{{$inputs[$keys[$i]]}}'>
	    @endfor
	    <button type="submit" class="ui-btn ui-btn-a">Submit Patrol</button>
	</form>
</div>
@stop