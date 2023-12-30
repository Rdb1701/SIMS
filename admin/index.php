<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFXC || LOG IN
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/pages/auth.css">
    <link rel="shortcut icon" href="../assets/images/sfxc.png" type="image/x-icon">
</head>

<body>
    <section class="vh-100 bg-success">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="../assets/images/sfxc.png"
                      alt="" class="img-fluid" style="border-radius: 1rem 0 0 1rem; width:500%;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form id="form1">
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                          <span class="h1 fw-bold mb-0"><img src="../assets/images/logo.png" alt="" width="100%"></span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Admin Log in</h5>
      
                        <div class="form-outline mb-4">
                          <input type="text" id="username" class="form-control form-control-lg" />
                          <label class="form-label" for="username">Username</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" id="password" class="form-control form-control-lg" />
                          <label class="form-label" for="password">Password</label>
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button class="btn btn-success btn-lg btn-block" type="submit">Login</button>
                        </div>
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



      <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>

<script>


    $(document).ready(function(){

   //-------------------------- LOG IN -----------------------------------//
   
    $('#form1').submit(function(e){
      e.preventDefault();

    let username = $('#username').val();
    let password = $('#password').val();

    if(username == ""){
      alert('Please Enter Username');
    }else if (username == "" && password == ""){
      alert('Please Enter Username & Password');
    }else if(password == ""){
      alert('Please Enter Password');
    }else {

      $.ajax({
        url            : 'backend/signin.php',
        type           : 'POST',
        data           : {
                        username: username,
                        password: password
                        },
        dataType       : 'JSON',
        beforeSend     : function(){

        }
      }).done(function(res){

        if(res.res_success == 1){

          window.location = 'modules/dashboard.php';
        }else{
          alert(res.res_message);
        }

      }).fail(function(){
          console.log('FAIL!');
      })


    }


   })

  
   //document ready
 })



</script>