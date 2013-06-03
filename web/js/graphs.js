(function() {
	$('#startDate').datepicker();
	$('#endDate').datepicker();
	
	$('#graphs-form').on('submit', function(e) {
		var graphLabels = [],
			graphData = [],
			$this = $(this),
			generateBtn = $('#create-graphs-btn');
			
		e.preventDefault();

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
				createAlert('error', data.errors);
			} else {
				if (Object.keys(data).length > 0) {
					$.each(data, function(i, obj) {
						graphLabels.push(i);
					    graphData.push(obj);
					});

					console.log(graphData);
					displayGraph(graphData, graphLabels);
				} else {
					createAlert('info', "No patrols with these filter options");
				}
			}			
		});
	});

	var createAlert = function (alertType, message) {
		var container 		= $('.chart-container'),
			alertContainer  = $(document.createElement('div'))
								.addClass('alert')
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

	var displayGraph = function(gData, gLabels) {
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
		var ctx = document.getElementById("myChart").getContext("2d");			
		var myNewChart = new Chart(ctx).Bar(data,null);	
	};	
})();
