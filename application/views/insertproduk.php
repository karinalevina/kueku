<?php
	$no_visible_elements = true;
	require('assets/header.php'); ?>
	<head>
		<script>
			$(function() {
				var activeTab = $('[href=' + location.hash + ']');
				activeTab && activeTab.tab('show');
			});
		</script>
	</head>
	<body>

	<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"> 
                <span>KueKu</span></a>

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span
                        class="hidden-sm hidden-xs"> Profile</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> History</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Ubah Data Diri</a></li>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i> Halaman Utama</a></li>
                <li class="dropdown">
                <li>
					<input placeholder="Search" class="search-query form-control col-md-10" name="query" type="text">
                    
                </li>
				<li>
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</li>
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
	 <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">
                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li>
							<a class="ajax-link" href="#"><i class="glyphicon glyphicon-home"></i><span> JualanKu</span></a>
                        </li>
                        <li>
							<a href= "<?php echo base_url(); ?>index.php/resto_con/halrating"><i class="glyphicon glyphicon-eye-open"></i><span> Rating & Review</span></a>
                        </li>
                        <li>
							<a href= "<?php echo base_url(); ?>index.php/login_con/index"><i class="glyphicon glyphicon-lock"></i><span> Halaman Login</span></a>
                        </li>
						<li>
							<a href= "<?php echo base_url(); ?>index.php/login_con/registrasi"><i class="glyphicon glyphicon-lock"></i><span> Halaman Sign Up</span></a>
                        </li>
                    </ul>
						<?php 
								if (null != $this->session->userdata('username')) {
									$username=$this->session->userdata('username');
									 ?> <a class="navbar-brand"><font size="1"> <?php echo "Selamat Datang, ".$username;
								}
							?></font></a>					
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->
		
		<div id="content" class="col-lg-10 col-sm-10">
		<!-- content starts -->
        <div>		
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>">Home</a>
        </li>
		<li>
            <a href="<?php echo base_url(); ?>index.php/resto_con/do_logout">Logout</a>
        </li>

	</ul>
	</div>
	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Perkenalan</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h1>KueKu <br>
                        <small>Aplikasi Jual Beli Kue di Makassar</small>
                    </h1>
                    <p><b>Ini adalah aplikasi jual beli kue yang mengutamakan standar dalam setiap elemen di dalamnya</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="Kelola Barang Dagangan" class="well top-block" href="#kelola">            
			<i class="glyphicon glyphicon-hand-down blue"></i>
            <div>Kelola KueKu</div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="Menambah Kue Jualan" class="well top-block" href="#tmbhKue">            
			<i class="glyphicon glyphicon-ok blue"></i>
            <div>Tambah Kue</div>
        </a>
    </div>
	
	<div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="Daftar Pesanan" class="well top-block" href="#order">            
			<i class="glyphicon glyphicon-heart blue"></i>
            <div>Pesanan</div>
        </a>
    </div>
</div>

