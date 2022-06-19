<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
                <div class="block">
                    <p>Revenue statistics: Last 365 days</p>
                    <!--                <p>Revenue statistics: <span id="text-date"></span></p>-->
                    <!--                <p>-->
                    <!--                    <select class="select-date">-->
                    <!--                        <option value="7days" selected>Last 7 days</option>-->
                    <!--                        <option value="28days">Last 28 days</option>-->
                    <!--                        <option value="90days">Last 90 days</option>-->
                    <!--                        <option value="365days">Last 365 days</option>-->
                    <!--                    </select>-->
                    <!--                </p>-->
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div
    </div>
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>