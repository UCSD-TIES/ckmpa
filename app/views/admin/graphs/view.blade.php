@extends('admin/base')

@section('title')Patrol Graphs @stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<ul id="graphsTab" class="nav nav-tabs">
				<li class="active">
					<a href="#patrols" data-toggle="tab">Patrols</a>
				</li>
				<li>
					<a href="#observations" data-toggle="tab">Volunteers</a>
				</li>
			</ul>
			<div id="graphsTabContent" class="tab-content">
				<div id="patrols" class="tab-pane fade active in">
					<h1>Patrol Graphs</h1>

					<div class="row">
						<div class="col-sm-3">
							<form class="form-vertical" id="patrols-form" method="GET" action="{{ URL::route('graphs-data') }}">
								@if($datasheets)
									<div class="form-group">
										<label class="form-label" for="datasheet">DataSheet</label>

										<div class="controls">
											<select name="datasheet" id="datasheet">
												<option value="">Select a data source</option>
												@foreach($datasheets as $datasheet)
													<option value="{{ $datasheet->id }}">{{ $datasheet->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								@endif
								<div class="form-group">
									<label for="startDate" class="form-label">Start Date</label>

									<div class="controls">
										<input type="text" class='form-control' name="startDate" id="startDate">
									</div>
								</div>
								<div class="form-group">
									<label for="endDate" class="form-label">End Date</label>

									<div class="controls">
										<input type="text" class='form-control' id="endDate" name="endDate">
									</div>
								</div>
								<div>
									<button type="submit"
									        class="btn btn-primary create-graphs-btn"
									        data-loading-text="Generating...">
										Create Graph
									</button>
									<a href="{{ URL::route('graphs') }}" class="btn btn-warning">Clear</a>
								</div>
							</form>
						</div>
						<svg id="barChart"></svg>
					</div>
				</div>
				<div id="observations" class="tab-pane fade">
					<h1>Volunteer Observations</h1>

					<div class="row">
						<div class="col-sm-3">
							<form class="form-vertical" id="observations-form" method="GET"
							      action="{{ URL::route('graphs-observations') }}">
								@if($datasheets)
									<div class="form-group">
										<label class="form-label" for="datasheet">DataSheet</label>

										<div class="controls">
											<select name="datasheet" id="datasheet">
												<option value="">Select a data source</option>
												@foreach($datasheets as $datasheet)
													<option value="{{ $datasheet->id }}">{{ $datasheet->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								@endif
								<div class="form-group">
									<label for="observationsStartDate" class="form-label">Start Date</label>

									<div class="controls">
										<input type="text" class='form-control' name="startDate" id="observationsStartDate">
									</div>
								</div>
								<div class="form-group">
									<label for="observationsEndDate" class="form-label">End Date</label>

									<div class="controls">
										<input type="text" class='form-control' id="observationsEndDate" name="endDate">
									</div>
								</div>
								<div>
									<button type="submit"
									        class="btn btn-primary create-graphs-btn"
									        data-loading-text="Generating...">
										Create Graph
									</button>
									<a href="{{ URL::route('graphs') }}" class="btn btn-warning">Clear</a>
								</div>
							</form>
						</div>
						<div class="alert alert-info col-sm-9">Red Line is Number of Volunteers <br> Blue Line is Number of Observations</div>
						<svg id="lineGraph"></svg>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts')
	@parent
	<link href="{{ URL::asset('css/graph.css') }}" rel="stylesheet">
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/d3/3.4.1/d3.min.js"></script>
	<script src="{{ URL::asset('js/graphs.js') }}"></script>
@stop
