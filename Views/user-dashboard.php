<?php include 'dashboard-header.php'?>
      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
          <!-- End Breadcrumbs-->
          
          <div class='row'>
          <?php
          $sql = $conn->query("SELECT * FROM adminspanel") or die($conn->error);
          $cardHeaders = array();
          foreach ($sql as $ind) {
            $color = $ind['color'];
            $arraytopush = array(
              "color"   => $ind['color'],
              "icon"    => $ind['icon'],
              "message" => $ind['message'],
              "unread"  => "0",
              "link"    => $ind['link']
            );
            array_push($cardHeaders, $arraytopush);
          }
            foreach ($cardHeaders as $key => $ind) {
              $bgColor = $ind['color'];
              $faIcon = $ind['icon'];
              $number = $ind['unread'];
              $message = $ind['message'];
              $link = $ind['link'];
              echo '
              <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-'.$bgColor.' o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="'.$faIcon.'"></i>
                  </div>
                  <div class="mr-5">'.$number . ' ' . $message .'</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="'.$link.'">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            ';
            }
          ?>

          <!--   Area Chart
          <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Area Chart Example</div>
              <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>
          -->


        <?php include 'dashboard-footer.php'?>
