<?php
      echo '<ul class="sidebar-menu" data-widget="tree">';
        echo ' <li class="header">MAIN NAVIGATION';
        if($_SESSION['package']==1){
          echo "<span class='badge bg-green'> Basic</span>";
        }else if($_SESSION['package']==2){
          echo "<span class='badge bg-blue'> Standard</span>";
        }else if($_SESSION['package']==3){
          echo "<span class='badge bg-red'> Premium</span>";
        }else{
          echo "<span class='badge bg-black'>Trial</span>";
        }
      echo'</li>';


      if($_SESSION['package']==1){
        if($directoryURI=="admin.php"){
          echo '<li class=""><a><i class="fa fa-dashboard"></i> <span>Dashboard</span></li>';
          echo '<li class=""><a href="form.php" ><i class="fa fa-edit"></i> <span>Forms</span></li>';
          echo '<li class=""><a href="user.php" ><i class="fa fa-users"></i> <span>Manage Users</span></li>';
          echo '<li class=""><a ><i class="fa fa-wrench"></i> <span>Form Settings <span class="badge badge-pill badge-success">Standard</span></a></span></li>';
          echo '<li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Request List
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="service_requests.php"><i class="fa fa-circle-o"></i>Service</a></li>
            <li><a href="application_requests.php"><i class="fa fa-circle-o"></i>Application</a></li>
          </ul>
        </li>';
          echo '<li class=""><a ><i class="fa fa-users"></i> <span>Manage Employees <span class="badge badge-pill badge-success">Standard</span></a></span></li>';
          echo '<li class=""><a ><i class="fa fa-sliders"></i><span>Configure <span class="badge badge-pill badge-success">Standard</span></a></span></li>';
          echo '<li class=""><a><img src="../img/twilio.ico" alt="Icon" width="16px" height="16px"/></image><span> Twilio Configure<span class="badge badge-pill badge-success">Premium</span></a></span></li>';
          echo '<li class=""><a href="subscription_details.php" ><i class="fa fa-key"></i><span>License Information </span></li>';
        }else{
          echo '<li class=""><a href="admin.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></li>';
          echo '<li class=""><a><i class="fa fa-edit"></i> <span>Forms</span></li>';
          echo '<li class=""><a href="user.php" ><i class="fa fa-users"></i> <span>Manage Users</span></li>';
          echo '<li class=""><a ><i class="fa fa-wrench"></i> <span>Form Settings <span class="badge badge-pill badge-success">Standard</span></a></span></li>';
          echo '<li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Request List
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="service_requests.php"><i class="fa fa-circle-o"></i>Service</a></li>
            <li><a href="application_requests.php"><i class="fa fa-circle-o"></i>Application</a></li>
          </ul>
        </li>';
          echo '<li class=""><a ><i class="fa fa-users"></i> <span>Manage Employees <span class="badge badge-pill badge-success">Standard</span></a></span></li>';
          echo '<li class=""><a ><i class="fa fa-sliders"></i> <span>Configure <span class="badge badge-pill badge-success">Standard</span></a></span></li>';
          echo '<li class=""><a><img src="../img/twilio.ico" alt="Icon" width="16px" height="16px"/></image><span> Twilio Configure<span class="badge badge-pill badge-success">Premium</span></span></li>';
          echo '<li class=""><a href="subscription_details.php" ><i class="fa fa-key"></i><span>License Information </span></li>';
        }
      }


      if($_SESSION['package']==2){
        if($directoryURI=="admin.php"){
          echo '<li class=""><a><i class="fa fa-dashboard"></i> <span>Dashboard</span></li>';
          echo '<li class=""><a href="form.php"><i class="fa fa-edit"></i> <span>Forms</span></li>';
          echo '<li class=""><a href="user.php"><i class="fa fa-users"></i> <span>Manage Users</span></li>';
          echo '<li class=""><a  href="form_setting.php"><i class="fa fa-wrench"></i> <span>Form Settings</a></span></li>';
          echo '<li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Request List
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="service_requests.php"><i class="fa fa-circle-o"></i>Service</a></li>
            <li><a href="application_requests.php"><i class="fa fa-circle-o"></i>Application</a></li>
          </ul>
        </li>';
          echo '<li class=""><a href="employee.php"><i class="fa fa-users"></i><span>Manage Employees</a></span></li>';
          echo '<li class=""><a href="config.php"><i class="fa fa-sliders"></i><span>Configure </a></span></li>';
          echo '<li class=""><a><img src="../img/twilio.ico" alt="Icon" width="16px" height="16px"/></image><span> Twilio Configure<span class="badge badge-pill badge-success">Premium</span></a></span></li>';
          echo '<li class=""><a href="subscription_details.php" ><i class="fa fa-key"></i><span>License Information </span></li>';
        }else{
          echo '<li class=""><a href="admin.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></li>';
          echo '<li class=""><a><i class="fa fa-edit"></i> <span>Forms</span></li>';
          echo '<li class=""><a href="user.php" ><i class="fa fa-users"></i> <span>Manage Users</span></li>';
          echo '<li class=""><a href="form_setting.php" ><i class="fa fa-wrench"></i> <span>Form Settings</a></span></li>';
          echo '<li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Request List
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="service_requests.php"><i class="fa fa-circle-o"></i>Service</a></li>
            <li><a href="application_requests.php"><i class="fa fa-circle-o"></i>Application</a></li>
          </ul>
        </li>';
          echo '<li class=""><a href="employee.php"><i class="fa fa-users"></i> <span>Manage Employees</a></span></li>';
          echo '<li class=""><a href="config.php"><i class="fa fa-sliders"></i> <span>Configure</span></li>';
          echo '<li class=""><a><img src="../img/twilio.ico" alt="Icon" width="16px" height="16px"/></image><span> Twilio Configure<span class="badge badge-pill badge-success">Premium</span></span></li>';
          echo '<li class=""><a href="subscription_details.php" ><i class="fa fa-key"></i><span>License Information </span></li>';
        }
      }

      if($_SESSION['package']==3){
        if($directoryURI=="admin.php"){
          echo '<li class=""><a><i class="fa fa-dashboard"></i> <span>Dashboard</span></li>';
          echo '<li class=""><a href="form.php" ><i class="fa fa-edit"></i> <span>Forms</span></li>';
          echo '<li class=""><a href="user.php" ><i class="fa fa-users"></i> <span>Manage Users</span></li>';
          echo '<li class=""><a href="form_setting.php"  ><i class="fa fa-wrench"></i> <span>Form Settings</a></span></li>';
          echo '<li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Request List
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="service_requests.php"><i class="fa fa-circle-o"></i>Service</a></li>
            <li><a href="application_requests.php"><i class="fa fa-circle-o"></i>Application</a></li>
          </ul>
        </li>';
          echo '<li class=""><a href="employee.php"><i class="fa fa-users"></i> <span>Manage Employees</a></span></li>';
          echo '<li class=""><a href="config.php"><i class="fa fa-sliders"></i><span>Configure </a></span></li>';
          echo '<li class=""><a href="twilio_setting.php"><img src="../img/twilio.ico" alt="Icon" width="16px" height="16px"/></image><span> Twilio Configure</a></span></li>';
          echo '<li class=""><a href="subscription_details.php" ><i class="fa fa-key"></i><span>License Information </span></li>';
        }else{
          echo '<li class=""><a href="admin.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></li>';
          echo '<li class=""><a href="form.php" ><i class="fa fa-edit"></i> <span>Forms</span></li>';
          echo '<li class=""><a href="user.php" ><i class="fa fa-users"></i> <span>Manage Users</span></li>';
          echo '<li class=""><a href="form_setting.php" ><i class="fa fa-wrench"></i> <span>Form Settings</a></span></li>';
          echo '<li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i>Request List
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="service_requests.php"><i class="fa fa-circle-o"></i>Service</a></li>
            <li><a href="application_requests.php"><i class="fa fa-circle-o"></i>Application</a></li>
          </ul>
        </li>';
          echo '<li class=""><a href="employee.php"><i class="fa fa-users"></i> <span>Manage Employees</a></span></li>';
          echo '<li class=""><a href="config.php"><i class="fa fa-sliders"></i> <span>Configure</span></li>';
          echo '<li class=""><a href="twilio_setting.php"><img src="../img/twilio.ico" alt="Icon" width="16px" height="16px"/></image><span> Twilio Configure</span></li>';
          echo '<li class=""><a href="subscription_details.php" ><i class="fa fa-key"></i><span>License Information </span></li>';
        }
      }

    echo'</ul>';

?>
