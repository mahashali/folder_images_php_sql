<?php  
include('conn.php');?>

<div class="main-content">
<div class="wrapper">
<h1>update category</h1>

<br/><br/>
<?php
//check whether the id is set or not
if(isset($_GET['id']))
{
	//get to the id and all other details

	// echo "get to data category";

	$id = $_GET['id'];
	//create sql query to get all other deail
	$sql = "SELECT * FROM imgs WHERE id=$id";
	//execute the query
	$res = mysqli_query($conn, $sql);
	//count the rows to check whether the id is valid or not
	$count = mysqli_num_rows($res);
	if($count==1)
	{
		//get all data
		$row = mysqli_fetch_assoc($res);
		$name = $row['name'];
		$image = $row['image'];
		

	}
	else
	{
		//redirect to manage category with session message
		$_SESSION['no-category-found'] = " <div class'error'>categroy not found</div>";
		header('location:manage.php');

	}

}
else{
	//redirect to mange category
	header('location:manage.php');
}

?>


<form action="" method="POST">
	<table class="tbl-30">
		<tr>
			<td>Title:</td>
			<td>
				<input type="text" name="name" value="<?php echo $name;?>" >
			</td>
		</tr>
		<tr>
			<td>Current image:</td>
			<td>
				<?php
				if ($image != "")
				 {
					// display the image
					?>
					<img src="images/<?php echo $image;?>" width='150px'>
					<?php
				}
				else{
					//display the message
					echo "<div class'error'>iamage not added.</div>";
				}



				?>
			</td>
		</tr>
			<tr>
			<td>new image:</td>
			<td>
				<input type="file" name="image" >
			</td>
		</tr>
		
				<tr>
					<td>
						<input type="hidden" name="image_name" value="<?php echo $image;?>">
						<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="submit" name="submit" value="upload" class="btn-secondary">	
					</td>
				</tr>
		
	</table>
	
</form>
<?php
if (isset($_POST['submit']))
 {
	//echo "clicked";
	//1. get all the value from our from
	$id = $_POST['id'];
	$name = $_POST['name'];
	$image = $_POST['image'];
	

	//2. update new image if selected
	
       if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name ,source path and description path
                $image = $_FILES['image']['name'];
            //upload the image only if image is selected
            if ($image != "") 
            {
              
            

                // auto the rename our image
                //get the extension of our imag (jpg, png, gif, eetc) e.g. "specialfood1.jpg"
                $ext = end(explode('.', $image));

                //rename the image
                $image = "img_".rand(000,999).'.'.$ext; // e.g. Food_category_834.jpg

                 $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "images/".$image;

                //finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
                //check whether the image is iploaded or not
                //and if the image is not uploaded then we will stop the process redirect error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class='error'>fail to upload image.</div>";
                    //redirect to add category page
                    header('location:manage.php');
                    //stop process
                    die();

                }

			//B. remove the current image
        		if($image != "")
        		{
        		$remove_path = "images/".$image;
        		$remove = unlink($remove_path);
        		if($remove==false)
        		{
        			//fail to remove image
        			$_SESSION['failed-remove'] = "<div class'success'>category update seccessfuly.</div>";
		           header('location:manage.php');
		           die(); //stop process

        		}
        		}
        		}
        		
		
		else{
			$image = $image;
		}

	}
	else{
		$image = $image;
	}
	//3. update the database
	$sql2 = "UPDATE imgs SET
	name = '$name',
	image = '$image'
	
	WHERE id=$id
	";
	//execut the query
	$res2 = mysqli_query($conn, $sql2);
	//4. redirect to mange category with message
	//chck whether executed query or not
	if($res2==true)
	{
		//categroy update
		$_SESSION['update'] = "<div class'success'>category update seccessfuly.</div>";
		header('location:manage.php');
	} 
	else
	{
		//fail to update category
		$_SESSION['update'] = "<div class'error'>fail to update category.</div>";
		header('location:manage.php');
	}



}



?>




</div>
</div>

























