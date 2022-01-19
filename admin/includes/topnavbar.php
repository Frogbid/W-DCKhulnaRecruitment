<div class="air__topbar">
   <div class="air__topbar__searchDropdown dropdown mr-md-4 mr-auto">
      <b><?php echo $office_name; ?></b>
   </div>
   <div class="dropdown mr-auto d-none d-md-block">
   </div>
   <div class="dropdown mr-4 d-none d-sm-block"></div>
   <p class="mb-0 mr-4 d-xl-block d-none">
      Log in as
      <span class="ml-1 badge bg-danger text-white font-size-12 text-uppercase air__topbar__status"><?php echo $admin_name; ?></span>
   </p>
   <div class="air__topbar__actionsDropdown dropdown mr-4 d-none d-sm-block"></div>
   <div class="dropdown">
      <a href="#" class="dropdown-toggle text-nowrap" data-toggle="dropdown" aria-expanded="false" data-offset="5,15">
         <img class="dropdown-toggle-avatar" src="components/kit/core/img/avatars/avatar-2.png" alt="User avatar" />
      </a>
      <div class="dropdown-menu dropdown-menu-right" role="menu">
         <a class="dropdown-item" href="Profile">
            <i class="dropdown-icon fe fe-user"></i>
            Profile
         </a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="Changepassword">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Update Password
         </a>
         <?php
         if ($admin_type == 0) {
         ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Webinfo">
               <i class="fa fa-wrench" aria-hidden="true"></i>
               General Settings
            </a>
         <?php
         }
         ?>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="logout.php">
            <i class="dropdown-icon fe fe-log-out"></i> Logout
         </a>
      </div>
   </div>
</div>