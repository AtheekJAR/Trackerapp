<?php
session_start();

$user_id = $_SESSION['user'];
$dropdown = '';
$incomeSql= '';

require_once("connection.php");

// Script to handle the dropdown
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $selectedOption = $_POST["dropdown"];
  // Assign the selected option value to a PHP variable or perform any other desired logic
  $dropdown = $selectedOption;

  // Modify $sql based on the selected option and date inputs
 /* if ($dropdown === 'daily') {
    $date = $_POST['date']; // Get the selected date value from the form
    $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
    $expenseSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
  } elseif ($dropdown === 'monthly') {
    $month = $_POST['month']; // Get the selected month value from the form
    $year = $_POST['year']; // Get the selected year value from the form
    $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
    $expenseSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
  } elseif ($dropdown === 'annual') {
    $year = $_POST['year']; // Get the selected year value from the form
    $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
    $expenseSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
  } elseif ($dropdown === 'between2') {
    $fromDate = $_POST['fromDate']; // Get the 'from' date value from the form
    $toDate = $_POST['toDate']; // Get the 'to' date value from the form
    $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
    $expenseSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
  }*/

  // Return the response
  echo $dropdown;
  exit; // Add this line to stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test5</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- piechart for income and expense -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      var incomeData = google.visualization.arrayToDataTable([
        ['category', 'amount'],
        <?php
        //$incomeSql="SELECT income.amount, income_category.name FROM income JOIN income_category ON income.category_id = income_category.in_cat_id JOIN user_info ON income.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
        $incomeSql="SELECT i.amount, i.date, i.description, ic.name AS name FROM Income AS i JOIN Income_Category AS ic ON i.category_id = ic.in_cat_id WHERE i.user_info_id = $user_id AND i.date = '2023-06-14'";
        if ($dropdown === 'daily') {
          //$date = $_POST['date']; // Get the selected date value from the form
          $incomeSql="SELECT i.amount, i.date, i.description, ic.name AS name FROM Income AS i JOIN Income_Category AS ic ON i.category_id = ic.in_cat_id WHERE i.user_info_id = $user_id AND i.date = '2023-05-10'";
        }/*elseif ($dropdown === 'monthly') {
          //$month = $_POST['month']; // Get the selected month value from the form
          //$year = $_POST['year']; // Get the selected year value from the form
          $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
        } elseif ($dropdown === 'annual') {
          //$year = $_POST['year']; // Get the selected year value from the form
          $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
        } elseif ($dropdown === 'between2') {
          //$fromDate = $_POST['fromDate']; // Get the 'from' date value from the form
          //$toDate = $_POST['toDate']; // Get the 'to' date value from the form
          $incomeSql = "SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
        }*/
        $fire = mysqli_query($conn, $incomeSql);

        while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['name'] . "'," . $result['amount'] . "],";
        }
        ?>
      ]);

      var expenseData = google.visualization.arrayToDataTable([
        ['category', 'amount'],
        <?php
        //$expenseSql="SELECT expense.amount, expense_category.name FROM expense JOIN expense_category ON expense.category_id = expense_category.ex_cat_id JOIN user_info ON expense.user_info_id = user_info.user_id WHERE user_info.user_id = $user_id";
        $expenseSql="SELECT ex.amount, ex.date, ex.description, exc.name AS name FROM Expense AS ex JOIN Expense_Category AS exc ON ex.category_id = exc.ex_cat_id WHERE ex.user_info_id = $user_id AND ex.date = '2023-06-14'";
        $fire = mysqli_query($conn, $expenseSql);

        while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['name'] . "'," . $result['amount'] . "],";
        }
        ?>
      ]);

      var incomeOptions = {
        title: 'INCOME'
      };

      var expenseOptions = {
        title: 'EXPENSE'
      };

      var incomeChart = new google.visualization.PieChart(document.getElementById('incomeChart'));
      var expenseChart = new google.visualization.PieChart(document.getElementById('expenseChart'));

      incomeChart.draw(incomeData, incomeOptions);
      expenseChart.draw(expenseData, expenseOptions);
    }
  </script>
