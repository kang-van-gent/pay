<style>
    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: normal;
    }
    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
                <!-- Page Content -->
                

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
         <form class="form-signin" role="form" method="post" id="frm_login" 
    onsubmit="return LogIn();return false;">
    {csrf_protection_field}

            <div class="form-group">
              <div class="form-label-group">
                           
             <input type="text" name="input_username"  id="input_username" class="form-control" 
        placeholder="ชื่อล็อกอิน" required autofocus>               
            <label for="input_username">Username</label>

              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
               <input type="password" name="input_password"  id="input_password" class="form-control"          
        placeholder="รหัสผ่าน" required autofocus>  
                <label for="input_password">Password</label>
              </div>
            </div>
<!--             <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div> -->
        <!--     <a class="btn btn-primary btn-block" href="http://localhost/emp/index.php/example_pages/sb-admin-bs4/index">Login</a> -->
             <button class="btn btn-lg btn-primary btn-block" id="btn_login" type="submit">เข้าสู่ระบบ</button>

          </form>

          <div class="text-center">
    
            <a class="d-block small" href="forgot_password">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>


