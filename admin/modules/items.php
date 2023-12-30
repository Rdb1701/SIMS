<?php
include('../header.php');
?>

<div class="page-heading">
  <h3>Items</h3>
</div>

<div>
  <button onclick="item_add()" class="btn btn-primary" id="add_students"><i class="fa fa-plus"></i> Add Item</button>
</div><br>

<div class="page-content">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table " id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Photo</th>
              <th class="text-center">Model</th>
              <th class="text-center">Category</th>
              <th class="text-center">Brand</th>
              <th class="text-center">Specification</th>
              <th class="text-center">Raw Stock</th>
              <th class="text-center">Quantity left</th>
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
include('modals/item_modal.php');
include('../footer.php');
?>

<script>
  //EDIT ITEM
  function edit_item(item_id, item_stock_id) {

    $.ajax({
      url: 'items/item_edit.php',
      type: 'POST',
      data: {
        item_id: item_id,
        item_stock_id: item_stock_id
      },
      dataType: 'JSON',
      beforeSend: function() {

      }
    }).done(function(res) {

      $("#edit_item_id").val(res.item_id);
      $("#edit_item_stock_id").val(res.item_stock_id)
      $("#edit_model").val(res.model);
      $("#edit_category").val(res.category);
      $("#edit_brand").val(res.brand);
      $("#edit_quantity").val(res.stock);
      $("#edit_price").val(res.price);
      $("#edit_desc").val(res.item_desc);
      $("#edit_type").val(res.type);
      $('#list_edit_modal').modal({
        backdrop: 'static',
        keyboard: false
      }, 'show');
      $('#list_edit_modal').modal('show');
    })

  }

  // ADD MODAL
  function item_add() {
    $('#list_add_modal').modal({
      backdrop: 'static',
      keyboard: false
    }, 'show');
    $('#list_add_modal').modal('show');
  }

  //ITEM UPLAOD
  function item_upload(item_id) {
    $('#item_id').val(item_id);
    $('#upload_modal').modal({
      backdrop: 'static',
      keyboard: false
    }, 'show');
    $('#upload_modal').modal('show');

  }

  function item_add_stock(item_id, item_stock_id) {
    $('#quantity_item_id').val(item_id);
    $('#quantity_item_stock_id').val(item_stock_id);
    $('#add_quantity_modal').modal('show');

  }

  //DELETE ITEM
  function delete_item(item_id, item_stock_id) {
    $('#delete_item_id').val(item_id);
    $('#delete_item_stock_id').val(item_stock_id);
    $('#delete_modal').modal({
      backdrop: 'static',
      keyboard: false
    }, 'show');
    $('#delete_modal').modal('show');

  }


  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#myTable').DataTable({
      ajax: 'items/items.php', // API endpoint to fetch data
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
        },
        {
          data: [7],
          "className": "text-center"
        }
    

      ]
    });


    //============================================ UPLOAD PICTURE =========================================>

    $("#upload_form").on("submit", function(e) {
      e.preventDefault();

      var fd = new FormData($("#upload_form")[0]);
      var files = $("#file")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('file', files[0]);


        $.ajax({
          url: 'items/item_upload.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert('Successfully Uploaded');
              var currentPageIndex = table.page.info().page;
              table.ajax.reload(function() {
                table.page(currentPageIndex).draw(false);
              }, false);

              $('#upload_modal').modal('hide');
            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })

    $('#form_insert').submit(function(e) {
      e.preventDefault();

      let model = $('#add_model').val()
      let category = $('#add_category').val()
      let brand = $('#add_brand').val()
      let quantity = $('#add_quantity').val()
      let price = $('#add_price').val()
      let desc = $('#add_desc').val()
      let type = $('#add_type').val()

      let errors = new Array();
      let input = "Please Input";

      if (model == '')
        errors.push("Model")
      if (category == '')
        errors.push("Category")
      if (brand == '')
        errors.push("brand")
      if (quantity == '')
        errors.push("Quantity")
      if (price == '')
        errors.push("Price")
      if (desc == '')
        errors.push('Description')
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
          url: 'items/item_add.php',
          type: 'POST',
          data: {
            model: model,
            category: category,
            brand: brand,
            stock: quantity,
            price: price,
            desc: desc,
            type: type
          },
          dataType: 'JSON',
          beforeSend: function() {}
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Added an Item');
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

      }
    })


    //--------------------------------------------UPDATE Items---------------------------------------//
    $('#form_update').on('submit', function(e) {
      e.preventDefault();


      let item_id = $("#edit_item_id").val();
      let item_stock_id = $("#edit_item_stock_id").val()
      let model = $("#edit_model").val();
      let category = $("#edit_category").val();
      let brand = $("#edit_brand").val();
      let quantity = $("#edit_quantity").val();
      let price = $("#edit_price").val();
      let desc = $("#edit_desc").val();
      let type = $("#edit_type").val();

      let errors = new Array();
      let input = "Please Input";


      if (model == '')
        errors.push("Model")

      if (category == '')
        errors.push("Category")

      if (brand == '')
        errors.push("brand")

      if (quantity == '')
        errors.push("Quantity")

      if (price == '')
        errors.push("Price")

      if (desc == '')
        errors.push('Description')

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
          url: 'items/item_update.php',
          type: 'POST',
          data: {
            model: model,
            category: category,
            brand: brand,
            stock: quantity,
            price: price,
            desc: desc,
            item_id: item_id,
            item_stock_id: item_stock_id,
            type: type
          },
          dataType: 'JSON',
          beforeSend: function() {}
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Updated!');
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

      }
    })

    //------------------------------------DELETE ITEM---------------------------------------->

    $('#delete_form').submit(function(e) {
      e.preventDefault();

      let item_id = $('#delete_item_id').val();
      let item_stock_id = $('#delete_item_stock_id').val();

      $.ajax({
        url: 'items/item_delete.php',
        type: 'POST',
        data: {
          item_id: item_id,
          item_stock_id: item_stock_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Deleted!');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);

          $('#delete_modal').modal('hide');
        } else {
          alert(res.res_message);
        }
      }).fail(function() {
        console.log('Fail!');
      });

    })


    //-----------------------------------ADD QUANTITY---------------------------------------->

    $('#quantity_form').submit(function(e) {
      e.preventDefault();

      let item_id = $('#quantity_item_id').val();
      let item_stock_id = $('#quantity_item_stock_id').val();
      let add_quantity = $('#add_quantity_stock').val();

      $.ajax({
        url: 'items/item_add_quantity.php',
        type: 'POST',
        data: {
          item_id: item_id,
          item_stock_id: item_stock_id,
          add_quantity: add_quantity
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Added Quantity!');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);

          $('#add_quantity_modal').modal('hide');
        } else {
          alert(res.res_message);
        }
      }).fail(function() {
        console.log('Fail!');
      });

    })




    //DOCUMENT READY
  })
</script>