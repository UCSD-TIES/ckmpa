(function() {
	$('#graphs-form').on('submit', function(e) {
		var graphLabels = [],
			graphData = [],
			$this = $(this);
			
		e.preventDefault();

		console.log($this.attr('action'));
		$.ajax({
			type: "GET",
			url: $this.attr('action'),
			data: $this.serialize(),
			dataType: "json"
		}).done(function(data) {
			console.log(data);
			$.each(data, function(i, obj) {
				graphLabels.push(i);
			    graphData.push(obj);
			});

			console.log(graphData);
			displayGraph(graphData, graphLabels);
		});
	});

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
	}
	


	// var data2 = {
	// 	labels : ["January","February","March","April","May","June","July"],
	// 	datasets : [
	// 		{
	// 			fillColor : "rgba(220,220,220,0.5)",
	// 			strokeColor : "rgba(220,220,220,1)",
	// 			data : [65,59,90,81,56,55,40]
	// 		},
	// 		{
	// 			fillColor : "rgba(151,187,205,0.5)",
	// 			strokeColor : "rgba(151,187,205,1)",
	// 			data : [28,48,40,19,96,27,100]
	// 		}
	// 	]
	// }

	// 			var ctx2 = document.getElementById("myChart2").getContext("2d");			
	// 			var myNewChart = new Chart(ctx2).Bar(data,null);	
})();