<div class="tab-content">
    <div id="kelola" class="tab-pane fade in active">
	<center>
	<?php
		foreach($kelKue as $row){
			echo "<div id='item'>
					<div class='col-md-3 col-sm-6'>
						<div class='product-item'>
							<div class='product-thumb'>					
								<div class='product-content'>";
			echo "<h3><strong>".$row->nmkue."</strong></h3>";
			echo "<a class='well top-block'>Rp ".$row->hrg."</a><br>
				<img src='/assets/img/produk/".$row->gambar."'width=100px height=100px></a><br>
				<a href='#' onclick='spec(".$row->id.")'><i class='glyphicon glyphicon-edit blue'><strong>Edit</i></strong></a>";?> 
				<a href="<?php echo base_url(); ?>index.php/resto_con/hapus" onclick="document.cookie= 'id=<?php echo $row->id;?>';"><i class='glyphicon glyphicon-trash red'><strong>Hapus</i></strong></a>
								</div>
							</div>
						</div>
					</div>
				</div>
	<?php
		}
	?>
	</center>
    </div>
	
    <div id="tmbhKue" class="tab-pane fade">
		<div class="row">
		<div class="col-md-4 col-xs-6">
			<center>
				<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/resto_con/tmbhkue" method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="input-group input-group-lg">
						<span class="input-group-addon"><i class="glyphicon glyphicon-heart blue"></i></span>
						<select id="kategori" class="form-control" name="kategori">
							<option value=""> Pilih Kategori </option>
							<?php foreach ($kategori as $row) { ?>
								<option value="<?php echo $row->idkue ?>"><?php echo $row->namakue ?></option>
							<?php } ?>
						</select>
						</div>
						<div class="clearfix"></div><br>
					
						<div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up blue"></i></span>
							<input type="text" class="form-control" placeholder="Nama Kue" name="nmkue">
						</div>
						<div class="clearfix"></div><br>

						<div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase blue"></i></span>
							<input type="text" class="form-control" placeholder="Harga" name="hrg">
						</div>
						<div class="clearfix"></div><br>

						<div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="glyphicon glyphicon-picture blue"></i></span>
							<input type="file" class="form-control" name="berkas" id="exampleInputFile">
						</div>
						<div class="clearfix"></div><br>
						
						<p class="center col-md-5">
							<button class="well top-block"><strong>Simpan</strong></button></a>
							
						</p>
					</fieldset>
				</form>
			</center>
		</div>
		<div class="col-md-6"> 
            <h3><i class="glyphicon glyphicon-info-sign blue"> Syarat dan Ketentuan</i></h3>

            <p>Dengan Memilih Untuk Menyimpan Data Produk, Berarti Anda Menyetujui Semua Syarat dan Ketentuan yang Berlaku:</p>
            <ul>
                <li>Kue yang didaftarkan memenuhi setiap standar yang sudah ditetapkan</li>
                <li>Mengirimkan pesanan yang ada dengan tepat waktu sesuai permintaan pembeli</li>
                <li>Bersedia diberi sanksi jika melanggar salah satu persyaratan</li>
            </ul>
        </div>
		</div>
    </div>
	
	<div id="order" class="tab-pane fade">
	<center>
		<div class="form-group has-success">
			<label class="radio-inline">
				<input type="radio" name="order" id="b" value="b" onclick="belanja('0');" checked><strong> Order Baru
			</label>
			<label class="radio-inline">
				<input type="radio" name="order" id="dp" value="dp" onclick="belanja('1');"><strong> Dalam Proses
			</label>
			<label class="radio-inline">
				<input type="radio" name="order" id="t" value="t" onclick="belanja('2');"><strong> Tolak
			</label>
			<label class="radio-inline">
				<input type="radio" name="order" id="s" value="s" onclick="belanja('3');"><strong> Selesai
			</label><br>
		</div>
		<div id="cari"></div>
	</center>
		<div id="pesanan">
			<?php echo $pesanan; ?>
		</div>
	</div>
</div>

<script>
	function belanja(pros){
			$.ajax({
				type:"POST",
				url : "<?php echo site_url('resto_con/statusbelanja/')?>/"+pros,
				//data : ({'proses' : pros}),
				success : function(data){
					document.getElementById("pesanan").innerHTML=data;
				},
				error: function(err,tr,ss)  {
					alert (ss);
				}
			});
		}

	function spec(id) {
		$.ajax({
		url : "<?php echo site_url('resto_con/spec/')?>/"+id,
		type : "GET",
		dataType : "JSON",
		success : function(data)
		{
			var img = "/assets/img/produk/";
			var gambar = img.concat("",data.gambar);
			$('#id').val(data.id);
			$('[id="kategori"]').html('<option value='+data.idkue+'>'+data.namakue+'</option>');
			$('#nmkue').val(data.nmkue);
			$('#hrg').val(data.hrg);
			$('#gambar').prop('src', gambar);
			$('#myModalDetail').modal('show');
		},
				error: function(jqXHR, exception) {
					alert(errorThrown);
				}
		});
	}	
	
	function tampilkat() {
		$.ajax({
			url : "<?php echo site_url('resto_con/tampilkat/')?>",
			type : "GET",
			success : function(data) {
				$('[name="kategori"]').html(data);
			},
			error : function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		});
	}

	function showform() {
		$('#myModalDetail').modal('show');
	}
