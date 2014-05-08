(function() {
	$('#startDate, #endDate, #observationsStartDate, #observationsEndDate').datepicker({
		autoclose: true,
		todayHighlight: true
	});


	$('#patrols-form').on('submit', function(e) {
		var graphLabels = [],
			graphData = [],
			$this = $(this),
			generateBtn = $this.find('.create-graphs-btn');

		e.preventDefault();

		// clear alerts
		$(".alert").alert('close');

		generateBtn.button('loading');

		$.ajax({
			type: "GET",
			url: $this.attr('action'),
			data: $this.serialize(),
			dataType: "json"
		}).done(function(data) {
			generateBtn.button('reset');
			console.log(data);

			if (data.errors) {
				createAlert('danger', data.errors, $('.patrols-chart-container'));
			} else {
				d3BarChart(data);
			}
		});
	});

	function d3BarChart(data) {
		d3.select('#barChart').text('')

		var data = d3.entries(data),
			margin = {top: 20, right: 30, bottom: 30, left: 20},
			max = d3.max(data, function(d) { return d.value; }),
			width = 720,
			height = 700;

		// Construct the x scale
		var x = d3.scale.linear()
			.range([0, width])
			.domain([0, d3.max(data, function(d) { return d.value; })]);

		// Construct the y scale
		var y = d3.scale.ordinal()
			.domain(data.map(function(d) {return d.key;}))
			.rangeRoundBands([2, height], .1);

		// Construct the SVG chart
		var chart = d3.select("#barChart")
			.attr("width", width + margin.left + margin.right)
			.attr("height", height + margin.top + margin.bottom)
			.append("g")
			.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		// The y axis
		var yAxis = d3.svg.axis()
			.scale(y)
			.orient("left")
			.tickSize(1)
			.tickFormat('');

		// The x axis
		var xAxis = d3.svg.axis()
			.scale(x)
			.tickSize(1)
			.orient("bottom");

		// Attach the axes
		chart.append("g")
			.attr("class", "x axis")
			.attr("transform", "translate(0," + height + ")")
			.call(xAxis);

		chart.append("g")
			.attr("class", "y axis")
			.call(yAxis);

		// Draw the vertical grid lines
		chart.selectAll("line.horizontalGrid")
			.data(x.ticks(10))
			.enter().append("line")
			.attr(
			{
				"class":"horizontalGrid",
				"x1" : function(d) { return x(d)} ,
				"x2" : function(d) { return x(d)},
				"y1" : 0,
				"y2" : height,
				"fill" : "none",
				"shape-rendering" : "crispEdges",
				"stroke" : "lightgrey",
				"stroke-width" : "1px"
			});

		// Draw the bars
		chart.selectAll("rect")
			.data(data)
			.enter().append("rect")
			.attr("x", 0)
			.attr("y", function(d) {return y(d.key)})
			.attr("height", y.rangeBand())
			.attr("width", function(d) { return x(d.value); })
			.attr("fill", "#2d578b")
			.on("mouseover", function(){d3.select(this).style("fill", "brown");})
			.on("mouseout", function(){d3.select(this).style("fill", "#2d578b");})

		// Draw the category axis labels
		chart.selectAll("text.name")
			.data(data)
			.enter().append("text")
			.attr("x", 2)
			.attr("y", function(d) {return y(d.key) + y.rangeBand()/2})
			.attr("dy", ".35em")
			.text(function(d) { return d.key; })
			.attr('fill', 'white')
			.attr("style", "font-size: 14; font-family: Helvetica, sans-serif")
			.attr('text-anchor', 'start');

		// Draw the value labels
		chart.selectAll("text.value")
			.data(data)
			.enter().append("text")
			.attr("x", function(d) { return x(d.value) - 3; })
			.attr("y", function(d) {return y(d.key) + y.rangeBand()/2})
			.attr("dy", ".35em")
			.text(function(d) { return d.value; })
			.attr('fill', 'white')
			.attr("style", "font-size: 14; font-family: Helvetica, sans-serif")
			.attr('text-anchor', 'end');

		// Draw the title
		chart.append("text")
			.attr("x", (width / 2))
			.attr("y", 0)
			.attr("text-anchor", "middle")
			.style("font-size", "16px")
			.text("Number of Observations");

	}

	function d3LineGraph(data)
	{
		var data = d3.entries(data),
			margin = {top: 20, right: 20, bottom: 30, left: 40},
			width = 700 - margin.left - margin.right,
			height = 500 - margin.top - margin.bottom;

		// X scale
		var x = d3.time.scale()
			.range([0, width]);

		// Y scale
		var y = d3.scale.linear()
			.range([height, 0]);

		// X axis
		var xAxis = d3.svg.axis()
			.scale(x)
			.orient("bottom")
			.ticks(d3.time.months);

		// Y axis
		var yAxis = d3.svg.axis()
			.scale(y)
			.orient("left");

		// Observations line
		var Oline = d3.svg.line()
			.x(function(d) { return x(d.key); })
			.y(function(d) { return y(d.value.observations); })
			.interpolate("cardinal");

		// Volunteers/Patrols line
		var Pline = d3.svg.line()
			.x(function(d) { return x(d.key); })
			.y(function(d) { return y(d.value.patrols); })
			.interpolate("cardinal");

		// The actual svg
		var svg = d3.select("#lineGraph")
			.attr("width", width + margin.left + margin.right)
			.attr("height", height + margin.top + margin.bottom)
			.append("g")
			.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		// Parse the date
		var parseDate = d3.time.format("%d-%b-%y").parse;

		data.forEach(function(d) {
			d.key = parseDate(d.key);
			d.value.observations = +d.value.observations;
		  });

		// The domain of the scales
		x.domain(d3.extent(data, function(d) { return d.key; }));
		y.domain([0, d3.max(data, function(d) { return d.value.observations; })]);

		// Draws the axes
		svg.append("g")
			.attr("class", "x axis")
			.attr("transform", "translate(0," + height + ")")
			.call(xAxis);

		svg.append("g")
			.attr("class", "y axis")
			.call(yAxis)
			.append("text")
			.attr("transform", "rotate(-90)")
			.attr("y", 6)
			.attr("dy", ".71em")
			.style("text-anchor", "end")
			.text("Observations");

		// Draws the lines
		svg.append("path")
			.datum(data)
			.attr("d", Oline)
			.attr('stroke', 'steelblue')
			.attr('fill', 'none')
			.attr('stroke-width', '2px')

		svg.append("path")
			.datum(data)
			.attr("d", Pline)
			.attr('stroke', 'red')
			.attr('fill', 'none')
			.attr('stroke-width', '2px')

	}

	$('#observations-form').on('submit', function(e) {
		var graphLabels = [],
			pData = [],
			oData = [],
			$this = $(this),
			generateBtn = $this.find('.create-graphs-btn');

		e.preventDefault();

		// clear alerts
		$(".alert").alert('close');

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
				createAlert('danger', data.errors, $('.observations-chart-container'));
			} else {
				d3LineGraph(data);
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

})();

