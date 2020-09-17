
                        <h1 class="page-header">
                            Edit User
                        </h1>


<?php 



if (isset($_GET['id'])) 
{
  $query = query("SELECT * FROM users where user_id = ".escape_string($_GET['id'])." ");
  confirm($query);
  while ($row = fetch_array($query)) 
  {
   
    $username = escape_string($row['username']);
    $email    = escape_string($row['email']);
    $password = escape_string($row['password']);
    
  } 

  update_user();
}



?>


                    <form action="" method="post" enctype="multipart/form-data">

  


                        <div class="col-md-6">

                           


                           <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control"  value="<?php echo $username ?>" >
                               
                           </div>


                            <div class="form-group">
                                <label for="first name">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email ?>" >
                               
                           </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password ?>">
                               
                           </div>

                            <div class="form-group">

                           

                            <input type="submit" name="update_user" class="btn btn-primary pull-left" value="Update" >
                               
                           </div>


                            

                        </div>

                      

            </form>





    