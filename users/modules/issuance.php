<?php
include('../header.php');
?>
<div class="page-heading">
  <h3>Issuance</h3>
</div>

<div class="page-content">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table " id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Item Code</th>
              <th class="text-center">Item Issued</th>
              <th class="text-center">Specifications</th>
              <th class="text-center">Date Issued</th>
              <!-- <th class="text-center">Action</th> -->
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
include('../footer.php');
?>

<script>

var table = $('#myTable').DataTable({
      ajax: 'issuance/issuance.php', // API endpoint to fetch data
      columns: [{
          data: [0],
          "className": "text-center"
        },
        {
          data: [1],
          "className": "text-center"
        },
        {
          data: [2],
          "className": "text-center"
        },
        {
          data: [3],
          "className": "text-center"
        }
      ]
    });
</script>