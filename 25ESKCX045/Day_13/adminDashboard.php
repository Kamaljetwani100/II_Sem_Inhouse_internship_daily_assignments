<?php

include("dashboardHeader.php");
include("db_connect.php");

$result=mysqli_query($conn,"SELECT * FROM user");

$total=mysqli_num_rows($result);

?>

<div class="container mt-4">

<div class="row">

<?php include("dashboardVertical.php"); ?>

<div class="col-md-9">

<div class="card mb-4">

<div class="card-body">

<h3>Admin Dashboard</h3>

<p>Total Registered Users</p>

<h2 class="text-primary"><?=$total;?></h2>

</div>

</div>

<div class="card">

<div class="card-body">

<h4>User List</h4>

<table class="table table-bordered table-hover">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?=$row["id"];?></td>

<td><?=$row["username"];?></td>

<td><?=$row["email"];?></td>

</tr>

<?php

}

?>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

include("footer.php");

?>