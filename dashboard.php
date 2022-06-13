<?php
	include 'include/header.php';
	require 'include/conn.php';
	require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
	if(!isset($_SESSION["client_id"])){
    header("Location: login.php");
    die("Login First!");
}

$temp_result = $connection->scn_select_all("coaching","id=".$_SESSION["client_id"]);//(table_name, where_expression,distinct,orderby)

if(isset($_POST["coaching_name"], $_POST["mobile_no"],$_POST["starting_fee"],$_POST["password"],$_POST["email"])){
				$pass = test_input($_POST["password"]);
				 $pass = password_hash($pass,PASSWORD_DEFAULT);
				 $_POST["email"]=str_replace(" ","",$_POST["email"]);  
				 //$_POST["email"]=strtolower(preg_replace('/[^a-zA-Z0-9-_@\.]/','', $_POST["email"])); //validation
				 $query_result=$connection->scn_update_record('coaching','{"coaching_name":"'.$_POST["coaching_name"].'",
					 "mobile_no":"'.$_POST["mobile_no"].'",
					 "mobile_no_alt":"'.$_POST["mobile_no_alt"].'",
					 "starting_fee":"'.$_POST["starting_fee"].'",
					 "des":"'.$_POST["des"].'",
					 "address":"'.$_POST["address"].'",
					 "owner_name":"'.$_POST["owner_name"].'",
					 "email":"'.$_POST["email"].'",
					 "password":"'.$pass.'"
					 
					}','id='.$_SESSION["client_id"]);
					
					if(!$query_result->error){
					 header("Location: login.php");
					 }
					 else{
							$error_div ='<br><br><div class="container"><div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong> User Already Exist!
						</div></div>';
							echo $error_div;
					 }
			}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
?>
    <div class="container">
        <div style="margin-top:100px;"></div>
        <br><br>
		<div class="card card-outline-secondary">
                <div class="card-header">
                  <h3 class="mb-0">Students Registered</h3>
                </div>
                <div class="card-body">
					<div style="width:100%">
						<table class="table">
							<thead>
								<tr>
									<th>Id</th>
									<th> Name</th>
									<th>email</th>
									<th>Mobile No.</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php
								$student_result = $connection->scn_select_all("student","coaching_id=".$_SESSION["client_id"]);//(table_name, where_expression,distinct,orderby)
								foreach($student_result->result as $svalue){
									echo '
									<tr>
									<td>'.$svalue["id"].'</td>
									<td>'.$svalue["student_name"].'</td>
									<td>'.$svalue["email"].'</td>
									<td>'.$svalue["mobile_no"].'</td>
									<td>
										<a href="tel:'.$svalue["mobile_no"].'"><button class="btn btn-primary btn-sm"><i class="fa fa-phone"></i></button></a>
										<a href="mailto:'.$svalue["email"].'"><button class="btn btn-primary btn-sm"><i class="fa fa-at"></i></button></a>
										<a href="delete-student.php?si='.$svalue["id"].'"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
									</td>
									</tr>
									';
								}
								
								?>
								</tr>
							</tbody>
						</table>
					</div>
                </div>
              </div>
			  <br><br>
            <div class="card card-outline-secondary">
                <div class="card-header">
                  <h3 class="mb-0">Institute Image</h3>
                </div>
                <div class="card-body">
					<div class="row">
						<div class="col-sm-6">
						<?php 
					if(!empty($temp_result->result[0]["image_link"])){
						echo '<img src="image/'.$temp_result->result[0]["image_link"].'" width="90%" >';
					} ?>
						</div>
						<div class="col-sm-6">
							<form action="upload-image.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<small>Upload Image Only | Square image is good for Preview</small><br><br>
							<label for="ins-img">
							<div class="btn btn-lg btn-outline-dark"><i class="fa fa-file-image"></i></div>
							<label>
							<input hidden name="image" type="file" id="ins-img" class="form-control" accept="image/*" onchange="showPreview(event);">
						</div>
						<div><img id="file-ip-1-preview" style="display:none;width:500px;"></div>
						<div class="form-group">
							<button name="uploadfile" class="btn btn-success">Update Image</button>
						</div>
					</form>
						</div>
					</div>
					
                </div>
              </div>
			  
			  <br><br>
			  
			  <!-- form card register -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                  <h3 class="mb-0">Update</h3>
                </div>
                <div class="card-body">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="form-group">
                      <label for="inputName">COACHING NAME*</label> 
                                          <input class="form-control" id="inputName" placeholder="COACHING Full NAME" value="<?php echo $temp_result->result[0]["coaching_name"] ?>" name="coaching_name" required type="text">
                    </div>

                    <div class="form-group">
                        <label for="inputName"> MOBILE NUMBER*</label> 
                                            <input class="form-control" id="inputName" placeholder="MOBILE NUMBER" value="<?php echo $temp_result->result[0]["mobile_no"] ?>" name="mobile_no" required type="text">
                      </div>
                      <div class="form-group">
                        <label for="inputName"> ALTERNATE MOBILE NUMBER</label> 
                                            <input class="form-control" id="inputName" placeholder="ALTERNATE MOBILE NUMBER" value="<?php echo $temp_result->result[0]["mobile_no_alt"] ?>" name="mobile_no_alt" type="text">
                      </div>
                      
                      <div class="form-group">
                        <label for="inputName">DESCRIPTION</label> 
                                            <textarea class="form-control" name="des" placeholder="Enter Institute Description" > <?php echo $temp_result->result[0]["des"] ?></textarea>
                      </div>

                    <div class="form-group">
                      <label for="inputEmail3">Email*</label> 
                                          <input class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo $temp_result->result[0]["email"] ?>" name="email" required="" type="email">
                    </div>
                    <div class="form-group">
                      <label for="comment">ADDRESS</label>
                      <textarea class="form-control" name="address" rows="5" id="comment" ><?php echo $temp_result->result[0]["address"] ?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputPassword3">OWNER NAME</label> 
                                          <input class="form-control" id="inputPassword3" placeholder="owmer name" name="owner_name" required="" value="<?php echo $temp_result->result[0]["owner_name"] ?>" type="text"> 
                                          
                    </div>
                    <div class="form-group">
                      <label>Starting Fee*</label> 
                                          <input class="form-control" placeholder="700/- per month" name="starting_fee" required="" value="<?php echo $temp_result->result[0]["starting_fee"] ?>" type="text">
                    </div>
					<div class="form-group">
                        <label for="inputName"> PASSWORD*</label> 
                                            <input class="form-control" id="inputName" placeholder="password" required="" type="password" name="password">
											<small class="form-text text-muted" id="passwordHelpBlock">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small>
                      </div>
                    <div class="form-group">
                      <button class="btn btn-success btn-lg float-right" type="submit">Update</button>
                    </div>
                  </form>
                </div>
              </div><!-- /form card register -->
      </div>
	  <script>
		function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
	  </script>
  <?php
  include 'include/footer.php';
  ?>