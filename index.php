<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profit </title>
    <link href="/Line_Graph_PHP/icon.png" rel="icon" type="image/png">
</head>
<body style="background: linear-gradient(90deg, #f6e2fe, #ff00bf)">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<h2>Company Profit In Past 5 years</h2>
<div class="container pt-3">
  <h2 class="text-center"><b></b></h2>
  <div>
    <canvas id="myChart" height="90"  weight="10"></canvas>
  </div>
</div>
<?php 
include ('connection.php');
//Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    $sql = "SELECT * FROM `growth`";
    $result = mysqli_query($conn, $sql);

    //Find the number of records returned
    $num = mysqli_num_rows($result);

    //Saving data from database to php arrays
    if($num> 0){
        for ($labels=array(), $ice=array(), $i=0; $row = mysqli_fetch_assoc($result); $i++) { 
            $labels[$i] = $row['Year'];
            $ice[$i] = $row['Yearly_Profit'];
        }
    }
}?>
<script>
  var passedArray = <?php echo json_encode($labels); ?>;
  var element = <?php echo json_encode($ice); ?>;
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: passedArray,
      datasets: [{
        label:'Yearly Profit',
        data: element,
        backgroundColor: "LightSeaGreen",
        barThickness: 100
      }]
    }
  })
</script>
</body>
</html>