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
					"position": "right",
					"showEntries": true,
					"switchable":true,
					"position": "top"
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
<div id="main-body" class="site-body" style = "height:600px">
                <div class="site-center" style="height:72vh;">
    <div class="cell body">
        <div class="cell">
                  <p class="tiny">Statistics</p>
        </div>
    </div>
	<h2 style = "position: Center;">Book Statistics - Top 10 Most Borrowed Books</h2>
    <div id="piechart" class="width-fill" style="height: 500px;"></div>
</div>
</div>