@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Patrol @stop

@section('header')Collecting Data for<br> {{ $section->name }}@stop

@section('content')
	<div class="center-text">
		<form id="data-entry-form" name="data-entry-form" action="{{ URL::route('data-collection') }}" method="POST"
		      data-ajax="false">
			<input type="hidden" name="section_id" value="{{ $section->id }}">
			@foreach($datasheet->categories as $category)
				<fieldset data-role="collapsible">
					<legend>{{ $category->name }}</legend>
					@foreach($category->fields as $field)
						<label for="field-{{ $field->id }}">
							{{ $field->name }}
						</label>
						<div data-role="controlgroup" data-type="horizontal">
							<a class="ui-btn ui-btn-icon-notext ui-icon-minus" name="minus"
							   data-ajax="false">-1</a>
							<input type="number" name="field-{{ $field->id }}" id="{{ $field->id }}" value="0"
							       data-wrapper-class="controlgroup-textinput ui-btn" style="width:55px; text-align:center;">
							<a class="ui-btn ui-btn-icon-notext ui-icon-plus" name="plus"
							   data-ajax="false">+1</a>
						</div>
					@endforeach
				</fieldset>
			@endforeach
			<button type="submit" class="ui-btn ui-btn-d">Submit</button>
		</form>
	</div>
@stop

