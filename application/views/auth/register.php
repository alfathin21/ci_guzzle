<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row justify-content-center">

        <div class="col-lg-8">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Registrasi Akun Sekarang !</h1>
            </div>
            <form class="user" action="<?= base_url('auth/register')?>" method="post">
              <div class="form-group ">

                <input type="text" value="<?php echo set_value('nama'); ?>" name="nama" class="form-control form-control-user" id="nama" placeholder=" Nama Lengkap ">
                <?php echo form_error('nama', '<small class="text-danger pl-2">', '</small>'); ?>
              </div>
              <div class="form-group">
                <input value="<?php echo set_value('email'); ?>" type="text" name="email" class="form-control form-control-user" id="email" placeholder="Alamat E-mail">
                <?php echo form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" name="password1" class="form-control form-control-user" id="password1" placeholder="Password">
                     <?php echo form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Repeat Password">
                </div>
              </div>
              <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                Register Akun
              </button >
             
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="forgot-password.html">Forgot Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>