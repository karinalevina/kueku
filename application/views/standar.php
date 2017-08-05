<?php
	$no_visible_elements = true;
	require('assets/header.php'); ?>
	<head>
	
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
            <a class="navbar-brand" href="#"> 
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
                    <!--<li><a data-value="cyborg" href="<?php echo base_url(); ?>index.php/resto_con/do_logout"><i class="whitespace"></i> Logout</a></li> -->
				</ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="<?php echo base_url(); ?>index.php/resto_con/standaradmin"><i class="glyphicon glyphicon-home"></i> Halaman Utama</a></li>
                <li class="dropdown">				
            </ul>
        </div>
    </div>
    <!-- topbar ends -->
	<?php 
		if (null != $this->session->userdata('username')) {
			$username=$this->session->userdata('username');
			 ?> <a class="navbar-brand"><font size="1"> <?php echo "Selamat Datang, ".$username;
		}
	?></font></a>
		
		<div id="content" class="col-lg-10 col-sm-10">
		<!-- content starts -->
        <div>		
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>index.php/resto_con/standaradmin">Home</a>
        </li>
		<li>
            <?php
				if (null != $this->session->userdata('username')) { ?>
					<a href="<?php echo base_url(); ?>index.php/resto_con/do_logout">Logout</a>
			<?php } ?>
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
        <a data-toggle="pill" title="Mengupload Standar" class="well top-block" href="#upload">            
			<i class="glyphicon glyphicon-hand-down blue"></i>
            <div>Upload Standar</div>
        </a>
    </div>
</div>

<div class="tab-content">
	<div id="upload" class="tab-pane fade">
		<div class="row">
			<div class="col-md-4 col-xs-6">
				<center>
					<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/resto_con/uploadstandar" method="post">
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
								<input type="text" class="form-control" placeholder="Ukuran" name="ukuran">
							</div>
							<div class="clearfix"></div><br>

							<div class="input-group input-group-lg">
								<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase blue"></i></span>
								<input type="text" class="form-control" placeholder="Bahan" name="bahan">
							</div>
							<div class="clearfix"></div><br>

							<div class="input-group input-group-lg">
								<span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up blue"></i></span>
								<input type="text" class="form-control" placeholder="Penyajian" name="penyajian">
							</div>
							<div class="clearfix"></div><br>

							<div class="input-group input-group-lg">
								<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase blue"></i></span>
								<input type="text" class="form-control" placeholder="Rasa" name="rasa">
							</div>
							<div class="clearfix"></div><br>
							
							<p class="center col-md-5">
								<button class="well top-block"><strong>Simpan</strong></button></a>
								
							</p>
						</fieldset>
					</form>
				</center>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-xs-6">
	<?php
	foreach($kue as $row){
		$nmkue= $row->namakue;
		?>
	<div id="item">
		<div class="col-md-3 col-sm-6">
			<div class="product-item">
				<div class="product-thumb">					
					<div class="product-content">
						<?php
						echo "<h3><strong>".$row->namakue."</strong></h3>";?>
						<a data-toggle="pill" class="well top-block" href=""></i><img src="/assets/img/produk/<?php echo $row->gambar;?>" alt style= "width:100px;height:50px;"></a>
						<a data-toggle="pill" class="well top-block" href="" onclick="detstandar(<?php echo $row->idkue;?>);"><strong>Detail</strong></button></a>
						<a data-toggle="pill" class="well top-block" href="" onclick="specstandar(<?php echo $row->idkue;?>);"><strong>Edit Standar</strong></button></a>
				</div>
			</div>
		</div>
	</div>
<?php  }   ?>
	</div>
</div>

<script>
	function detstandar(idkue) {
		$.ajax({
			type:"POST",
			url : "<?php echo base_url(); ?>index.php/resto_con/standar",
			data : {"id" : idkue},
			success : function(data){
				$("#formaksi").action = "<?php echo base_url(); ?>index.php/resto_con/standar";
				document.getElementById("isiDetail").innerHTML=data;
			}
		});			
		document.getElementById("namaRm").innerHTML = "Standar Kue";
		$('#myModal').modal('show');
	}
	
	function specstandar(idkue) {
		$.ajax({
		url : "<?php echo site_url('resto_con/specstandar/')?>/"+idkue,
		type : "GET",
		dataType : "JSON",
		success : function(data)
		{
			$('#idkategori').val(data.idkategori);
			$('[id="kategori"]').html('<option value='+data.idkue+'>'+data.namakue+'</option>');
			$('#ukuran').val(data.ukuran);
			$('#bahan').val(data.bahan);
			$('#penyajian').val(data.penyajian);
			$('#rasa').val(data.rasa);
			$('#myModalDetail').modal('show');
		},
				error: function(jqXHR, exception) {
					alert(errorThrown);
				}
		});
	}	
</script>
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formaksi" role="form" action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h3 id = "namaRm">Standar Kue</h3>     
					</div>
                    <div class="modal-body">      
						<table border=0 width=100%>
							<thead>
							</thead>
							<tbody id="isiDetail">
							</tbody>
						</table>
                    <div class="modal-footer">					  
						<!--<button type="submit" class="btn btn-primary btn-round btn-lg" onclick="submitRating();"><strong>Beli</strong></button>-->						
                        <a href="#" class="btn btn-primary btn-round btn-lg" data-dismiss="modal"><strong>Tutup</strong></a>                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" action="<?php echo base_url(); ?>resto_con/editstandar" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h3 id = "namaRm">Keterangan Kue</h3>
						<input type="hidden" id="idkategori" name="idkategori">
					</div>					  
                    <div class="modal-body">
						<div class="row">
							<select id="kategori" class="form-control" name="kategori" id="kategori" onmousedown="tampilkat();">
							</select>
						</div>
						<div class="clearfix"></div><br>
						<div class="row">
							<div class="col-md-4 col-xs-4">Ukuran</div>
							<div class="col-md-8 col-xs-8"><input type="text" id="ukuran" name="ukuran"></div>
							<div class="clearfix"></div><br>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4">Bahan</div>
							<div class="col-md-8 col-xs-8"><input type="text" id="bahan" name="bahan"></div>
							<div class="clearfix"></div><br>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4">Penyajian</div>
							<div class="col-md-8 col-xs-8"><input type="text" id="penyajian" name="penyajian"></div>
							<div class="clearfix"></div><br>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-4">Rasa</div>
							<div class="col-md-8 col-xs-8"><input type="text" id="rasa" name="rasa"></div>
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
</div>	
	<footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="" target="_blank">Karina Levina
                Witanto</a> SI 2013</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="">Karina</a></p>
    </footer>

<?php require('assets/footer.php'); ?>