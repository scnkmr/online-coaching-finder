<?php
		include 'include/header.php';
		require 'include/conn.php';
		require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
		//$temp = $connection->scn_create_table("CREATE TABLE library (    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,    book_name VARCHAR(50) NOT NULL,    author_name VARCHAR(30), year VARCHAR(50), book_des VARCHAR(100), thumbnail VARCHAR(50), pdf VARCHAR(50),    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");
		if(isset($_POST["bname"], $_POST["bookupload"])){
				$img_thumb = $_FILES["book_thumbnail"]["name"];
				$img_thumb_temp = $_FILES["book_thumbnail"]["tmp_name"];
				$book_pdf = $_FILES["book_attachment"]["name"];
				$book_pdf_temp = $_FILES["book_attachment"]["tmp_name"];
				$img_folder = "book-thumbnail/".$img_thumb;
				$pdf_attachment = "pdf/".$book_pdf;
				
				 $query_result=$connection->scn_insert_record('library','{"book_name":"'.$_POST["bname"].'",
					 "author_name":"'.$_POST["bauthor"].'",
					 "year":"'.$_POST["byear"].'",
					 "book_des":"'.$_POST["bdes"].'",
					"thumbnail":"'.$img_thumb.'",
					"pdf":"'.$book_pdf.'"					 
					}');
					
					if (move_uploaded_file($img_thumb_temp, $img_folder) and move_uploaded_file($book_pdf_temp, $pdf_attachment)) {

						$error_div ='<br><br><div class="container"><div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong> Files Sucessfully Uploaded!
						</div>
						</div>
						
						';
							echo $error_div;

					}else{

						$error_div ='<br><br><div class="container"><div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong> File not uploaded, Something went Wrong!
						</div></div>';
							echo $error_div;

					}
					if(!$query_result->error){
					 $error_div ='<br><br><div class="container"><div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong> Data registerd in database!
						</div>
						</div>
						
						';
							echo $error_div;
					 }
					 else{
							$error_div ='<br><br><div class="container"><div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Alert!</strong>Data not registered in database, Something went Wrong!
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
				ADD BOOK
				</div>
                <div class="card-body">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="form" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="inputName">BOOK NAME (TITLE)*</label> 
                                          <input class="form-control" id="inputName" placeholder="Full Name" type="text" required name="bname">
                    </div>

                    <div class="form-group">
                        <label for="mn">AUTHOR NAME</label> 
                                            <input class="form-control" id="mn" placeholder="Author Name" type="text" name="bauthor">
                      </div>
                      <div class="form-group">
                        <label for="email"> YEAR</label> 
                                            <input class="form-control" id="email" placeholder="2020" type="month" name="byear">
											
                      </div>
					  <div class="form-group">
						<label for="book_des">BOOK DESCRIPTION</label>
						<textarea id="book_des" class="form-control" placeholder="Enter Description of Book..." name="bdes"></textarea>
					  </div>
					  <div class="form-group">
						<label for="book_thumb">BOOK THUMBNAIL</label>
						<input type="file" name="book_thumbnail" required id="book_thumb" class="form-control" accept="image/*">
					  </div>
					  <div class="form-group">
						<label for="book_attach">UPLOAD BOOK (PDF Only)*</label>
						<input type="file" required accept="application/pdf" name="book_attachment" id="book_attach" class="form-control">
					  </div>
                      
                    <div class="form-group">
                      <button class="btn btn-success btn-lg float-right" name="bookupload" type="submit">Upload</button>
                    </div>
                  </form>
                </div>
              </div>
      </div> 
<?php
include 'include/footer.php';
?>