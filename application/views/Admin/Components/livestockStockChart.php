<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<div id="livestockStockChart"></div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Values for each category
		var purchase = 150;
		var reproduction = 80;
		var sale = 60;
		var death = 30;
		var stocks = 140;

		// Chart options
		var options = {
			series: [{
				name: 'Purchase',
				data: [purchase]
			}, {
				name: 'Reproduction',
				data: [reproduction]
			}, {
				name: 'Sale',
				data: [sale]
			}, {
				name: 'Death',
				data: [death]
			}, {
				name: 'Stocks',
				data: [stocks]
			}],
			chart: {
				height: 350,
				type: 'bar'
			},
			title: {
				text: 'Livestock Stock Information'
			},
			xaxis: {
				categories: ['Livestock']
			},
			plotOptions: {
				bar: {
					borderRadius: 5,
					horizontal: false,
					columnWidth: '55%'
				}
			},
			legend: {
				position: 'bottom'
			}
		};

		// Create chart
		var chart = new ApexCharts(document.querySelector("#livestockStockChart"), options);
		chart.render();
	});
</script>
