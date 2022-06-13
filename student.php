<?php
		include 'include/header.php';
		require 'include/conn.php';
		require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
		//$temp = $connection->scn_create_table("CREATE TABLE student (    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,    student_name VARCHAR(30) NOT NULL,    mobile_no VARCHAR(30) NOT NULL, email VARCHAR(50), coaching_id INT(6) NOT NULL,    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");
		if(isset($_POST["sname"], $_POST["smobile_no"])){
				 $query_result=$connection->scn_insert_record('student','{"student_name":"'.$_POST["sname"].'",
					 "mobile_no":"'.$_POST["smobile_no"].'",
					 "email":"'.$_POST["semail"].'",
					 "coaching_id":"'.$_POST["i"].'"					 
					}');
					
					if(!$query_result->error){
					 $error_div ='<br><br><div class="container"><div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong> Sucessfully registered!
						</div>
						<a href="index.php"><button class="btn btn-secondary">Go Back</button></a>
						</div>
						
						';
							echo $error_div;
					 }
					 else{
							$error_div ='<br><br><div class="container"><div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong> Something went Wrong!
						</div></div>';
							echo $error_div;
					 }
			}
?>
    <div class="container"> 
	<br>
         
            <!-- form card register -->
            <div class="card card-outline-secondary">
                <div class="card-header">
				REGISTER FOR YOUR INSTITUTE
				</div>
                <div class="card-body">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="form" role="form">
                    <div class="form-group">
                      <label for="inputName">STUDENT NAME*</label> 
                                          <input class="form-control" id="inputName" placeholder="Full Name" type="text" required name="sname">
                    </div>

                    <div class="form-group">
                        <label for="mn">STUDENT MOBILE NUMBER*</label> 
                                            <input class="form-control" id="mn" placeholder="+91 00000 00000" type="text" required name="smobile_no">
                      </div>
                      <div class="form-group">
                        <label for="email"> STUDENT EMAIL ID</label> 
                                            <input class="form-control" id="email" placeholder="example@gmail.com" type="email" name="semail">
											
                      </div>
                      
                    <div class="form-group">
                      <button class="btn btn-success btn-lg float-right" type="submit">Register</button>
                    </div>
					<input type="number" value="<?php echo $_GET["i"] ?>" hidden="" name="i">
                  </form>
                </div>
              </div>
      </div>

    
    
<?php
include 'include/footer.php';
?>