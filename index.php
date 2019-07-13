<?php
	$connect = mysqli_connect("localhost","root","password","testing");
	$query = "SELECT * FROM tbl_employee ORDER BY id DESC";
	$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Import CSV</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="width: 900px;">
	<h3 align="center">Employee Data</h3><br>
	<form id="upload_csv" method="post" enctype="multipart/formdata">
		<div class="col-md-3">
			<label>Add More Data</label>
		</div>
		<div class="col-md-4">
			<input type="file" name="employee_file">
		</div>
		<!-- <div class="col-md-5">
			<input type="submit" class="btn btn-primary" name="upload" id="upload" value="Upload">
		</div> -->
	</form><br><br><br>
	<div class="table-responsive" id="employee_table">
		<table class="table table-bordered">
			<tr>
				<th width="5%">ID</th>
				<th width="25%">Name</th>
				<th width="40%">Address</th>
				<th width="10">Gender</th>
				<th width="20%">Designation</th>
				<th width="5%">Age</th>
			</tr>
			<?php
				while($row = mysqli_fetch_array($result))
				{
			?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['address']; ?></td>
				<td><?php echo $row['gender']; ?></td>
				<td><?php echo $row['designation']; ?></td>
				<td><?php echo $row['age']; ?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</div>
</div>
</body>
</html>

<script>
	$(document).ready(function(){
		$('#upload_csv').on('change', function(e){
			e.preventDefault();
			$.ajax({
				url:"import.php",
				method:"POST",
				data:new FormData(this),
				contentType:false,
				cache:false,
				processData:false,
				success:function(data){
					// console.log(data);
					if(data == 'Error1')
					{
						alert("Invalid File");
					}
					else if(data == 'Error2')
					{
						alert("Please Select File");
					}
					else
					{
						$('#employee_table').html(data);
					}
				}
			});
		});
	});
</script>
