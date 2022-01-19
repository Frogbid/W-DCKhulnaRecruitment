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
                     <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered text-center">
                           <thead>
                              <tr>
                                 <th colspan="9">View Applicant Details</th>
                                 <th>
                                    <button type="submit" class="btn btn-success btn-sm btn-rounded delete_all" name="deleteMultiple">Select</button>
                                 </th>
                              </tr>
                              <tr>
                                 <th>Roll Number</th>
                                 <th>Applicant Name</th>
                                 <th>Contact No.</th>
                                 <th>Post</th>
                                 <th>Qualification</th>
                                 <th>Quota</th>
                                 <th>Image</th>
                                 <th><i class="fa fa-eye" aria-hidden="true"></i></th>
                                 <th>Status</th>
                                 <th>
                                    <input type="checkbox" id="master" unchecked>
                                 </th>
                              </tr>
                           </thead>

                           <tbody>
                              <?php
                              $query = "SELECT * FROM employee_info_table";
                              $data = mysqli_query($con, $query);
                              $serial_no = 1;
                              if (mysqli_num_rows($data) > 0) {
                                 while ($row = mysqli_fetch_assoc($data)) {
                                    $status = $row["selected"];
                              ?>
                                    <tr>
                                       <td><?php echo $row["roll_no"]; ?></td>
                                       <td><?php echo $row["employee_name"]; ?></td>
                                       <td><?php echo $row["employee_contactno"]; ?></td>
                                       <td><?php echo $row["employee_designation"]; ?></td>
                                       <td><?php echo $row["educational_qualification"]; ?></td>
                                       <td><?php echo $row["quota"]; ?></td>
                                       <td><img src="../<?php echo $row['emp_img']; ?>" alt="No Image" style="width: 50px;height:50px;border-radius:50%;"></td>
                                       <td><button name="view" id="<?php echo $row["employee_id"]; ?>" class="btn btn-dark btn-sm btn-rounded view_employee" data-toggle="tooltip" data-placement="top" title="view employee details"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                                       <?php
                                       if ($status == 1) {
                                       ?>
                                          <td><span class="badge badge-pill badge-success p-2">Selected</span></td>
                                       <?php
                                       } else {
                                       ?>
                                          <td><span class="badge badge-pill badge-danger p-2">Unselected</span></td>
                                       <?php
                                       }
                                       ?>
                                       <td class="text-center"><input type="checkbox" class="sub_chkk" data-id="<?php echo $row["employee_id"]; ?>"></td>
                                    </tr>
                              <?php
                                    $serial_no++;
                                 }
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!---Dynamic View modal Individual Employee----->
               <div class="modal fade bd-example-modal-xl" id="viewEmployeemodal" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-full-width" role="document">
                     <div class="modal-content">
                        <div class="modal-header text-center">
                           <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body" id="viewEmployee_Detail">

                        </div>
                        <div class="modal-footer">
                           <button type="button" id="cross" class="btn btn-dark btn-rounded" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!---Dynamic View modal Individual Employee----->
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
      $(document).ready(function() {
         $('#example1').DataTable({
            "lengthMenu": [
               [500, 1000, 2000, 3000, 4000, 5000, -1],
               [500, 1000, 2000, 3000, 4000, 5000, "All"]
            ]
         });
      });
   </script>

   <?php
   if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
   ?>
      <script>
         toastr.<?php echo $_SESSION['status_code']; ?>("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['msg']; ?>", {
            progressBar: !0
         });
      </script>
   <?php
      unset($_SESSION['status']);
   }
   ?>
   <!--delete all and change inactive to active scripts from table--->
   <script>
      $(document).ready(function() {
         //checkbox checked unchecked
         jQuery('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
               $(".sub_chkk").prop('checked', true);
            } else {
               $(".sub_chkk").prop('checked', false);
            }
         });
         //delete multiple rows
         jQuery('.delete_all').on('click', function(e) {
            var allValsD = [];
            $(".sub_chkk:checked").each(function() {
               allValsD.push($(this).attr('data-id'));
            });

            if (allValsD.length <= 0) {
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Sorry! Please Select At Least One Row for Selection!'
               });
            } else {
               WRN_PROFILE_DELETE = "Are you sure you want to select this row permanently?";
               var check = confirm(WRN_PROFILE_DELETE);
               if (check == true) {
                  var join_selected_valuesD = allValsD.join(",");
                  //alert(join_selected_valuesD);
                  $.ajax({
                     type: "POST",
                     url: "deleteMultiemployee.php",
                     cache: false,
                     data: 'employee_id=' + join_selected_valuesD,
                     success: function(response) {
                        location.reload();
                     }
                  });
               }
            }
         });
      });
   </script>
   <!--delete all and change inactive to active scripts from table--->
   <!---individual employee script area start--->
   <script>
      $(document).ready(function() {
         $(document).on('click', '.view_employee', function() {
            //$('#dataModal').modal();
            var employee_id = $(this).attr("id");
            $.ajax({
               url: "individualemployee.php",
               method: "POST",
               data: {
                  employee_id: employee_id
               },
               success: function(data) {
                  $('#viewEmployee_Detail').html(data);
                  $('#viewEmployeemodal').modal('show');
               }
            });
         });
      });
   </script>
   <!---additional scripts area end-->
</body>

</html>