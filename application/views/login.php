<?php
$no_visible_elements = true;
include('assets/header.php'); ?>

    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Selamat Datang di Resto</h2>
        </div>
    </div>

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Silahkan Login menggunakan Username dan Password Anda.<br>
				<?php
					echo $msg;
				?>
            </div>
            <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/login_con/proses" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
						
                    </p>
					Anda belum memiliki Akun? Silahkan <a href= "<?php echo base_url(); ?>index.php/login_con/registrasi"> Registrasi</a>!
                </fieldset>
            </form>
        </div>
    </div>
<?php require('assets/footer.php'); ?>