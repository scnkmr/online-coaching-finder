<?php
	include 'include/header.php';
	require 'include/conn.php';
	require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection

	$temp_result = $connection->scn_select_all("coaching");//(table_name, where_expression,distinct,orderby)
?>
<div class="jumbotron text-center mt-5">
  <h1>Online Coaching Finder</h1> 
  <p>Enter you locality, district or institute name to search Institute</p> 
  <form method="get" action="search.php">
    <div class="input-group">
      <input type="text" class="form-control" size="50" placeholder="Gurugram..." required name="q">
      <div class="input-group-btn">
        <button type="submit" class="btn btn-danger">Search</button>
      </div>
    </div>
  </form>
</div>
<div class="container">
	<div class="card card-outline-secondary">
				<div class="card-header">
                  <h3 class="mb-0">Some Popular Institute</h3>
                </div>
                <div class="card-body">
	
			<?php 
				foreach($temp_result->result as $value){
					echo('
					<div class="row mb-4 mt-4"><div class="col-sm-5"><img src="image/'.$value['image_link'].'" width="100%"></div>
			<div class="col-sm-7">
			<h2> '.$value['coaching_name'].'</h2>
			<div>'.$value['des'].'</div>
			<div><b>Address:</b> '.$value['address'].'</div>
			<div><b>Starting Fee:</b> '.$value['starting_fee'].'/- Per Month</div>
			<div><b>Owner Name:</b> '.$value['owner_name'].'</div>
			<div><b>Mobile No:</b> <a href="tel:'.$value['mobile_no'].'">'.$value['mobile_no'].'</a></div>
			<div style="text-align:right;"><a href="student.php?i='.$value['id'].'"><button class="btn btn-primary">Register</button></a></div>
		</div></div><hr>	');
				}
				?>
	
	</div>
	</div>
</div>

<?php include 'include/footer.php'; ?>


