<?php
    include_once'db/connect_db.php';
    session_start();
    if($_SESSION['role']!=="Admin"){
        header('location:index.php');
    }
    include_once'inc/header_all.php';

    error_reporting(0);
    $account_holder_name = NULL;
    $account_holder_id = NULL;
    $id = $_GET['id'];
    $select = $pdo->prepare("SELECT * FROM tbl_account_holders where id=$id");
    $select->execute();
    while($row=$select->fetch(PDO::FETCH_OBJ)){
        $account_holder_name = $row->name;
        $account_holder_id = $row->id;
    }

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
        echo $account_holer_id = $_POST['account_holer_id'];
        echo $debit = $_POST['debit'];
        echo $credit = $_POST['credit'];
        echo $date = $_POST['date'];
        // $password = $_POST['password'];
        // $role = $_POST['select_option'];
        // $status = $_POST['status'];

        //check if the email already exist
        
                //insert query here
                $insert = $pdo->prepare("INSERT INTO tbl_account_holder_transections(account_holder_id,debit,credit,date,dbStatus) VALUES(:id,:debit1,:credit1,:date1,1)");

                //binding the values parameter with input from user
                // $insert->bindParam(':fullname',$fullname);
                $insert->bindParam(':id',$account_holer_id);
                $insert->bindParam(':debit1',$debit);
                $insert->bindParam(':credit1',$credit);
                $insert->bindParam(':date1',$date);
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
                                    <label for="fname">Name</label>
                                    <input type="text" class="form-control" id="fname" name="fullname" value="<?php echo $account_holder_name; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="fname">account holder id</label> -->
                                    <input type="hidden" class="form-control" id="account_holer_id" name="account_holer_id" value="<?php echo $account_holder_id; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="fname">Debit Amount</label>
                                    <input type="text" class="form-control" id="debit" name="debit" placeholder="Enter Mobile Number" >
                                </div>
                                <div class="form-group">
                                    <label for="fname">Credit Amount</label>
                                    <input type="text" class="form-control" id="credit" name="credit" placeholder="Enter Full Address" >
                                </div>
                                <div class="form-group">
                                    <label for="fname">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Enter Full Address" required>
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
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Date</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $select = $pdo->prepare("SELECT * FROM tbl_account_holder_transections where account_holder_id=$id");
                                $select->execute();
                                while($row=$select->fetch(PDO::FETCH_OBJ)){
                                
                                ?>
                                    <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $account_holder_name; ?></td>
                                    <td><?php echo $row->debit; ?></td>
                                    <td><?php echo $row->credit; ?></td>
                                    <td><?php echo $row->date; ?></td>
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