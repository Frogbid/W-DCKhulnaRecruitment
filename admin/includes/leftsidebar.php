<div class="air__menuLeft">
   <div class="air__menuLeft__outer">
      <div class="air__menuLeft__mobileToggleButton air__menuLeft__mobileActionToggle">
         <span></span>
      </div>
      <div class="air__menuLeft__toggleButton air__menuLeft__actionToggle">
         <span></span>
         <span></span>
      </div>
      <a href="javascript: void(0);" class="air__menuLeft__logo">
         <center><img src="<?php echo $logo; ?>" alt="Logo" style="width:50px;height:50px;"></center>
      </a>
      <a href="javascript: void(0);" class="air__menuLeft__user">
         <div class="air__menuLeft__user__avatar">
            <img src="components/kit/core/img/avatars/avatar.png" alt="admin image" />
         </div>
         <div class="air__menuLeft__user__name">
            <?php echo $admin_name; ?>
         </div>
         <div class="air__menuLeft__user__role"><?php echo $admin_name; ?></div>
      </a>
      <?php
      if ($admin_type == 0) {
      ?>
         <div class="air__menuLeft__container kit__customScroll">
            <ul class="air__menuLeft__list">
               <li class="air__menuLeft__category">
                  <span>Applicants</span>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="javascript: void(0)" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Applicants</span>
                  </a>
                  <ul class="air__menuLeft__list">
                     <li class="air__menuLeft__item">
                        <a href="viewemployee.php" class="air__menuLeft__link">
                           <span>View Applicants</span>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
           <!-- <ul class="air__menuLeft__list">
               <li class="air__menuLeft__category">
                  <span>Testing</span>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="addingzero.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Adding Zero To Mobile Number</span>
                  </a>
               </li>
            </ul>
            <ul class="air__menuLeft__list">
               <li class="air__menuLeft__category">
                  <span>Testing</span>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="removingdash.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Removing Dash From Mobile Number</span>
                  </a>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="systemid.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;System ID</span>
                  </a>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="addrollnumber.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Create Roll Number</span>
                  </a>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="duplicateentry.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Check Duplicate Value</span>
                  </a>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="generatepassword.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Generate Password</span>
                  </a>
               </li>
               <li class="air__menuLeft__item air__menuLeft__submenu">
                  <a href="quota.php" class="air__menuLeft__link">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <span>&nbsp;Quota Applicants</span>
                  </a>
               </li>
            </ul> -->
            <div class="air__menuLeft__banner">
               <a href="logout.php" rel="noopener noreferrer" class="btn btn-white text-center d-block">
                  Logout
               </a>
            </div>
         </div>

      <?php
      }
      ?>


   </div>
</div>