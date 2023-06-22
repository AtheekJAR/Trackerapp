<?php
session_start();
$user_id = $_SESSION['user'];

  $con=mysqli_connect("localhost","root","","income_expense");
  if($con){
    echo "connected";
  }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['description', 'amount'],
          <?php
          $sql="SELECT income.amount, income_category.name FROM income JOIN income_category ON income.category_id = income_category.in_cat_id JOIN user_info ON income.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
          $fire =mysqli_query($con,$sql);

          while ($result=mysqli_fetch_assoc($fire)) {
            echo"['".$result['name']."',".$result['amount']."],";
          }
          ?>
        ]);

        var options = {
          title: 'My Daily ivitie'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
