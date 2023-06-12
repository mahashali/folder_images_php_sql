<?php include('conn.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>add category</h1>

       <br><br>
   
       <br><br>

       <!---add category from start-->
       <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>name:</td>
                <td>
                    <input type="text" name="name" placeholder="name">
                </td>
            </tr>
            <tr>
                <td>image:</td>
                <td>
                    <input type="file" name="image" placeholder="inter iamge">
                </td>
            </tr>
          
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="add" class="btn-secondary">
                </td>
            </tr>
            
        </table>
        

       </form>
       <!---add category from end-->
       <?php
       //check whether submit button
       if(isset($_POST['submit']))
       {
        //echo "clicked";
        $name = $_POST['name'];
         $image = $_POST['image'];

       

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

                $source_path = $_FILES['image']['tmp_name'];
                //rename the image
                $image = "img_".rand(000,999).'.'.$ext; // e.g. Food_category_834.jpg

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
            }

            }
            else{
                //don't upload image and set the image_name value as blank
                $image="";
            }





         
            //2. create sql query to insert category into database
            $sql = "INSERT INTO imgs SET 
            image='$image',
            name='$name'
           
            ";
            //3. execute the query and save in database
            $res = mysqli_query($conn, $sql);

            //4. check whether the query execute or not and data added or not
            if($res==true)
            {
                
                header('location:manage.php');
            }
            else{
              
                header('location:add.php');
            }

       }




              ?>

        

            



           



   

   </div>
</div>
