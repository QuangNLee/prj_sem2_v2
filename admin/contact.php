<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/customerController.php';
?>
<?php
    $customer = new customerController();
    if(isset($_GET['change_status']) && isset($_GET['type'])){
        $id = $_GET['change_status'];
        $status = $_GET['type'];
        $update_status = $customer->update_status_contact($id,$status);
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Contact</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th width="5%" style="text-align: center; vertical-align: middle">ID</th>
                        <th width="10%" style="text-align: center; vertical-align: middle">Name</th>
                        <th width="15%" style="text-align: center; vertical-align: middle">Email</th>
                        <th width="10%" style="text-align: center; vertical-align: middle">Phone</th>
                        <th width="50%" style="text-align: center; vertical-align: middle">Question</th>
                        <th width="10%" style="text-align: center; vertical-align: middle">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $limit = 10;
                            $get_contact = $customer->get_contact();
                            $total_contact = mysqli_num_rows($get_contact);
                            $current_page_contact = isset($_GET['page']) ? $_GET['page'] : 1;
                            $contact_start = ($current_page_contact -1) * $limit;
                            $total_page_contact = ceil($total_contact/$limit);
                            $get_pagination_contact = $customer->get_pagination_contact($contact_start,$limit);
                            if($get_pagination_contact){
                                while($result = $get_pagination_contact->fetch_assoc()){
                        ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['id']; ?></td>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['name'] ?></td>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['email'] ?></td>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['phone'] ?></td>
                            <td><?php echo $result['subject'] ?></td>
                            <td style="text-align: center; vertical-align: middle">
                                <?php
                                    if($result['status'] == 1){
                                ?>
                                <a onclick="return confirm('Are you sure?')" href="?change_status=<?php echo $result['id'] ?>&type=0" style="color: green">Processed</a>
                                <?php
                                    } else {
                                ?>
                                <a onclick="return confirm('Are you sure?')" href="?change_status=<?php echo $result['id'] ?>&type=1" style="color: red">Waiting</a>
                                <?php
                                 }
                                ?>
                            </td>
                        </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <?php
                                if ($current_page_contact -1 > 0){
                            ?>
                            <li class="paginate_button page-item previous">
                                <a href="contact.php?page=<?php echo $current_page_contact-1; ?>"class="page-link">Previous</a>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                                for($i = 1; $i <= $total_page_contact; $i++){
                            ?>
                            <li class="paginate_button page-item <?php echo (($current_page_brand == $i)?'active': '') ?>">
                                <a href="contact.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                                if($current_page_contact + 1 <= $total_page_contact){
                            ?>
                            <li class="paginate_button page-item next">
                                <a href="contact.php?page=<?php echo $current_page_contact + 1; ?>" class="page-link">Next</a>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>