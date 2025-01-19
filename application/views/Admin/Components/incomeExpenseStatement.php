<div class="col-lg-6">
	<div class="card">
		<div class="card-body">
			<div id="incomeExpenseChart"></div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var income = 30000;
		var expense = 120423;

		// Chart options
		var options = {
			series: [income, expense],
			chart: {
				height: 350,
				type: 'pie'
			},
			title: {
				text: 'Income vs Expense'
			},
			labels: ['Income', 'Expense'],
			legend: {
				position: 'bottom'
			}
		};

		// Create chart
		var chart = new ApexCharts(document.querySelector("#incomeExpenseChart"), options);
		chart.render();
	});
</script>
