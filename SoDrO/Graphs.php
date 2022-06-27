<?php
include_once('Banner.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="Graphs.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="GraphsBackground"> 
<div class="GraphsContainer">
<?php 
require_once __DIR__. "/DataBase.php";
try{
  $db=getDbConn();
  initDb($db);
}catch(PDOException $e){
  echo $e->getMessage();
}
try{
  $query = $db->query("
    SELECT 
      products.name as nume,
      nutritionFacts.energy_100 as energie
    FROM nutritionFacts
    JOIN products ON products.id = nutritionFacts.id_product
    GROUP BY energie
  ");
}catch(PDOException $e){
  echo $e->getMessage();
}
  
if(is_array($query) || is_object($query)){
  foreach($query as $data)
  {
    $nume[] = $data['nume'];
    $energie[] = $data['energie'];
    $valori[] = $data;
    
  }
}
  
?>

<div class="canvas">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  const labels = <?php echo json_encode($nume) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Energy Graph',
      data: <?php echo json_encode($energie) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(255, 159, 64, 1',
        'rgba(255, 155, 90, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(201, 203, 207, 1)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
  
</script>
  <div class="GraphBtns">
    <button type="button" class="Downloadbtn" id="download_1">Download</button>
    <button class="Sugarsbtn" onclick="location.href='GraphSugars.php'" type="button"><h4>Sugar Graph</h4></button>
  </div>
</div>
</div>
  <script>  
  $("#download_1").click(function() {
    var json = <?php echo json_encode($valori) ?>;

    var csv = JSON2CSV(json);
    var downloadLink = document.createElement("a");
    var blob = new Blob(["\ufeff", csv]);
    var url = URL.createObjectURL(blob);
    downloadLink.href = url;
    downloadLink.download = "data.csv";

    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
});
  function JSON2CSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    var line = '';

    if ($("#labels").is(':checked')) {
        var head = array[0];
        if ($("#quote").is(':checked')) {
            for (var index in array[0]) {
                var value = index + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        } else {
            for (var index in array[0]) {
                line += index + ',';
            }
        }

        line = line.slice(0, -1);
        str += line + '\r\n';
    }

    for (var i = 0; i < array.length; i++) {
        var line = '';

        if ($("#quote").is(':checked')) {
            for (var index in array[i]) {
                var value = array[i][index] + "";
                line += '"' + value.replace(/"/g, '""') + '",';
            }
        } else {
            for (var index in array[i]) {
                line += array[i][index] + ',';
            }
        }

        line = line.slice(0, -1);
        str += line + '\r\n';
    }
    return str;
}
</script>
</body>
  
</html>