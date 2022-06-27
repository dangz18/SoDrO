<?php
include_once('Banner.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="GraphSugars.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <title>Document</title>
</head>
<body>
<div class="GraphSugarBackground"> 
<div class="GraphSugarContainer">
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
      nutritionFacts.sugars_100 as zahar
    FROM nutritionFacts
    JOIN products ON products.id = nutritionFacts.id_product
    GROUP BY zahar
  ");
}catch(PDOException $e){
  echo $e->getMessage();
}
  
if(is_array($query) || is_object($query)){
  foreach($query as $data)
  {
    $nume[] = $data['nume'];
    $zahar[] = $data['zahar'];
    $valori[] = $data;
  }
}

  
?>

<div class="canvaSugar">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($nume) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Sugars Graph',
      data: <?php echo json_encode($zahar) ?>,
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
  <div class="GraphBtns2">
    <button type="button" class="DownloadbtnSugar" id="download_1">Download</button>
    <button class="Energbtn" onclick="location.href='Graphs.php'" type="button">    
  <h4>Energy Graph</h4></button>
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