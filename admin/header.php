<?php
require_once('includes/connection.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFXC - SIMS</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="shortcut icon" href="../../assets/images/sfxc.png" type="image/x-icon">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <span style="font-size: 15px;">INVENTORY SYSTEM</span>
                        </div>
                        <!-- <img src="../../assets/images/sfxc.png" alt=""> -->
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 20%;">
                    <img alt="" width="70%" style="border-radius: 50%;" <?php
                                                                        if ($_SESSION['admin']['gender'] == '1') {
                                                                            echo 'src="../../assets/images/avatar1.png"';
                                                                        } else {
                                                                            echo 'src="../../assets/images/avatar2.png"';
                                                                        }
                                                                        ?>>
                </div><br>
                <h5 class="text-center">Property Custodian</h5>
                <h5 class="text-center"><?php echo $_SESSION['admin']['fname'];
                                        echo "&nbsp";
                                        echo $_SESSION['admin']['lname']; ?></h5>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="fa fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link' onclick="scan_modal()">
                                <i class="fa fa-barcode"></i>
                                <span>Scan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="issuance.php" class='sidebar-link'>
                                <i class="fa fa-clipboard"></i>
                                <span>Issuance</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="items.php" class='sidebar-link'>
                                <i class="fa fa-toolbox"></i>
                                <span>Items</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="inventory.php" class='sidebar-link'>
                                <i class="fa fa-clipboard-list"></i>
                                <span>Inventory</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="category.php" class='sidebar-link'>
                                <i class="fa fa-toolbox"></i>
                                <span>Items Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="department.php" class='sidebar-link'>
                                <i class="fa fa-university"></i>
                                <span>Department</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="users.php" class='sidebar-link'>
                                <i class="fa fa-user"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="changepass.php" class='sidebar-link'>
                                <i class="fa fa-key"></i>
                                <span>Change Pass</span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="../includes/logout.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>


        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


            <!-- Modal -->
            <div class="modal fade" id="qr_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SCAN</h5>
                            <button type="button" class="close" onclick="reFresh()" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <input type="hidden" id=enrollment_id>
                            <input type="hidden" id=sub_c>
                            <div style="width: 100%;" id="reader" class="text-center">
                            </div>

                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ITEM INVENTORY</h5>
                            <button type="button" class="close" onclick="reFresh()" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id = "form_inventory">
                        <div class="modal-body">
                            <p id="name" class="fw-bold"></p>
                            <p id="brand" class="fw-bold"></p>
                            <p id="model" class="fw-bold"></p>
                            <p id="specs" class="fw-bold"></p>
                            <p id="issued_to" class="fw-bold"></p>
                            <p id="department" class="fw-bold"></p>
                            <p id="item_code" class="fw-bold"></p>
                            <br>
                            <div class="md-form">
                             <input type="hidden" id = "issuance_id" >
                             <input type="hidden" id = "qr_code" >
                        <label data-error="wrong" data-success="right">Item Status<span class="text-danger">*</span></label>
                        <select class='form-control' id="edit_status" required>
                            <option value="" selected hidden>- Select Status</option>
                            <option value="0">Lost Item</option>
                            <option value="1">Good Condition</option>
                            <option value="2">Damaged</option>
                        </select>
                        </div>
                        </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">Submit</button>
                    </div>
                 </form>
                </div>
            </div>
        </div>

        <!-- <div class="modal fade" id="list_add_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New User</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
            </div>
            <form id="form_insert">
                <div class="modal-body mx-4">
              

                </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div> -->