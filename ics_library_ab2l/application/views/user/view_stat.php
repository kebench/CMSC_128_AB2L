
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      google.load("visualization", "1", {packages:["corechart"]});

      google.setOnLoadCallback(drawChart);
      function drawChart() {
       var data = new google.visualization.DataTable();
        data.addColumn('string', 'foo');
        data.addColumn('number', 'bar');
            

        <?php
          // query MySQL and put results into array $results
          foreach ($results as $row) {
              echo "data.addRow(['{$row->title}', {$row->book_stat}]);";
          }
        ?>

        var options = {
          title: 'Book Statistics - Top 10 Most Borrowed Books'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
<div id="main-body" class="site-body">
                <div class="site-center" style="height:72vh;">
    <div class="cell body">
        <div class="cell">
                  <p class="tiny">Statistics</p>
        </div>
    </div>
    <div id="piechart" class="width-fill" style="height: 500px;"></div>
</div>
</div>