<?php include('conn.php');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
</head>
<body style="">



<div class="main-content">
  <div class="wrapper">
    <h1>manage category</h1>

<br><br>
<?php
       if(isset($_SESSION['add']))
       {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
       }
         if(isset($_SESSION['remove']))
       {
        echo $_SESSION['remove'];
        unset($_SESSION['remove']);
       }

         if(isset($_SESSION['delete']))
       {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
       }


         if(isset($_SESSION['no-category-found']))
       {
        echo $_SESSION['no-category-found'];
        unset($_SESSION['no-category-found']);
       }


      if(isset($_SESSION['update']))
       {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
       }

       if(isset($_SESSION['upload']))
       {
       echo $_SESSION['upload'];
        unset($_SESSION['upload']);
       }

      if(isset($_SESSION['failed-remove']))
       {
        echo $_SESSION['failed-remove'];
        unset($_SESSION['failed-remove']);
       }



       ?>

    <br/> <br/>
      
       
      <!---Button to add admin-->
      <a href="add.php" class="btn-primary">add category</a>
      <br/> <br/><br/>
        <table class="table able-danger" style="width: 800px; margin-left: 400px; background:lightblue;">
         <thead>
          <tr>
                <th>S.N</th>
                <th>name</th>
                <th>image</th>
                 <th>add</th>
                 <th>upadate</th>
                 <th>delete</th>
                
               </tr>
                <?php
               //QUERY TO GET ALL CATEGORY FROM DATABASE
                $sql = "SELECT * FROM imgs";
                //execute query
                $res = mysqli_query($conn, $sql);
                 $sn=1;
                //$count rows
               // $count = mysqli_num_rows($res);
                if (mysqli_num_rows($res) > 0) {
               
                  while($row=mysqli_fetch_assoc($res))
                  {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];
                    

                    ?>
                     <tr colspan="2">
                <td><?php echo $sn++;?></td>
                <td><?php echo $name;?></td>
                  <td>
                  <?php
                  //check whether image name is available or not
                  if($image!="")
                  {
                    //display th image
                    ?>
                
                    <img src="images/<?php echo $image;?>" width="50px">

                    <?php

                  }
                  else{
                    //display the message
                    echo "<div class'error'>image not added.</div>";
                  }




                  ?>
                    

                  </td>
                
                  <td>
                  <a href="add.php?id=<?php echo $id; ?>" class="btn-secondary">add </a>
                </td>
                 <td>
                  <a href="update.php?id=<?php echo $id; ?>" class="btn-secondary">update </a>
                </td>
                <td>
                  <a href="delete.php?id=<?php echo $id;  ?>&image=<?php echo $image;?>"class="btn-danger">delete </a>
                 </td>
                 </tr> 

                    <?php
                  }
                }
                else{
                     //we have do not have data
                  //we all display the message inside table

                  ?>
                  <tr>
                    <td colspan="6"><div class="error">NO category added.</div></td>
                  </tr>

                  <?php

                }

               ?>


              
                
      </thead>
  <tbody>

  </div>
</div>

  </div>
</div>
</body>
</html>