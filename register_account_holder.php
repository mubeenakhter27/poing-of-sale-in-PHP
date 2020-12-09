<?php
    include_once'db/connect_db.php';
    session_start();
    if($_SESSION['role']!=="Admin"){
        header('location:index.php');
    }
    include_once'inc/header_all.php';

    error_reporting(0);

    // $id = $_GET['id'];

    // $delete = $pdo->prepare("DELETE FROM tbl_user WHERE user_id=".$id);

    // if($delete->execute()){
    //     echo'<script type="text/javascript">
    //         jQuery(function validation(){
    //         swal("Info", "User Has Been Deleted", "info", {
    //         button: "Continue",
    //             });
    //         });
    //         </script>';
    // }

    if(isset($_POST['submit'])){

        // $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $mobile_number = $_POST['mobile_number'];
        $address = $_POST['address'];
        // $password = $_POST['password'];
        // $role = $_POST['select_option'];
        // $status = $_POST['status'];

        //check if the email already exist
        if(isset($_POST['mobile_number'])){
            $select = $pdo->prepare("SELECT phone_number FROM tbl_account_holders WHERE phone_number='$mobile_number'");
            $select->execute();

            if($select->rowCount() > 0 ){
                echo'<script type="text/javascript">
                    jQuery(function validation(){
                    swal("Warning", "Username already exists", "warning", {
                    button: "Continue",
                        });
                    });
                    </script>';
            } else {
                //insert query here
                $insert = $pdo->prepare("INSERT INTO tbl_account_holders(name,phone_number,address,dbStatus) VALUES(:fullname,:mobile_number,:address1,1)");

                //binding the values parameter with input from user
                $insert->bindParam(':fullname',$fullname);
                $insert->bindParam(':mobile_number',$mobile_number);
                $insert->bindParam(':address1',$address);
                // $insert->bindParam(':role',$role);

                //if execution $insert
                if($insert->execute()){
                    echo'<script type="text/javascript">
                        jQuery(function validation(){
                        swal("Success", "
                        New User Added", "success", {
                        button: "Continue",
                            });
                        });
                        </script>';
                }
            }
        }
    }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <form action="" method="POST">
            <!-- Registration Form -->
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Register a New Account</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <div class="box-body">
                                <!-- <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                                </div> -->
                                <div class="form-group">
                                    <label for="fname">Full name</label>
                                    <input type="text" class="form-control" id="fname" name="fullname" placeholder="Enter Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="fname">Phone Number</label>
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="fname">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Full Address" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div> -->
                                <!-- <div class="form-group">
                                    <input type="hidden" class="form-control" id="password" name="status" placeholder="Password" required>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label>Authority </label>
                                    <select class="form-control" name="select_option" required>
                                        <option>Admin</option>
                                        <option>Operator</option>
                                    </select>
                                </div> -->
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Registered Table -->
            <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">User List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="myRegister">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $select = $pdo->prepare("SELECT * FROM tbl_account_holders");
                                $select->execute();
                                while($row=$select->fetch(PDO::FETCH_OBJ)){
                                ?>
                                    <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->phone_number; ?></td>
                                    <td><?php echo $row->address; ?></td>
                                    <td>
                                        <a href="translation.php?id=<?php echo $row->user_id; ?>"
                                        class="btn btn-success btn-sm">debit</i></a>
                                        <a href="translation.php?id=<?php echo $row->user_id; ?>"
                                        class="btn btn-success btn-sm">credit</i></a>
                                        <!-- <a href="deactivate.php?id=" class="btn btn-info btn-sm"
                                        onclick="return confirm('Are You Sure, You Want To Deactivate The Account?')" name="deactivate">
                                        <i class="fa fa-power-off"></i></a> -->
                                    </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  $(document).ready( function () {
      $('#myRegister').DataTable();
  } );
  </script>

 <?php
    include_once'inc/footer_all.php';
 ?>