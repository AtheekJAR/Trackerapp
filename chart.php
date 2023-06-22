<?php 
require_once("connection.php");
?>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // Create a new DataTable object
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'name');
    data.addColumn('number', 'amount');

    // Retrieve data from the server-side
    <?php
      $sql = "SELECT ic.name AS name, SUM(i.amount) AS total 
              FROM income i 
              JOIN incomecategory ic ON i.category_id = ic.id 
              GROUP BY ic.name";
      $fire = mysqli_query($con, $sql);

      while ($result = mysqli_fetch_assoc($fire)) {
        echo "data.addRow(['" . $result['name'] . "', " . $result['total'] . "]);";
      }
    ?>

    // Set chart options
    var options = {
      title: 'Income by Category',
      is3D: true,
    };

    // Create and draw the chart
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<!-- Add a div element to hold the chart -->
<div id="chart_div"></div>


