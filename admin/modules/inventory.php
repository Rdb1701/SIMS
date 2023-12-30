<?php
include('../header.php');
?>
<div class="page-heading">
    <h3>Inventory</h3>
</div>

<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <Label>Date Inventory: </Label>&nbsp;&nbsp;&nbsp;
                <div class="d-flex">
                    <input type="date" name="" id="inventory_date" class="form-control">&nbsp;&nbsp;
                    <button onclick="print_inventory()" class="btn btn-warning" id="print_inventory" style="float: right;"><i class="fa fa-print"></i> Print</button>&nbsp;
                    <button onclick="date_inventory()" class="btn btn-primary" id="print_inventory" style="float: right;">Inventory Date Records</button>
                </div><br>
                <table class="table" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Item Code</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Specifications</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Reference No.</th>
                            <!-- <th class="text-center">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: red" colspan="5">No Records Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sched_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Inventory Schedule Records</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
            <div id="myTable2">


            </div>
        </div>
        <div class="modal-footer">

        </div>
      </form>
    </div>

  </div>
</div>
        <!-- </div>
    </div>
</div> -->
<!-- 
<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <h2 class="text-center">INVENTORY DATES</h2>
                <table class="table" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Inventory Dates</th>
                      
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: red" colspan="5">No Records Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->

<?php
include('../footer.php');
?>

<script>
    function date_inventory() {

        let table = "<table class='table' id='myTable1' width='100%' cellspacing='0'>" +
            "<thead>";

        table += "<tr>" +
            "<th class=\"text-center\">Inventory Schedules</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            type: "POST",
            url: "inventory/inventory_schedules.php",
            dataType: 'JSON',
            data: {},
        }).done(function(res) {

            if (res.res_success == 1) {

                $.each(res.inventory_sched, function(key, value) {
                    table += '<tr>' +
                        '<td class="text-center">' + value.date_now + '</td>' +
                        '<tr>'

                    $('#myTable2').html(table)
                    $('#sched_modal').modal('show')
                })

            } else {
                swal({
                    text: "No Record Found",
                    icon: "warning",
                });
            }
        });
    }



    function print_inventory() {

        let inventory_date = $('#inventory_date').val();

        if (inventory_date == '') {
            swal({
                text: "Please Input Date Inventory",
                icon: "warning",
            });
        } else {
            data = 'inv_date=' + inventory_date;
            // data += 'sms_id=' + smsss_id;

            popupCenter({
                url: 'inventory/inventory_print.php?' + data,
                title: 'Items Inventory',
                w: 900,
                h: 500
            });

        }

    }


    $(document).ready(function() {

        $('#inventory_date').change(function(e) {
            e.preventDefault();
            let tvalue = this.value;
            let table = "<thead>";
            table += "<tr>" +
                "<th class=\"text-center\">Item Code</th>" +
                "<th class=\"text-center\">Item</th>" +
                "<th class=\"text-center\">Specification</th>" +
                "<th class=\"text-center\">Date</th>" +
                " <th class=\"text-center\">Status</th>" +
                " <th class=\"text-center\">Reference No.</th>" +
                "</tr>" +
                " </thead>" +
                " <tbody>";

            $.ajax({
                type: "POST",
                url: "inventory/inventory.php",
                dataType: 'JSON',
                data: {
                    tvalue: tvalue,

                },
            }).done(function(res) {

                if (res.res_success == 1) {

                    $.each(res.inventory, function(key, value) {
                        table += '<tr>' +
                            '<td class="text-center">' + value.issuance_code + '</td>' +
                            '<td class="text-center">' + value.brand + ' ' + value.model + '</td>' +
                            '<td class="text-center">' + value.specs + '</td>' +
                            '<td class="text-center">' + value.date_inserted + '</td>' +
                            '<td class="text-center">' + value.item_status + '</td>' +
                            '<td class="text-center">' + value.reference_no + '</td>' +
                            '<tr>'


                        $('#myTable').html(table)
                    })

                } else {
                    swal({
                        text: "No Record Found",
                        icon: "warning",
                    });
                }
            });

        })


    })
</script>