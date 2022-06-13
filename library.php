<?php
	include 'include/header.php';
	require 'include/conn.php';
	require	'include/config.php';
	
	$connection = new Scn_connection($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);  //Establishing Connection
	$temp_result = $connection->scn_select_all("library");//(table_name, where_expression,distinct,orderby)
?>
<div class="container">
	<h2> Books Available</h2>
	<br>
	<div class="card-columns">
	<?php
		foreach($temp_result->result as $value){
			echo '<div class="card">
	<img class="card-img-top" src="book-thumbnail/'.$value['thumbnail'].'" alt="Card image">
    <div class="card-body text-center">
		<h4 class="card-title">'.$value['book_name'].'</h4>
<span class="badge badge-info">'.$value['author_name'].'</span> 
<span class="badge badge-dark">'.$value['year'].'</span> 
    <p class="card-text">'.$value['book_des'].'</p>
    <a href="pdf/'.$value['pdf'].'" target="_blank" class="btn btn-primary">DOWNLOAD</a>
    </div>
  </div>';
		}
	?>
</div>
</div>
<?php
	include 'include/footer.php';
?>