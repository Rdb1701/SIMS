<?php
include('../header.php');
?>
<div class="page-heading">
  <h3>Issuance</h3>
</div>

<div>
  <button onclick="issue_modal()" class="btn btn-primary" id="add_students"><i class="fa fa-plus"></i> Issue an Item</button>
  <button onclick="print_modal()" class="btn btn-warning" id="add_students"><i class="fa fa-print"></i> Print</button>
</div><br>

<div class="page-content">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table " id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Item Code</th>
              <th class="text-center">Department</th>
              <th class="text-center">Issued to</th>
              <th class="text-center">Item Issued</th>
              <th class="text-center">Specifications</th>
              <th class="text-center">Date Issued</th>
              <th class="text-center">Action</th>
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
include('modals/issuance_modal.php');
include('../footer.php');
?>

<script>
  function change_dept() {
    let department = $('#add_department').val();
    let table = "<label data-error='wrong' data-success='right'>Staff Name<span class='text-danger'>*</span></label>";

    table += "<select class='form-control' name='type' id = 'add_staff' required>" +
      "<option value='' selected hidden>Select Staff</option>";

    $.ajax({
      url: 'issuance/change_department.php',
      type: 'POST',
      data: {
        department: department

      },
      dataType: 'JSON',
      beforeSend: function() {

      }
    }).done(function(res) {
      if (res.res_success == 1) {
        $.each(res.users, function(key, value) {

          table += "<option value=" + value.user_id + ">" + value.fname + " " + value.lname + "</option>";

          $('#users_data').html(table)
        })


      } else {
        alert(res.res_message);
      }
    }).fail(function() {
      console.log('Fail!');
    });

  }

  function issuance_transfer(issuance_id) {
    $('#clear_id').val(issuance_id);
    $('#clear_modal').modal('show');
  }



  function qr_upload(issuance_id) {

    data = 'IssuanceID=' + issuance_id;
    // data += 'sms_id=' + smsss_id;

    popupCenter({
      url: 'issuance/item_qr.php?' + data,
      title: 'SFXC QR',
      w: 900,
      h: 500
    });


  }

  function print_modal() {
    popupCenter({
      url: 'issuance/item_qr_all.php?',
      title: 'SFXC QR',
      w: 900,
      h: 500
    });

  }

  function issue_modal() {
    $('#issuance_modal').modal('show');
  }


  $(document).ready(function() {
    // Initialize DataTable
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
        },
        {
          data: [4],
          "className": "text-center"
        },
        {
          data: [5],
          "className": "text-center"
        },
        {
          data: [6],
          "className": "text-center"
        }
      ]
    });

    $('#form_issue').submit(function(e) {
      e.preventDefault();

      let item_id = $('#add_item').val();
      let staff_id = $('#add_staff').val();
      let add_date = $('#add_date').val();

      let errors = new Array();
      let input = "Please Input";

      if (add_date == '')
        errors.push("Date")

      if (errors.length > 0) {
        let error = '';
        $.each(errors, function(key, value) {
          if (error == '') {
            error += '• ' + value;
          } else {
            error += '\n• ' + value;
          }
        });
        alert(input + '\n' + error);

      } else {

        $.ajax({
          url: 'issuance/add_issue.php',
          type: 'POST',
          data: {
            item_id: item_id,
            staff_id: staff_id,
            add_date: add_date

          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Issued an Item');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);

            $('#issuance_modal').modal('hide');

          } else {
            alert(res.res_message);
          }
        }).fail(function() {
          console.log('Fail!');
        });
      }

    })


    $('#clear_form').submit(function(e) {
      e.preventDefault();

      let clear_id = $('#clear_id').val();

      $.ajax({
        url: 'issuance/issuance_clear.php',
        type: 'POST',
        data: {
          clear_id: clear_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully clear the item');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);

          $('#clear_modal').modal('hide');

        } else {
          alert(res.res_message);
        }
      }).fail(function() {
        console.log('Fail!');
      });


    })


    //  $('#add_department').change(function(e){
    //   e.preventDefault();
    //   let pvalue = this.value;

    //   if(pvalue == ''){

    //   }

    //  })




    //DOCUMENT READY
  })
</script>