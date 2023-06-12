<?php 
//include constants
include('conn.php');

 //check  whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image']))
{

	//get the value and delete
	//echo "get value and delete";
	$id = $_GET['id'];
	$image = $_GET['image'];
	//remove physical image file is available
	if($image != "");
{
	//image is available so remove it
	$path = "images/".$image;
	//remove the image
	$remove = unlink($path);
	//if fail remove image then add aand error massege and stop the process
	if($remove==false)
	{
		//set the session mesage
		$_SESSION['remove'] = "<div class='error'>failed to remove category image</div>";
		//redirect to massege category page
		header('location:manage.php');
		//stop the process
		die();

	}
}
//delete data from database
$sql = "DELETE FROM imgs WHERE id=$id";
//EXECUTE the query
$res = mysqli_query($conn, $sql);
//check whether the data is delete from database ornot
if($res==true)
{
	//set success message and redirect
	$_SESSION['delete'] = "<div ='class'success'>category delete seccessfuly</div>";
	// redirect to manage categroy
	header('location:manage.php');
}
    

} 

else {
	$_SESSION['delete'] = "<div class='error'> failed to delete category  </div>";
	// redirect to manage categroy
	header('location:manage.php');
}



?>