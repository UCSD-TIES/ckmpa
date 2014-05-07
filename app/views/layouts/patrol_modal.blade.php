<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="myModalLabel">
    Details for Patrol on {{ $patrol->start_time->toDateString() }} by {{ $user->first_name }}
  </h4>
</div>
<div class="modal-body">
  <ul class="list-group">
    @foreach($categories as $category_name => $category)
    <li class="list-group-item list-group-item-info">
      <h4 class="list-group-item-heading">{{ $category_name }}</h4>
    </li>
    @foreach($category as $field_name => $field)
      @if(is_array($field))
        <li class="list-group-item">{{ $field_name }}</li>
          @foreach($field as $subcategory_name => $sub)
          <li class="list-group-item">
            {{ $subcategory_name }}
            <span class="badge">{{ $sub }}</span>
          </li>
        @endforeach
      @else
        <li class="list-group-item">
          {{ $field_name }}
          <span class="badge">{{ $field }}</span>
        </li>
      @endif

    @endforeach
  @endforeach
  </ul>

  <h3>Comments</h3>
  <p>
    {{ $patrol->comments or "None" }}
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