</head>
<body>

  <div class="container-fluid">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar border-right fixed-top">
      <div class="user border-bottom text-center">
        <img class="img img-fluid rounded-circle mt-3" src="img/profile.png" width="120">
        <h5 class="mt-2"><?php echo $user_id; ?></h5>
      </div>
      <div class="sidebar-sticky p-3">
        <ul class="nav flex-column">
          <li class="nav-item py-4">
            <a class="nav-link active" href="#">Dashboard</a>
          </li>
          <li class="nav-item py-4">
            <a class="nav-link" href="#">Orders</a>
          </li>
          <li class="nav-item py-4">
            <a class="nav-link" href="#">Products <?php echo $dropdown; ?></a>
          </li>
          <li class="nav-item py-4">
            <a class="nav-link" href="#">Customers</a>
          </li>
        </ul>
      </div>
    </nav>
  </div> 

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-1 ml-sm-auto px-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h3 class="h2 text-right">Dashboard</h3>
          <!-- Placeholder for displaying the result -->
        </div>
      </div>

      <div class="col-md-1 ml-sm-auto px-2 mt-3">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Date
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button class="btn"><a class="dropdown-item" href="#" data-value="daily">Daily</a></button>
            <button class="btn"><a class="dropdown-item" href="#" data-value="monthly">Monthly</a></button>
            <button class="btn"><a class="dropdown-item" href="#" data-value="annual">Annual</a></button>
            <button id="datepickerButton" class="btn"><a class="dropdown-item" href="#" data-value="between2">Between two dates</a></button>
          </div>
        </div>
      </div>

      <div id="datePickerContainer" class="col-md-4 ml-sm-auto px-2 mt-3 text-left">
        <!-- Date picker elements will be dynamically added here -->
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 px-5 py-5" id="incomeChart" style="width: 400px; height: 400px;"></div>

      <div class="col-md-6 px-5 py-5" id="expenseChart" style="width: 400px; height: 400px;"></div>
    </div>
  </div>

  <script>
    function showDatePicker(option) {
      var datePickerContainer = $('#datePickerContainer');

      // Clear any existing date picker elements
      datePickerContainer.empty();

      if (option === 'daily') {
        var datePicker = $('<input>').attr('type', 'date').attr('name', 'date');
        datePickerContainer.append(datePicker);
        $incomeSql="SELECT i.amount, i.date, i.description, ic.name AS name FROM Income AS i JOIN Income_Category AS ic ON i.category_id = ic.in_cat_id WHERE i.user_info_id = $user_id AND i.date = '2023-05-10'";
      } else if (option === 'monthly') {
        var monthPicker = $('<input>').attr('type', 'month').attr('name', 'month');
        datePickerContainer.append(monthPicker, yearPicker);
      } else if (option === 'annual') {
        var yearPicker = $('<input>').attr('type', 'number').attr('placeholder', 'Year').attr('name', 'year');
        datePickerContainer.append(yearPicker);
      } else if (option === 'between2') {
        var fromDatePicker = $('<input>').attr('type', 'date').attr('name', 'fromDate');
        var toDatepicker = $('<input>').attr('type', 'date').attr('name', 'toDate');
        datePickerContainer.append(fromDatePicker, 'To', toDatepicker);
      }
    }

    $(document).ready(function() {
      $('.dropdown-item').click(function(e) {
        e.preventDefault();
        var selectedOption = $(this).data('value');

        // Send AJAX request
        $.ajax({
          url: 'testDashboard.php',
          method: 'POST',
          data: { dropdown: selectedOption },
          success: function(response) {
            // Handle the response from the server
            $('#result').html(response);
            showDatePicker(selectedOption);
          }
        });

        $('.dropdown-toggle').dropdown('toggle');
      });
    });
  </script>
</body>
</html>
