<script src="<?php echo base_url(); ?>/js/charts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>/js/charts/amcharts/pie.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            var chart;
            var legend;

            var chartData = [];
			<?php
			  // query MySQL and put results into array $results
			  foreach ($results as $row) {
				  echo "chartData.push({title:'{$row->title}', value:{$row->book_stat}});";
			  }
			?>


            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.titleField = "title";
				chart.theme = "chalk";
                chart.dataProvider = chartData;
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30
				chart.percentFormatter = {
					"precision":1, "decimalSeparator":'.', "thousandsSeparator":','
				};
				chart.legend = {
					"markerType": "circle",
					"position": "left",
					"showEntries": true,
					"switchable":true,
					"position": "top",

				};
				chart.exportConfig ={
					menuItems: [{
					format: 'png'
					}]
				};

                // WRITE
                chart.write("piechart");
            });
        </script>
<div id="thisbody" class="body width-fill">
                    <div class="cell">
    <div class="cell body">
        <div class="page-header cell">
            <h1>Admin <small>Book Statistics</small></h1>
        </div>
    </div>
	<h2 style = "text-align:center;">Book Statistics - Top 10 Most Borrowed Books</h2>
    <div id="piechart" class="cell width-fill" style="height: 500px;"></div>
</div>
</div>