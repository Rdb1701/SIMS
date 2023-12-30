<?php
include('../header.php');
// include('users/user.php');
?>

<div class="page-heading">
  <h3>User</h3>
</div>

<div>
  <button data-bs-toggle="modal" data-bs-target="#list_add_modal" class="btn btn-primary" id="add_students"><i class="fa fa-plus"></i> Add User</button>
</div><br>

<div class="page-content">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table " id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Username</th>
              <th class="text-center">Name</th>
              <th class="text-center">Email</th>
              <th class="text-center">Department</th>
              <th class="text-center">Type</th>
              <th class="text-center">Action</th>
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
include('modals/user_modal.php');
?>


<script>
  //------------------------------CHANGE PASSWORD----------------------------------//
  function list_changepassword(user_id, username) {

    $('#cp_id').val(user_id);
    $('#cp_username').val(username);
    $('#changepassword_modal').modal('show');

  }

  //EDIT USER
  function user_edit(user_id) {

    $.ajax({
      url: 'users/user_edit.php',
      type: 'POST',
      data: {
        user_id: user_id
      },
      dataType: 'JSON',
      beforeSend: function() {
        $('#btn_edit').prop("disabled", true);
      }
    }).done(function(res) {

      let html = '';

      html += (res.gender == '1') ? '<option value="1" selected >Male</option>' : '<option value="1">Male</option>';
      html += (res.gender == '0') ? '<option value="0" selected >Female</option>' : '<option value="0">Female</option>';
      $("#edit_gender").val(res.gender);

      $("#edit_user_id").val(res.user_id);
      $("#edit_username").val(res.username);
      $("#edit_lname").val(res.lname);
      $("#edit_fname").val(res.fname);
      $("#edit_email").val(res.email);
      $("#edit_department").val(res.department);
      $('#edit_user_type_id').val(res.user_type_id);
      $('#list_edit_modal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $('#list_edit_modal').modal('show');

    })
  }

  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#myTable').DataTable({
      ajax: 'users/user.php', // API endpoint to fetch data
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
        }
      ]
    });


    $('#form_insert').submit(function(e) {
      e.preventDefault();

      let username = $('#add_username').val();
      let fname = $('#add_fname').val();
      let lname = $('#add_lname').val();
      let gender = $('#add_gender').val();
      let email = $('#add_email').val();
      let user_type_id = $('#add_user_type_id').val();
      let department = $('#add_department').val();


      $.ajax({
        url: 'users/user_add.php',
        type: 'POST',
        data: {
          username: username,
          fname: fname,
          lname: lname,
          gender: gender,
          email: email,
          user_type_id: user_type_id,
          department: department
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Your password is your username');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);

          $('#list_add_modal').modal('hide');
        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })

    })

    // ---------------------UPDATE edit user----------------------------------------//

    $('#form_update').on('submit', function(e) {
      e.preventDefault();

      let user_id = $('#edit_user_id').val();
      let lname = $('#edit_lname').val();
      let fname = $('#edit_fname').val();
      let gender = $('#edit_gender').val();
      let email = $('#edit_email').val();
      let department = $('#edit_department').val();
      let user_type = $('#edit_user_type_id').val();
      $.ajax({

        url: 'users/user_update.php',
        type: 'POST',
        data: {
          user_id: user_id,
          lname: lname,
          fname: fname,
          gender: gender,
          email: email,
          department: department,
          user_type: user_type
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Update Information')
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);

          $('#list_edit_modal').modal('hide');
        } else {
          alert(res.res_message);
        }
      }).fail(function() {
        console.log('Fail!');
      });
    })


    // -----------------------CHANGE PASSWORD AJAX----------------------------- //
    $('#d_form_cp').on('submit', function(e) {
      e.preventDefault();

      let user_id = $('#cp_id').val();
      let new_password = $('#cp_new_password').val()
      let re_new_password = $('#cp_re_new_password').val()

      if (new_password == '' || re_new_password == '') {
        alert('Please input Password')
      } else if (new_password != re_new_password) {
        alert('Password do not match!')

      } else if (new_password == re_new_password) {

        $.ajax({
          url: 'users/user_changepass.php',
          type: 'POST',
          data: {
            user_id: user_id,
            new_password: new_password,
            re_new_password: re_new_password,
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Password Changed!');
            $('#changepassword_modal').modal('hide');
          } else {
            alert('Invalid Password!');

          }
        })

      }


    })
    //DOCUMENT READY
  })
</script>