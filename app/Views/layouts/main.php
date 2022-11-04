<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Laundry Management and Booking System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

        <!-- third party css -->
        <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- App css -->
        <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style">
        <link href="<?= base_url('assets/css/app-dark.min.css') ?>" rel="stylesheet" type="text/css" id="dark-style">
        
        <!-- Datatables css -->
        

        <!-- third party css -->
        <link href="<?= base_url('assets/css/vendor/dataTables.bootstrap5.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/vendor/responsive.bootstrap5.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/vendor/buttons.bootstrap5.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/vendor/select.bootstrap5.css') ?>" rel="stylesheet" type="text/css">

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <?= $this->include('layouts/inc/logo')  ?>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">

            <!--- Sidemenu -->
            <?= $this->include('layouts/inc/sidebar') ?>

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <?= $this->include('layouts/inc/topbar') ?>
            <!-- end Topbar -->
            
           
                <!-- end page title -->

                <?= $this->renderSection('content') ?>

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>document.write(new Date().getFullYear())</script> © Laundry Management System
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

        <script src="<?= base_url('assets/js/vendor.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/app.min.js') ?>"></script>

        <!-- third party js -->
        <script src="<?= base_url('assets/js/vendor/apexcharts.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/jquery-jvectormap-1.2.2.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/jquery-jvectormap-world-mill-en.js') ?>"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="<?= base_url('assets/js/pages/demo.dashboard.js') ?>"></script>
        <!-- end demo js-->

        <!-- Datatables js -->
    
        <script src="<?= base_url('assets/js/vendor/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.bootstrap5.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.responsive.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/responsive.bootstrap5.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.buttons.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.bootstrap5.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.html5.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.flash.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/buttons.print.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.keyTable.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/dataTables.select.min.js') ?>"></script>

        <script src="<?= base_url('assets/js/pages/demo.datatable-init.js') ?>"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                
                <?php if(session()->getFlashdata('status')): ?>
                    Swal.fire({
                        title: "<?= session()->getFlashdata('status') ?>",
                        text: "<?= session()->getFlashdata('status_text') ?>",
                        icon: "<?= session()->getFlashdata('status_icon') ?>",
                        timer: 2000,
                        })
                <?php endif; ?>

            });
        </script>

    <?= $this->renderSection('scripts') ?>
    </body>
</html>