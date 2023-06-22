


<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST["dropdown"];
    // Assign the selected option value to a PHP variable or perform any other desired logic
    
    // Return the response
    echo $selectedOption;
    exit; // Add this line to stop further execution
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Select an option
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="#" data-value="option1">Option 1</a>
      <a class="dropdown-item" href="#" data-value="option2">Option 2</a>
      <a class="dropdown-item" href="#" data-value="option3">Option 3</a>
    </div>
  </div>
  
  <!-- Placeholder for displaying the result -->
  <div id="result"></div>



  <script>
  $(document).ready(function() {
    // Event handler for dropdown menu items
    $('.dropdown-item').click(function(e) {
      e.preventDefault();
      var selectedOption = $(this).data('value');

      // Send AJAX request
      $.ajax({
        url: 'test.php',
        method: 'POST',
        data: { dropdown: selectedOption },
        success: function(response) {
          // Handle the response from the server
          $('#result').html(response);
        }
      });

      // Close the dropdown after selecting an option
      $('.dropdown-toggle').dropdown('toggle');
    });
  });
</script>



</body>
</html>
