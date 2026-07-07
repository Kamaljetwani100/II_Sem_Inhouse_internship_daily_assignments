<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>

<body>

<?php  

$name = "Kamal";

$cgpa = 7.3;

$branch = "DS";

$year = date("Y");

$month = date("M");

$prev_year = $year-1;

$next_year = $year+1;


if($month < 7){
    echo "Year $year-($year-$next_year)";
}
else{
echo "Year $prev_year - $year";
}
?>



<h1> <?= $name?> </h1>

<p> <?= $cgpa?><p>

<p> <?= $branch?><p>





</body>

</html>