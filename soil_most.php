<?php
$y = array(trim(file_get_contents('test.txt')));
foreach ($y as $key) {
	$dataPoints = array();
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Water Capacity Measure"
	},
	axisY: {
		minimum: 0,
		maximum: 100,
		suffix: "%"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
 
function updateChart() {
	var color,deltaY, yVal;
	var dps = chart.options.data[0].dataPoints;
	for (var i = 0; i < dps.length; i++) {
		deltaY = 0;
        deltaY++;
		yVal =  Math.min(Math.max(dps[i].y, 0), 90);
		color = yVal > 75 ? "#41CF35" : yVal >= 50 ? "#FF6000" : yVal < 50 ? "#FF2500" : null;
		dps[i] = {label: "Core "+(i+1) , y: yVal, color: color};
		
	}
	chart.options.data[0].dataPoints = dps;
	chart.render();
};
updateChart();
 
setInterval(function () { updateChart() }, 1000);


window.setTimeout( function() {
  window.location.reload();
}, 10000)
 
}
</script>
</head>
<body>

<div class="navbar">
  <a href="soil_most.php">Home</a>
  <a href="#news">News</a>
  <div class="dropdown">
    <button class="dropbtn">Dropdown 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="soil_most.php">Water Lavel</a>
      <a href="soil_most.php">Soil Mosture</a>
      <a href="relay_mod.php">Pumping System</a>
    </div>
  </div> 
</div>



<form method="post">
  <br>
  <div align="left">Enter Your Higher Mosture Threshold Here:<br></div>
    <div align="left"><input type="text" name="textdata" value="<?php if(isset($_POST['filetoupload'])) echo $_POST['filetoupload']; ?>">
    <input type="submit" value="Submit" name="submit"><br></div>
</form>
<h1></h1>
<form method="post">
  <div align="left">Enter Your Lower Mosture Threshold Here:<br></div>
    <div align="left"><input type="text" name="textda" value="<?php if(isset($_POST['filetoupload'])) echo $_POST['filetoupload']; ?>">
    <input type="submit" value="Submit" name="submit"><br></div>
</form>
<?php    
if(isset($_POST['textdata']))
{
$data=$_POST['textdata'];

$fp = fopen('save.txt', 'w');

fwrite($fp, $data);
fclose($fp);
}
?>
<?php    
if(isset($_POST['textda']))
{
$data=$_POST['textda'];

$fp = fopen('save1.txt', 'w');

fwrite($fp, $data);
fclose($fp);
header('Location: relay_mod.php');
}
?>


<h1>Your Higher Mosture Threshold Here: </h1>
<?php
$k = array(trim(file_get_contents('save.txt')));
foreach ($k as $key) {
	$dataPoints = array();
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
}
foreach ($k as $value) {
  echo "<h1>",$value,"</h1>";
}?>

<h1>Your Lower Mosture Threshold Here: </h1>
<?php
$k = array(trim(file_get_contents('save1.txt')));
foreach ($k as $key) {
	$dataPoints = array();
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
     array_push($dataPoints,array("label"=> "Capacity 1", "y"=> $key));
}
foreach ($k as $value) {
  echo "<h1>",$value,"</h1>";
}?>

</body>
</html>