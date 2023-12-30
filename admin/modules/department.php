<?php
include('../header.php');
?>
<div class="page-heading">
    <h3>Departments</h3>
</div>

<div>
    <button data-bs-toggle="modal" data-bs-target="#list_add_modal" class="btn btn-primary" id="add_students"><i class="fa fa-plus"></i> Add Department</button>
</div><br>

<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Department</th>
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
include('modals/modal_department.php');
include('../footer.php');
?>
<script>
    function department_delete(department_id) {
        $('#delete_department_id').val(department_id);
        $('#delete_modal').modal('show');
    }

    function department_edit(department_id) {
        $.ajax({
            url: 'department/department_edit.php',
            type: 'POST',
            data: {
                department_id: department_id
            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            $("#edit_department_id").val(res.department_id);
            $("#edit_department").val(res.department);
            $('#list_edit_modal').modal('show');

        })

    }
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'department/department.php', // API endpoint to fetch data
            columns: [{
                    data: [0],
                    "className": "text-center"
                },
                {
                    data: [1],
                    "className": "text-center"
                }
            ]
        });

        // ADD Department
        $('#form_insert').submit(function(e) {
            e.preventDefault();

            let department = $('#add_department').val();


            $.ajax({
                url: 'department/department_add.php',
                type: 'POST',
                data: {
                    department: department

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Added');
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

        $('#form_update').submit(function(e) {
            e.preventDefault();

            let department_id = $('#edit_department_id').val();
            let department = $('#edit_department').val();


            $.ajax({
                url: 'department/department_update.php',
                type: 'POST',
                data: {
                    department: department,
                    department_id: department_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Updated');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#list_edit_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })

        })


        $('#delete_form').submit(function(e) {
            e.preventDefault();

            let delete_id = $('#delete_department_id').val();

            $.ajax({
                url: 'department/department_delete.php',
                type: 'POST',
                data: {
                    delete_id : delete_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Deleted');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#delete_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })

        })




    })
</script>