<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="myModalLabel">
    Details for Patrol on {{ $patrol->start_time->toDateString() }} by {{ $user->first_name }}
  </h4>
</div>
<div class="modal-body">
  <ul class="nav nav-tabs nav-justified" id="myTab">
    @foreach($categories as $category_name => $category)
    <li><a href="#{{str_replace(' ', '_', $category_name)}}" data-toggle="tab">{{$category_name}}</a>
    </li>
    @endforeach
  </ul>

  <div class="tab-content">
    @foreach($categories as $category_name => $category)
      <div class="tab-pane" id="{{str_replace(' ', '_', $category_name)}}">
        <div class='list-group'>
        @foreach($category as $field_name => $field)

          @if(is_array($field))
          <div class="list-group-item list-group-item-info">{{ $field_name }}</div>
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
        </div>
      </div>
    @endforeach

    <h3>Comments</h3>
    <p>
      {{ $patrol->comments or "None" }}
    </p>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
