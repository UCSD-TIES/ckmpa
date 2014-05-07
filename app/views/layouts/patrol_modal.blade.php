<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="myModalLabel">
    Details for Patrol on {{ $patrol->start_time->toDateString() }} by {{ $user->first_name }}
  </h4>
</div>
<div class="modal-body">
  <ul class="list-group">
    @foreach($fields as $field)
    <li class="list-group-item">{{$field['name']}}
      @foreach($field['tallies'] as $tally)
      <span class="badge">{{ $tally->tally }}</span>
      @endforeach
    </li>
    @endforeach
  </ul>
  <h4>Comments</h4>
  <p>
    {{ $patrol->comments or "None" }}
  </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
