<!DOCTYPE html>
<html lang="en">

<?php
include_once '_include/head.php';
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include_once '_include/navbar.php';
        include_once '_include/sidebar_admin.php';
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Login</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <form role="form" action="" method="post">
                        <div class="row my-3 ">
                            <div class="col-sm-12 text-right">
                                <button type="button" style="font-size: 15px;" id="addUser" class="btn bg-gradient-secondary" data-toggle="modal" data-target="#regModal">
                                    <span class="fas fa-user-plus"></span>
                                    Add User
                                </button>
                                <button type="button" style="font-size: 15px;" id="editUser" class="btn bg-gradient-primary" data-toggle="modal" data-target="#updateModal">
                                    <span class="fas fa-user-edit"></span>
                                    Edit User
                                </button>
                                <button type="button" style="font-size: 15px;" id="deleteUser" class="btn bg-gradient-danger">
                                    <span class="fas fa-trash"></span>
                                    Delete User
                                </button>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Authorized Person</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" id=regtableForm>
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>

                                                    <th style="width: 10px">#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Role</th>
                                                    <th style="text-align: center; width: 200px; ">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody id=tableData>
                                                <?php
                                                include_once '_include/connect.php';
                                                $select = $pdo->prepare("select * from tbl_user order by userid desc");
                                                $select->execute();
                                                $userid = 1;
                                                while ($row = $select->fetch(PDO::FETCH_OBJ)) {


                                                    echo '
                                                    
                                                        <tr id=' . $userid . '>
                                                            
                                                            <td>' . $userid . '</td>
                                                            <td>' . $row->username . '</td>
                                                            <td>' . $row->useremail . '</td>
                                                            <td>' . $row->password . '</td>
                                                            <td>' . $row->role . '</td>
                                                            <td class="text-center">
                                                                <button type="button" id=' . $row->userid . ' class="btn btn-sm bg-gradient-info mx-1 btn-edit">
                                                                <span class="fas fa-user-edit"></span>
                                                                    &nbsp;Edit
                                                                </button>
                                                                <button type="button" id=' . $row->userid . ' class="btn btn-sm bg-gradient-danger mx-1 btn-delete">
                                                                <span class="fas fa-trash"></span>
                                                                    &nbsp;Delete
                                                                </button>
                                                                
                                                            </td>
                                                        </tr>
                                                        
                                                        ';
                                                    $userid++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php
        include_once '_include/footer.php';
        ?>
    </div>
    <?php
    include_once '_include/foot.php';
    ?>
</body>
<!-- Start Save Modal -->
<div class="modal fade" id="regModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-secondary">

            <div class="modal-header">
                <h4 id="regTitle" class="modal-title">Registration Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id=regForm>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter name">
                        <label id="lblusername" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter email">
                        <label id="lbluseremail" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label id="lblpassword" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="" disabled selected>Select role</option>
                            <option>User</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="button" class="btn btn-outline-light" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn btn-outline-light" id="save">Save</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- /.modal-content-->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--End Save Modal -->

<!-- Start Update Modal -->
<div class="modal fade" id="updateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-secondary">

            <div class="modal-header">
                <h4 id="regTitle" class="modal-title">Registration Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id=updateForm>
                    <input type="hidden" name="userid" id="userid" />
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="user_name" name="username" placeholder="Enter name">
                        <label id="lblusername" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" id="user_email" name="useremail" placeholder="Enter email">
                        <label id="lbluseremail" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="user_pass" name="password" placeholder="Password">
                        <label id="lblpassword" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id="user_role" name="role">
                            <option value="" disabled selected>Select role</option>
                            <option>User</option>
                            <option>Admin</option>
                        </select>
                        <label id="lblrole" style="color:yellow;"></label>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name=userid id="user_id" />
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light" id="updateBtn">Update</button>
            </div>

        </div>
        <!-- /.modal-content-->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--End Save Modal -->

</html>