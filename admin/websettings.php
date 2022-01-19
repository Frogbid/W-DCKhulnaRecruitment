<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
   <!---cdn css files area start-->
   <?php $page = '';
   require_once('includes/cssfiles.php');
   function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
   {
      // $resizeWidth = 100;
      // $resizeHeight = 100;
      $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
      $background = imagecolorallocate($imageLayer, 0, 0, 0);
      // removing the black from the placeholder
      imagecolortransparent($imageLayer, $background);

      // turning off alpha blending (to ensure alpha channel information
      // is preserved, rather than removed (blending with the rest of the
      // image in the form of black))
      imagealphablending($imageLayer, false);

      // turning on alpha channel information saving (to ensure the full range
      // of transparency is preserved)
      imagesavealpha($imageLayer, true);
      imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
      return $imageLayer;
   }
   ?>
   <!---cdn css files area end-->
</head>

<body class="air__menu--gray air__layout--contentMaxWidth">
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
                        <a href="#" class="air__subbar__breadcrumbLink air__subbar__breadcrumbLink--current">Basic Information</a>
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
                     <span class="mr-3">Website Basic Information</span>
                  </h5>
               </div>
               <div class="card">
                  <div class="card-header bg-dark">
                     <h4 class="mb-0 text-white">Update Website Info.</h4>
                  </div>
                  <div class="card-body">
                     <form class="form" method="post" enctype="multipart/form-data">
                        <div class="form-body row">
                           <?php
                           $unique_id = $_GET['unique_id'];
                           $getkey = $con->query("SELECT * from setting WHERE unique_id='$unique_id'")->fetch_assoc();
                           ?>
                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Office name/title</label>
                                 <input type="text" id="cname" class="form-control" name="office_name" value="<?php echo $getkey['office_name']; ?>" required>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Address</label>
                                 <input type="text" id="cname" class="form-control" name="ofiice_address" value="<?php echo $getkey['ofiice_address']; ?>" required>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Contact Number</label>
                                 <input type="text" id="cname" class="form-control" name="office_contact_no" value="<?php echo $getkey['office_contact_no']; ?>">
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">E-mail</label>
                                 <input type="email" id="cname" class="form-control" name="office_email" value="<?php echo $getkey['office_email']; ?>">
                              </div>
                           </div>



                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Start Time</label>
                                 <input type="time" id="cname" class="form-control" name="start_time" value="<?php echo $getkey['start_time']; ?>" required>
                              </div>
                           </div>

                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">End Time</label>
                                 <input type="time" id="cname" class="form-control" name="end_time" value="<?php echo $getkey['end_time']; ?>" required>
                              </div>
                           </div>

                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Establishment Year</label>
                                 <input type="number" id="cname" class="form-control" name="est_year" value="<?php echo $getkey['est_year']; ?>" required>
                              </div>
                           </div>

                           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Owner name</label>
                                 <input type="text" id="cname" class="form-control" name="owner_name" value="<?php echo $getkey['owner_name']; ?>" required>
                              </div>
                           </div>

                           <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Sample Logo<b class="text-danger">(Choose Only One Letter*)</b></label>
                                 <input type="text" id="cname" maxlength="1" class="form-control" name="title" value="<?php echo $getkey['title']; ?>" required>
                              </div>
                           </div>

                           <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Website Logo</label>
                                 <input type="file" class="form-control" name="logo">
                                 <br>
                                 <img src="<?php echo $getkey['logo']; ?>" width="60" height="60" />
                              </div>
                           </div>


                           <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Website Favicon</label>
                                 <input type="file" class="form-control" name="favicon">
                                 <br>
                                 <img src="<?php echo $getkey['favicon']; ?>" width="60" height="60" />
                              </div>
                           </div>


                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Privacy Policy</label>
                                 <textarea class="form-control" rows="5" name="p_data" style="resize: none;"><?php echo $getkey['privacy_policy']; ?></textarea>
                              </div>
                           </div>

                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">About Us</label>
                                 <textarea class="form-control" rows="5" name="a_data" style="resize: none;"><?php echo $getkey['about_us']; ?></textarea>
                              </div>
                           </div>

                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Contact Us</label>
                                 <textarea class="form-control" rows="5" name="c_data" style="resize: none;"><?php echo $getkey['contact_us']; ?></textarea>
                              </div>
                           </div>

                           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              <div class="form-group">
                                 <label for="cname">Terms & Conditions</label>
                                 <textarea class="form-control" rows="5" name="terms" style="resize: none;"><?php echo $getkey['terms']; ?></textarea>
                              </div>
                           </div>

                        </div>

                        <div class="form-actions">

                           <button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-dark">
                              <i class="fa fa-check-square-o"></i> Update Setting
                           </button>
                        </div>

                        <?php
                        if (isset($_POST['sub_cat'])) {
                           $office_name = $_POST['office_name'];
                           $ofiice_address = $_POST['ofiice_address'];
                           $office_contact_no = $_POST['office_contact_no'];
                           $office_email = $_POST['office_email'];
                           $title = mysqli_real_escape_string($con, $_POST['title']);
                           $p_data = $_POST['p_data'];
                           $a_data = $_POST['a_data'];
                           $c_data = $_POST['c_data'];
                           $est_year = $_POST['est_year'];
                           $terms = $_POST['terms'];
                           $owner_name = $_POST['owner_name'];
                           $start_time = $_POST['start_time'];
                           $end_time = $_POST['end_time'];
                           $data = $con->query("select * from setting")->fetch_assoc();
                           if ($_FILES["favicon"]["name"] == '') {
                              $favicon = $data['favicon'];
                           } else {
                              $fileName = $_FILES['favicon']['tmp_name'];
                              $sourceProperties = getimagesize($fileName);
                              $resizeFileName = time();
                              $uploadPath = "website/";
                              $fileExt = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
                              $uploadImageType = $sourceProperties[2];
                              $sourceImageWidth = $sourceProperties[0];
                              $sourceImageHeight = $sourceProperties[1];
                              $new_width = $sourceImageWidth;
                              $new_height = $sourceImageHeight;
                              switch ($uploadImageType) {
                                 case IMAGETYPE_JPEG:
                                    $resourceType = imagecreatefromjpeg($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagejpeg($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                    break;

                                 case IMAGETYPE_GIF:
                                    $resourceType = imagecreatefromgif($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagegif($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                    break;

                                 case IMAGETYPE_PNG:

                                    $resourceType = imagecreatefrompng($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagepng($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                    break;

                                 default:
                                    $imageProcess = 0;
                                    break;
                              }

                              $favicon = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                           }


                           if ($_FILES["logo"]["name"] == '') {
                              $logo = $data['logo'];
                           } else {
                              $fileName = $_FILES['logo']['tmp_name'];
                              $sourceProperties = getimagesize($fileName);
                              $resizeFileName = time();
                              $uploadPath = "website/";
                              $fileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                              $uploadImageType = $sourceProperties[2];
                              $sourceImageWidth = $sourceProperties[0];
                              $sourceImageHeight = $sourceProperties[1];
                              $new_width = $sourceImageWidth;
                              $new_height = $sourceImageHeight;
                              switch ($uploadImageType) {
                                 case IMAGETYPE_JPEG:
                                    $resourceType = imagecreatefromjpeg($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagejpeg($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                    break;

                                 case IMAGETYPE_GIF:
                                    $resourceType = imagecreatefromgif($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagegif($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                    break;

                                 case IMAGETYPE_PNG:

                                    $resourceType = imagecreatefrompng($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagepng($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                    break;

                                 default:
                                    $imageProcess = 0;
                                    break;
                              }

                              $logo = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                           }

                           $websetting_update_query = $con->query("UPDATE setting set office_name='" . $office_name . "',ofiice_address='" . $ofiice_address . "',office_contact_no='" . $office_contact_no . "',favicon='" . $favicon . "',logo='" . $logo . "',title='" . $title . "',owner_name='" . $owner_name . "',office_email='" . $office_email . "',start_time='" . $start_time . "',end_time='" . $end_time . "',privacy_policy='" . $p_data . "',about_us='" . $a_data . "',contact_us='" . $c_data . "',terms='" . $terms . "',est_year=" . $est_year . " WHERE unique_id='$unique_id'");
                           if ($websetting_update_query == TRUE) {
                              $_SESSION['msg'] = "Website info!";
                              $_SESSION['status'] = "Updated Successfully!";
                              $_SESSION['status_code'] = "success";
                        ?>
                              <script>
                                 window.location.href = 'Webinfo';
                              </script>
                        <?php
                           }
                        }
                        ?>
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
   <!---additional scripts area start-->

   <script>
      CKEDITOR.editorConfig = function(config) {
         config.language = 'es';
         config.uiColor = '#F7B42C';
         config.height = 300;
         config.toolbarCanCollapse = true;

      };
      CKEDITOR.replace('p_data');


      CKEDITOR.editorConfig = function(config) {
         config.language = 'es';
         config.uiColor = '#F7B42C';
         config.height = 300;
         config.toolbarCanCollapse = true;

      };
      CKEDITOR.replace('a_data');

      CKEDITOR.editorConfig = function(config) {
         config.language = 'es';
         config.uiColor = '#F7B42C';
         config.height = 300;
         config.toolbarCanCollapse = true;

      };
      CKEDITOR.replace('c_data');

      CKEDITOR.editorConfig = function(config) {
         config.language = 'es';
         config.uiColor = '#F7B42C';
         config.height = 300;
         config.toolbarCanCollapse = true;

      };
      CKEDITOR.replace('terms');
   </script>
   <!---additional scripts area end-->
</body>

</html>