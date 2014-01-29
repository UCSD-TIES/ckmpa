@extends("mobile.base")

@section('title')Coastkeeper Volunteer - Patrol @stop

@section('header')Collecting Data for<br> {{ $section->name }} @stop

@section('content')
<div class="center-text">
    <form id="data-entry-form" name="data-entry-form" action="{{ URL::route('summary') }}" method="GET"
          data-ajax="false">
        <input type="hidden" name="section_id" value="{{ $section->id }}">
        @foreach($datasheet->categories as $category)
        <fieldset data-role="collapsible">
            <legend>{{ $category->name }}</legend>
            @foreach($category->fields as $field)
                @if($field->type == 'number')
                    <label for="field-{{ $field->id }}">
                        {{ $field->name }}
                    </label>
                    <div data-role="controlgroup" data-type="horizontal">
                        <a class="ui-btn ui-btn-icon-notext ui-icon-minus" name="minus"
                           data-ajax="false">-1</a>
                        <input type="number" name="{{ $field->name }}" id="{{ $field->id }}" value="0"
                               data-wrapper-class="controlgroup-textinput ui-btn" style="width:55px; text-align:center;">
                        <a class="ui-btn ui-btn-icon-notext ui-icon-plus" name="plus"
                           data-ajax="false">+1</a>
                    </div>
                @elseif($field->type == 'radio')
                    <div data-role="controlgroup" data-mini="true">
                        <div class="ui-controlgroup-label" role="heading">{{$field->name}}</div>
                        @foreach($field->options as $option)
                            <input type="radio" name="{{ $field->name }}" id="{{ $option->id }}" value="{{ $option->name }}" 
                                @if($option == $field->options->first()) checked='checked' @endif>
                            <label for="{{ $option->id }}">{{$option->name}}</label>
                        @endforeach
                    </div>
                @elseif($field->type == 'checkbox')
                    <input name="{{ $field->name }}" type="hidden" value="No" />
                    <input type="checkbox" name="{{ $field->name }}" id="{{ $field->id }}" value="Yes">
                    <label for="{{ $field->id }}">{{$field->name}}</label>
                @endif
            @endforeach
        </fieldset>
        @endforeach
        <button type="submit" class="ui-btn ui-btn-d">Confirm on Next Page</button>
    </form>
</div>
@stop

