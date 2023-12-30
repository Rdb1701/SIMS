<?php
include('../header.php');
?>

<div class="page-heading">
    <h3>Category</h3>
</div>

<div>
    <button data-bs-toggle="modal" data-bs-target="#list_add_modal" class="btn btn-primary" id="add_students"><i class="fa fa-plus"></i> Add Category</button>
</div><br>

<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Category</th>
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
include('modals/modal_category.php');
include('../footer.php');
?>

<script>

function category_delete(category_id) {
        $('#delete_category_id').val(category_id);
        $('#delete_modal').modal('show');
    }

function category_edit(category_id) {
        $.ajax({
            url: 'category/category_edit.php',
            type: 'POST',
            data: {
                category_id : category_id
            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            $("#edit_category_id").val(res.category_id);
            $("#edit_category").val(res.category);
            $('#list_edit_modal').modal('show');

        })

    }

$(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'category/category.php', // API endpoint to fetch data
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
            let category = $('#add_category').val();

            $.ajax({
                url: 'category/category_add.php',
                type: 'POST',
                data: {
                    category: category

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

            let category_id = $('#edit_category_id').val();
            let category = $('#edit_category').val();


            $.ajax({
                url: 'category/category_update.php',
                type: 'POST',
                data: {
                    category    : category,
                    category_id : category_id

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

            let delete_id = $('#delete_category_id').val();

            $.ajax({
                url: 'category/category_delete.php',
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