</script>			
			
<div class="modal fade" id="myModalDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" action="<?php echo base_url(); ?>resto_con/editkue" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h3 id = "namaRm">Keterangan Kue</h3>
						<input type="hidden" id="id" name="id">
					</div>					  
                    <div class="modal-body">
						<div class="row">
							<select id="kategori" class="form-control" name="kategori" id="kategori" onmousedown="tampilkat();">
							</select>
						</div>
						<div class="clearfix"></div><br>
						<div class="row">
							<div class="col-md-4 col-xs-4">Nama Kue</div>
							<div class="col-md-8 col-xs-8"><input type="text" id="nmkue" name="nmkue"></div>
							<div class="clearfix"></div><br>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4">Harga</div>
							<div class="col-md-8 col-xs-8"><input type="text" id="hrg" name="hrg"></div>
							<div class="clearfix"></div><br>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4">Gambar</div>
							<div class="col-md-8 col-xs-8"><img id="gambar" name="gambar" alt style= "width:100px;height:50px;"></div>
							<div class="clearfix"></div><br>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4">Upload</div>
							<div class="col-md-8 col-xs-8"><input type="file" name="berkas" id="exampleInputFile"></div>
							<div class="clearfix"></div><br>
						</div>						
							<thead>
								</tr>
							</thead>
							<tbody id="isiDetail">
							</tbody>
						</table>
                    <div class="modal-footer">					  
						<button type="submit" class="btn btn-primary btn-round btn-lg"><strong>Simpan</strong></button>
                        <a href="#" class="btn btn-primary btn-round btn-lg" data-dismiss="modal"><strong>Tutup</strong></a>                
                    </div>
                </form>
            </div>
        </div>
    </div>			
	 	
<!--<div class="modal fade" id="myModalDetail1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" action="index.php/resto_con/tmbhkue" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h3 id = "namaRm">Syarat dan Ketentuan</h3>     
						<input type="hidden" name="idmember" id="idmember" value="">
					</div>					  
                    <div class="modal-body">      
						<table border=0 width=80%>
							<thead>
								<tr>
									Dengan Memilih Untuk Menyimpan Data Produk, Berarti Anda Menyetujui Semua Syarat dan Ketentuan yang Berlaku:<br>									
										<label class="checkbox-inline">
											<input type="checkbox" id="inlineCheckbox1" value="option1"> Kue yang didaftarkan memenuhi setiap standar yang sudah ditetapkan
										</label><br>
										<label class="checkbox-inline">
											<input type="checkbox" id="inlineCheckbox2" value="option2"> Mengirimkan pesanan yang ada dengan tepat waktu
										</label><br>
										<label class="checkbox-inline">
											<input type="checkbox" id="inlineCheckbox3" value="option3"> Bersedia diberi sanksi jika melanggar salah satu persyaratan
										</label><br>
								</tr>
							</thead>
							<tbody id="isiDetail">
							</tbody>
						</table>
                    <div class="modal-footer">					  
						<button type="submit" class="btn btn-primary btn-round btn-lg"><strong>Simpan</strong></button>
                        <a href="#" class="btn btn-primary btn-round btn-lg" data-dismiss="modal"><strong>Tutup</strong></a>                
                    </div>
                </form>
            </div>
        </div>
    </div>	
</div>-->	
			
	<footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="" target="_blank">Karina Levina
                Witanto</a> SI 2013</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="">Karina</a></p>
    </footer>

<?php require('assets/footer.php'); ?>