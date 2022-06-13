    <?php
		include 'include/header.php';
		require 'include/conn.php';
		require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
		//$temp = $connection->scn_create_table("CREATE TABLE coaching (    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,    coaching_name VARCHAR(30) NOT NULL,    mobile_no VARCHAR(30) NOT NULL, mobile_no_alt VARCHAR(30), starting_fee VARCHAR(30) NOT NULL, image_link VARCHAR(50) ,  des VARCHAR(500), address VARCHAR(500), owner_name VARCHAR(50), email VARCHAR(50), password VARCHAR(100) NOT NULL,    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");
			if(isset($_POST["coaching_name"], $_POST["mobile_no"],$_POST["starting_fee"],$_POST["password"],$_POST["email"])){
				$pass = test_input($_POST["password"]);
				 $pass = password_hash($pass,PASSWORD_DEFAULT);
				 $_POST["email"]=str_replace(" ","",$_POST["email"]);  
				 //$_POST["email"]=strtolower(preg_replace('/[^a-zA-Z0-9-_@\.]/','', $_POST["email"])); //validation
				 $query_result=$connection->scn_insert_record('coaching','{"coaching_name":"'.$_POST["coaching_name"].'",
					 "mobile_no":"'.$_POST["mobile_no"].'",
					 "mobile_no_alt":"'.$_POST["mobile_no_alt"].'",
					 "starting_fee":"'.$_POST["starting_fee"].'",
					 "des":"'.$_POST["des"].'",
					 "address":"'.$_POST["address"].'",
					 "owner_name":"'.$_POST["owner_name"].'",
					 "email":"'.$_POST["email"].'",
					 "password":"'.$pass.'"
					 
					}');
					
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
        <div style="margin-top:100px;"><h1> INSTITUTE REGISTRATION</h1></div>
        <br><br>
        
            <!-- form card register -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                  <h3 class="mb-0">Sign Up</h3>
                </div>
                <div class="card-body">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="form-group">
                      <label for="inputName">COACHING NAME*</label> 
                                          <input class="form-control" id="inputName" placeholder="COACHING Full NAME" name="coaching_name" required type="text">
                    </div>

                    <div class="form-group">
                        <label for="inputName"> MOBILE NUMBER*</label> 
                                            <input class="form-control" id="inputName" placeholder="MOBILE NUMBER" name="mobile_no" required type="text">
                      </div>
                      <div class="form-group">
                        <label for="inputName"> ALTERNATE MOBILE NUMBER</label> 
                                            <input class="form-control" id="inputName" placeholder="ALTERNATE MOBILE NUMBER" name="mobile_no_alt" type="text">
                      </div>
                      
                      <div class="form-group">
                        <label for="inputName">DESCRIPTION</label> 
                                            <textarea class="form-control" name="des" placeholder="Enter Institute Description"></textarea>
                      </div>

                    <div class="form-group">
                      <label for="inputEmail3">Email*</label> 
                                          <input class="form-control" id="inputEmail3" placeholder="Email" name="email" required="" type="email">
                    </div>
                    <div class="form-group">
                      <label for="comment">ADDRESS</label>
                      <textarea class="form-control" name="address" rows="5" id="comment"></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputPassword3">OWNER NAME</label> 
                                          <input class="form-control" id="inputPassword3" placeholder="owmer name" name="owner_name" required="" type="text"> 
                                          
                    </div>
                    <div class="form-group">
                      <label>Starting Fee*</label> 
                                          <input class="form-control" placeholder="700/- per month" name="starting_fee" required="" type="text">
                    </div>
					<div class="form-group">
                        <label for="inputName"> PASSWORD*</label> 
                                            <input class="form-control" id="inputName" placeholder="password" type="password" required name="password">
											<small class="form-text text-muted" id="passwordHelpBlock">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small>
                      </div>
                    <div class="form-group">
                      <button class="btn btn-success btn-lg float-right" type="submit">Register</button>
                    </div>
                  </form>
                </div>
              </div><!-- /form card register -->
      </div>
<?php
include 'include/footer.php';
?>