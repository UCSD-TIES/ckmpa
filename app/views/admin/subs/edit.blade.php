@extends('admin/base')

@section('title') Edit Datasheet @stop

@section('content')
<div span="12">
    <h1>Edit</h1>

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Editing Subcategoriess  {{ $sub->name }}
    </div>
    {{ Form::open(array('method'=> 'PATCH', 'class'=> 'form-horizontal', 'route'=> array('admin.subs.update', $sub->id) )) }}
    <div class="control-group {% if errors->sub_name is defined %} error {% endif %}">
        <label for="datasheet_name" class="control-label">New name:</label>

        <div class="controls">
            <input type="text" name="name" id="subcategory_name" value="{{ $sub->name }}">
            @if($errors->first('subcategory_name'))
            <span class="help-inline">{{ $errors->subcategory_name }}</span>
            @endif
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ URL::route('admin.categories.show') }}" class="btn">Cancel</a>
    </div>
    </form>
</div>
@stop

