<?php
	include 'include/header.php';
	require 'include/conn.php';
	require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
	
	if(isset($_POST["email"],$_POST["pass"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
    $email = test_input($_POST["email"]);
    $pass = test_input($_POST["pass"]);
    //echo $email." ".password_hash($pass,PASSWORD_DEFAULT);
    //echo var_dump($pass);
    $user_pass=$connection->scn_select_all("coaching","email='".$email."'");//(table_name, where_expression,distinct,orderby)

    if(!$user_pass->error && $email == $user_pass->result[0]["email"]){
        if(password_verify($pass, $user_pass->result[0]["password"])){
            $_SESSION["client_id"] = $user_pass->result[0]["id"];
            $_SESSION["client_fullname"] = $user_pass->result[0]["owner_name"];
            $_SESSION["client_email"] = $user_pass->result[0]["email"];
            $_SESSION["client_address"] = $user_pass->result[0]["address"];
            $_SESSION["client_mobile"] = $user_pass->result[0]["mobile_no"];
            //print_r($_SESSION);
            header("Location: dashboard.php");
        }
        else{
            $_SESSION["error_msg"] = "Wrong Password for ".$email;
        }
    }
    else{
        $_SESSION["error_msg"] = "Wrong User Name ";
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
        <div style="margin-top:100px;"><h1> INSTITUTE LOGIN</h1></div>
        <br><br>
        
            <!-- form card register -->
            <div class="card card-outline-secondary">
                
                <div class="card-body">
				
				<?php 
					if(isset($_SESSION["error_msg"])){
						print("<div class='alert alert-danger'>
  <strong>Error!</strong>".$_SESSION["error_msg"]."</div>");
					}
				?>
				
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" >
                    <div class="form-group">
                      <label for="inputName">USER NAME</label> 
                                          <input class="form-control" id="inputName" placeholder="user name" type="text" name="email">
                    </div>

                    <div class="form-group">
                        <label for="mn">PASSWORD</label> 
                                            <input class="form-control" id="mn" placeholder="password" type="password" name="pass">
                      </div>
                       <div class="form-group">
                      <button class="btn btn-success btn-lg float-right" type="submit">LOGIN</button>
                    </div>
                  </form>
                </div>
              </div>
      </div>
    
</body>
</html>