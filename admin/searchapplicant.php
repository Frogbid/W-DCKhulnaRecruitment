<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
    <!---cdn css files area start-->
    <?php $page = '';
    require_once('includes/cssfiles.php'); ?>
    <!---cdn css files area end-->
</head>

<body class="air__menu--gray air__layout--contentNoMaxWidth">
    <!---preloader area start-->
    <?php require_once('includes/preloader.php'); ?>
    <!---preloader area end-->
    <div class="air__layout air__layout--hasSider">
        <!--left sidebar area start-->
        <?php require_once('includes/leftsidebar.php'); ?>
        <!---left sidebar area ends-->

        <!---mobile menu area start-->
        <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
        <!---mobile menu area end-->

        <!---dark theme activation area start-->
        <?php require_once('includes/darkthemeactivation.php'); ?>
        <!---dark theme activation area end-->

        <div class="air__layout">
            <div class="air__layout__header">
                <div class="air__utils__header">
                    <!---top navigation bar area start-->
                    <?php require_once('includes/topnavbar.php'); ?>
                    <!---top navigation bar area end-->
                    <!---page titile area start-->
                    <div class="air__subbar">
                        <ul class="air__subbar__breadcrumbs mr-4">
                            <li class="air__subbar__breadcrumb">
                                <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">All Applicants</a>
                            </li>
                        </ul>
                        <div class="air__subbar__divider mr-4 d-none d-xl-block"></div>

                    </div>
                    <!---page titile area end-->
                </div>
            </div>
            <!---main page content write here-->
            <div class="air__layout__content">
                <div class="air__utils__content">
                    <div class="kit__utils__heading">
                        <h5>
                            <span class="mr-3">All Applicants</span>
                        </h5>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="mb-0 text-white">List of the Applicants</small></h4>
                        </div>
                        <div class="card-body">
                            <form action="viewapplicantdetail.php" method="GET">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Roll Number</label>
                                    <input type="number" name="roll_no" class="form-control" aria-describedby="emailHelp" placeholder="Enter roll number">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---main page content write here area end-->
            <!---footer area starts here-->
            <?php require_once('includes/footer.php'); ?>
            <!---footer area starts here-->
        </div>
    </div>
    <!---Scripts area start-->
    <?php require_once('includes/jsfiles.php'); ?>
    <!---Scripts area end-->
    <!---additional scripts area end-->
</body>

</html>