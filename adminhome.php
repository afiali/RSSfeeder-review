<?php
include_once("header.php");
$_SESSION['admin_page'] = 'true';
?>



<link href="css/style2.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="sidebar-nav">
                <h5><i class="glyphicon glyphicon-user"></i>
                    <small><b>USERS</b></small>
                </h5>
                <ul class="well nav nav-pills nav-stacked">
                    <li><a href="adminhome.php">View List</a></li>
                    <li><a href="register.php">Add New</a></li>
                    <li>
                      <form method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search">
                            <div class="input-group-btn">
                              <button class="btn btn-default" type="submit" name="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                      </form>
                    </li>
                </ul>
                <h5><i class="glyphicon glyphicon-comment"></i>
                    <small><b>COMMENTS</b></small>
                </h5>
                <ul class="well nav nav-pills nav-stacked">
                    <li><a href="adminhome.php">View List</a></li>
                    <li><a href="#">Manage</a></li>
                </ul>
            </div>
        </div>
        <br/><br/>

        <div class="col-md-8">
            <!-- Content Here -->
            <div class="col-md-14 col-md-offset-0">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">List of Users</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create">Create New User</button>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                        <th class="hidden-xs">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr> 
                  </thead>
                  <tbody>
                        <?php
                        $start=0;
                        $limit=1; // set number of item per page
                         
                        if(isset($_GET['id']))
                        {
                            $id=$_GET['id'];
                            $start=($id-1)*$limit;
                        }
                        else{
                            $id=1;
                        }
                        //Fetch from database first 10 items which is its limit. For that when page open you can see first 10 items.
                        if(isset($_GET['submit'])) {
                          $search_form = $_GET['search'];
                          $query=mysqli_query($mysqli,"select * from user WHERE first_name LIKE '$search_form' OR last_name LIKE '$search_form' LIMIT $start, $limit");
                        } else {
                          $query=mysqli_query($mysqli,"select * from user LIMIT $start, $limit");
                        }

                        //print from number of $limit 
                        while($result=mysqli_fetch_array($query))
                        {
                          $user_id=$result['id'] ;
                          $name=$result['first_name']." ".$result['last_name'];
                          $email=$result['email'];
                        ?>

                          <tr>
                            <td align="center">
                              <a href="editprofile.php?id=<?php echo $user_id; ?>" class="btn btn-info"><em class="fa fa-pencil"></em></a>
                              <a href="deleteprofile.php?id=<?php echo $user_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><em class="fa fa-trash"></em></a>
                            </td>
                            <td class="hidden-xs"><?php echo $user_id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                          </tr>

                        <?php
                        }
                        ?>


                  </tbody>
                </table>
            
              </div>

              <?php
              //fetch all the data from database.
              $rows=mysqli_num_rows(mysqli_query($mysqli,"select * from user"));
              //calculate total page number for the given table in the database 
              $total=ceil($rows/$limit);
              ?>
              <ul class='page'>
              <div class="panel-footer">
                <div class="row">
                  <div class="col col-xs-4">Page <?php echo $id; ?> of <?php echo $total; ?>
                  </div>
                  <div class="col col-xs-8">
                    <ul class="pagination hidden-xs pull-right">
                    <?php
                    //show all the page link with page number. When click on these numbers go to particular page.
                            if($id>1)
                            {
                                //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
                                echo "<li><a href='?id=".($id-1)."'>«</a></li>";
                            } 
                            for($i=1;$i<=$total;$i++)
                            {
                                if($i==$id) { echo "<li class='current'><a href='?id=".$i."'>".$i."</a></li>"; }                                 
                                else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
                            }
                            if($id!=$total)
                            {
                                ////Go to previous page to show next 10 items.
                                echo "<li><a href='?id=".($id+1)."'>»</a></li>";
                            }
                    ?>
                    </ul>
                    <ul class="pagination visible-xs pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            </div>
        </div>
    </div>
</div>
<?php
include_once("footer.php");
?>