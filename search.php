<?php

	require 'include/conn.php';
	require	'include/config.php';

    $connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection 
	$q = $_GET['q'];
	$q_arr = explode(" ", $q);
	$query="";
	foreach($q_arr as $value){
		$query .=" ( coaching_name	LIKE '%".$value."%' OR address LIKE '%".$value."%' )
or ";
	}
	$query = substr_replace($query ,"",-4);
	
	$temp_result=$connection->scn_select_all("coaching",$query);
	include 'include/header.php';
?>

<div class="jumbotron text-center mt-5">
  <h1>Here is you Search Result</h1> 
  <p>Include you loacality name institute name in search bar for better result.</p> 
  <form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <div class="input-group">
      <input type="text" class="form-control" size="50" value="<?php echo $_GET['q'] ?>" required name="q">
      <div class="input-group-btn">
        <button type="submit" class="btn btn-danger">Search</button>
      </div>
    </div>
  </form>
</div>
<div class="container mt-4">
	<div class="card card-outline-secondary">
				<div class="card-header">
                  <h3 class="mb-0">Search Result</h3>
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