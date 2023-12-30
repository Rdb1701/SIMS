<?php
include('../header.php');

$users        = '';
$issued_items = '';
$inventory    = '';
?>
<div class="row show-grid">
  <!-- Customer ROW -->
  <div class="col-md-4">
    <!-- students records -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">No. of Users</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                <?php
                $query = "SELECT COUNT(*) FROM tbl_users";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) {
                  echo "$row[0]";
                  $users =  $row[0];
                }
                ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-users"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-md-4">
    <!-- Request record -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">No. of Issued items</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                <?php
                $query = "SELECT COUNT(*) FROM tbl_issuance_transaction";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) {
                  echo "$row[0]";
                  $issued_items =  $row[0];
                }
                ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-clipboard"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <!-- Approved record -->
    <div class="col-md-12 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">No. of Inventories</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
                <?php
                $query = "SELECT COUNT(*) FROM tbl_inventory";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) {
                  echo "$row[0]";
                  $inventory =  $row[0];
                }
                ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-clipboard-check"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <canvas id="bar_graph"></canvas>

  <?php
  include('../footer.php');
  ?>
  <script src="../../assets/js/chart.min.js"></script>

  <script>
    const ctx = document.getElementById('bar_graph');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Users', 'Issued Items', 'Inventories'],
        datasets: [{
          label: 'Dashboard',
          data: [<?php echo $users; ?>, <?php echo $issued_items; ?>, <?php echo $inventory; ?>],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>