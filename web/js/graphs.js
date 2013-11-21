(function() {
	$('#startDate').datepicker();
	$('#endDate').datepicker();
	$('#observationsStartDate').datepicker();
	$('#observationsEndDate').datepicker();

	var patrolCtx,
		observationsCtx;
	
	$('#patrols-form').on('submit', function(e) {
		var graphLabels = [],
			graphData = [],
			$this = $(this),
			generateBtn = $this.find('.create-graphs-btn');
		
		e.preventDefault();

		// clear alerts
		$(".alert").alert('close');

		// clear the canvas
		if (patrolCtx) {
			var canvas = document.getElementById('patrolsChart');

			// Store the current transformation matrix
			patrolCtx.save();

			// Use the identity matrix while clearing the canvas
			patrolCtx.setTransform(1, 0, 0, 1, 0, 0);
			patrolCtx.clearRect(0, 0, canvas.width, canvas.height);

			// Restore the transform
			patrolCtx.restore();
		}

		generateBtn.button('loading');

		console.log($this.attr('action'));
		$.ajax({
			type: "GET",
			url: $this.attr('action'),
			data: $this.serialize(),
			dataType: "json"
		}).done(function(data) {
			generateBtn.button('reset');

			console.log(data);

			if (data.errors) {
				createAlert('error', data.errors, $('.patrols-chart-container'));
			} else {
				if (Object.keys(data).length > 0) {
					$.each(data, function(i, obj) {
						graphLabels.push(i);
					    graphData.push(obj);
					});

					console.log(graphData);
					displayBarGraph(graphData, graphLabels);
				} else {
					createAlert('info', 
								"No patrols found with these filter options", 
								$('.patrols-chart-container'));
				}
			}			
		});
	});

	$('#observations-form').on('submit', function(e) {
		var graphLabels = [],
			pData = [],
			oData = [],
			$this = $(this),
			generateBtn = $this.find('.create-graphs-btn');
			
		e.preventDefault();

		// clear alerts
		$(".alert").alert('close');

		// clear the canvas
		if (observationsCtx) {
			var canvas = document.getElementById('observationsChart');

			// Store the current transformation matrix
			observationsCtx.save();

			// Use the identity matrix while clearing the canvas
			observationsCtx.setTransform(1, 0, 0, 1, 0, 0);
			observationsCtx.clearRect(0, 0, canvas.width, canvas.height);

			// Restore the transform
			observationsCtx.restore();
		}

		generateBtn.button('loading');

		console.log($this.attr('action'));
		$.ajax({
			type: "GET",
			url: $this.attr('action'),
			data: $this.serialize(),
			dataType: "json"
		}).done(function(data) {
			generateBtn.button('reset');

			console.log(data);

			if (data.errors) {
				createAlert('error', data.errors, $('.observations-chart-container'));
			} else {
				if (Object.keys(data).length > 0) {
					$.each(data, function(i, obj) {
						graphLabels.push(i);
					    
					    pData.push(obj.patrols);
					    oData.push(obj.observations);

					});

					displayLineGraph(graphLabels, pData, oData);
					createAlert('info', 
								'Foreground data is # of observations, Background data is # of patrols', 
								$('.observations-chart-container'));
				} else {
					createAlert('info', 
								"No patrols found with these filter options", 
								$('.observations-chart-container'));
				}
			}			
		});
	});

	var createAlert = function (alertType, message, container) {
		var alertContainer  = $(document.createElement('div'))
								.addClass('alert fade in')
								.addClass('alert-' + alertType),
			closeBtn 		= $(document.createElement('button'))
								.addClass('close')
								.attr('data-dismiss', 'alert')
								.text('x'),
			msgContainer 	= $(document.createElement('span'))
								.text(message);

		alertContainer.append(closeBtn).append(msgContainer);
		container.prepend(alertContainer);
	};

	var displayBarGraph = function(gData, gLabels) {
		var data = {
				labels : gLabels,
				datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : gData
				},
			]
		}
		patrolCtx = document.getElementById("patrolsChart").getContext("2d");			
		var myNewChart = new Chart(patrolCtx).Bar(data,null);	
	};	

	var displayLineGraph = function(labels, pData, oData) {
		var data = {
				labels : labels,
				datasets : [
				{
					fillColor : "rgba(100,100,100,0.5)",
					strokeColor : "rgba(100,100,100,1)",
					pointColor : "rgba(100,100,100,1)",
					pointStrokeColor : "#fff",
					data : pData
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : oData
				},
			]
		}
		observationsCtx = document.getElementById("observationsChart").getContext("2d");			
		var observationChart = new Chart(observationsCtx).Line(data,null);	
	}
})();
