<html>

<head>

</style>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>

<script type='text/javascript'>

google.load('visualization', '1', {packages:['corechart']});

google.setOnLoadCallback(drawTable);

 

function drawTable() {

var data = new google.visualization.DataTable();
data.addColumn('string', 'Date');
data.addColumn('number', 'Amount');

data.addRows([

 

<?php

$con = mysql_connect("localhost","user_name","password");

if (!$con)

{

die('Could not connect: ' . mysql_error());

}

mysql_select_db("db_name", $con);

$result = mysql_query("SELECT gen_date as Date, sum(amnt) as Amount FROM db_name.table_name group by gen_date order by gen_date");
$output = array();

while($row = mysql_fetch_array($result)) {
    // create a temp array to hold the data
    $temp = array();
     
    // add the data
    $temp[] = '"'. $row['Date'] .'"';
	$temp[] = $row['Amount'];
    
    // implode the temp array into a comma-separated list and add to the output array
    $output[] = '[' . implode(', ', $temp) . ']';
}

// implode the output into a comma-newline separated list and echo
echo implode(",\n", $output);

mysql_close($con);
?>

 

]);

//var options = {'width':800,'is3D':true,'height':300};
var formatter = new google.visualization.NumberFormat({prefix: 'QR '});
formatter.format(data, 0); 
formatter.format(data, 1); 
var options = {
          title: 'General Expenses',
		  height: 500,
		  width: 800,
		  is3D: 'true',
		  chartArea:{left:50,top:50,width:"75%",height:"75%"}
        };
var table = new google.visualization.LineChart(document.getElementById('table_div'));

table.draw(data, options);

}

</script>

</head>

<body>

<div id='table_div'></div>

</body>

</html>