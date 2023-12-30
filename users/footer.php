<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>SFXC Inventory System</p>
        </div>

    </div>
</footer>
</div>
</div>

<script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendors/apexcharts/apexcharts.js"></script>
<script src="../../assets/js/pages/dashboard.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/sweetalert.min.js"></script>
<script src="../../assets/js/framework.js"></script>
<script src="../../assets/js/html5-qrcode.min.js"></script>

<script src="../../assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/vendors/datatables/dataTables.bootstrap4.min.js"></script>


<script src="../../assets/vendors/datatables/datatables-demo.js"></script>




</body>

</html>

<script>
    function reFresh() {
        location.reload();
    }

    function scan_modal() {

        $('#qr_Modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#qr_Modal').modal('show');


        function onScanSuccess(qrCodeMessage) {
            $.ajax({
                type: "POST",
                url: "item_scan/item_scan.php",
                dataType: 'JSON',
                data: {
                    qr_message: qrCodeMessage
                },
            }).done(function(res) {
                $('#model').html('Model: ' + res.model);
                $('#brand').html('Brand: ' + res.brand);
                $('#specs').html('Specifications: ' + res.specs);
                $('#issued_to').html('Issued To: ' + res.fname + ' ' + res.lname);
                $('#item_code').html('Item Code: ' + res.item_code);
                $('#department').html('Department: ' + res.department);
                $('#qr_Modal').modal('hide');
                $('#show_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#show_modal').modal('show');

            }).fail(function() {
                alert('Item Not Recognized');
            })

        }

        const html5QrCode = new Html5Qrcode("reader", /*verbose*/ true);
        var config = {
            fps: 10, // sets the framerate to 10 frame per second
            qrbox: 200 // sets only 250 X 250 region of viewfinder to
            // scannable, rest shaded.
        };
        html5QrCode.start({
            facingMode: "environment"
        }, config, onScanSuccess).catch(err => {
            // handle err
            console.log(err);
        });
    }

    // //DOCUEMTN READY
    // $(document).ready(function() {

    //     $('#form_inventory').submit(function(e) {
    //         e.preventDefault();

    //         let issuance_id = $('#issuance_id').val();
    //         let inventory_status = $('#edit_status').val();
    //         let qr_code          = $('#qr_code').val();
    //         $.ajax({

    //             url: 'item_scan/item_inventory.php',
    //             type: 'POST',
    //             data: {
    //                 issuance_id     : issuance_id,
    //                 inventory_status: inventory_status,
    //                 qr_code         : qr_code
    //             },
    //             dataType: 'JSON',
    //             beforeSend: function() {

    //             }
    //         }).done(function(res) {
    //             if (res.res_success == 1) {
    //                 swal({
    //                     text: "Success!",
    //                     icon: "success",
    //                 });
    //                 $('#show_modal').modal('hide');
    //             } else {
    //                 alert(res.res_message);
    //             }
    //         }).fail(function() {
    //             console.log('Fail!');
    //         });

    //     })

    // })
</script>

<script>
    //============================================POP UP CENTER=======================================================>
    const popupCenter = ({
        url,
        title,
        w,
        h
    }) => {
        // Fixes dual-screen position                             Most browsers      Firefox
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft
        const top = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow = window.open(url, title,
            `
      			scrollbars=yes,
      			width=${w / systemZoom}, 
      			height=${h / systemZoom}, 
      			top=${top}, 
      			left=${left}
      			`
        )

        if (window.focus) newWindow.focus();
    }
</script>