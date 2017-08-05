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
                <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-home"></i> Halaman Utama</a></li>
                <li class="dropdown">
				
					
                <li>
					<form role="form" action="<?php echo base_url(); ?>index.php/resto_con/search" method="post"><input placeholder="Nama Kue" class="search-query form-control col-md-10" name="search" type="text">
                    
                </li>
				<li>
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button></form>
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
							<a href= "<?php echo base_url(); ?>index.php/resto_con/insertproduk"><i class="glyphicon glyphicon-user"></i><span> JualanKu</span></a>
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
			<?php
				if (null != $this->session->userdata('username')) { ?>
					<a href="<?php echo base_url(); ?>index.php/resto_con/do_logout">Logout</a>
			<?php } ?>
        </li>
    </ul>
	</div>
	<?php echo $pesan; ?>
	
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
						<!--						
						<a data-toggle="pill" class="well top-block" href="#detjual"></i><img src="<?php //echo $row->gambar;?>" alt style= "width:100px" "height:50px"></a>
						-->
						<a data-toggle="pill" class="well top-block" href="" onclick="detpenjual(<?php echo $row->idkue;?>);"></i><img src="/assets/img/produk/<?php echo $row->gambar;?>" alt style= "width:100px;height:50px;"></a>
						<a data-toggle="pill" class="well top-block" href="" onclick="detstandar(<?php echo $row->idkue;?>);"><strong>Detail</strong></button></a>
						<!--<button type="submit" class="btn btn-primary btn-round btn-lg" onclick="detstandar(<?php echo $row->idkue;?>);"><strong>Detail</strong></button>-->
					<?php

							//echo "<h3><strong>".$row->nmkue."</strong></h3>";
							//echo "<a>".$row->nmpengrajin."</a>".$row->hrg;
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php  }   ?>
	</div>
<div class="col-md-4 col-xs-6">
	<div class="nav-canvas">
		<ul class="nav nav-pills nav-stacked main-menu">
			<form role="form" action="<?php echo base_url(); ?>index.php/resto_con/checkout" method="post">
					<input type="hidden" class="form-control" name="idbeli" value='<?php echo $idbeli;?>'>
					<button type='submit' class='btn btn-primary btn-round btn-lg' <?php if ($jum_beli==0) echo 'disabled';?>> Checkout</button>
			</form>						
			<table class="table table-striped">
				<tr>
					<td><a href= ""></i><span> Nama Kue</span></a></td>
					<td><a href= ""></i><span> Harga (Rp)</span></a></td>
					<td></td><td><a href= ""></i><span> Jumlah</span></a></td><td></td>
					<td><a href= ""></i><span> Subtotal (Rp)</span></a></td>
				</tr>
				<?php
					if (null != $this->session->userdata('username') && $jum_beli>0) {
						$i = 0;
						foreach($kbelanja as $row){?>
							<tr>
								<td style="text-align:center" width="60%"><a class="well top-block"><?php echo $row->nmkue;?></a><br>
								<td style="text-align:center" width="60%"><a class="well top-block" name="hrg[]"><?php echo $row->hrg;?></a><br></td>
								<td style="text-align:center" width="60%">
									<input type="hidden" class="form-control" name="idkue[]" value='<?php echo $row->idkue;?>'>
									<a href="#" onclick="ubahjml(-1,<?php echo $i;?>);" class="well top-block">-</a></td>
								<td><input type="text" name="jumlah[]" id="jumlah[]" class="well top-block" value=<?php echo $row->jmlh;?> style="width:50px;"></td>
								<td><a href="#" onclick="ubahjml(1,<?php echo $i;?>);" class="well top-block">+</a></td>
								<td style="text-align:center" width="60%"><a class="well top-block" name="subtotal[]"><?php echo $row->subtotal;?></a><br></td>
								<td><form role="form" action="<?php echo base_url(); ?>index.php/resto_con/hapuskue" method="post">
									<input type="hidden" class="form-control" name="idkue1" value='<?php echo $row->idkue;?>'>
									<input type="hidden" class="form-control" name="idbeli" value='<?php echo $idbeli;?>'>
									<button type='submit' class='btn btn-primary btn-round btn-lg'>x</button></form></td>
							</tr>
							<?php $i++; } ?>
		<?php
			foreach($total as $row){?>
				<input type="hidden" class="form-control" name="idbeli" value='<?php echo $row->idbeli;?>'>
					<a class="well top-block">Total Rp <?php echo $row->subtotal;?></a><br>
			<?php } 
			} else { ?>
				Keranjang Belanja Masih Kosong, Ayo Berbelanja!
			<?php } ?>			
        </table>
		</ul></div>
	</div>
</div>

<script>
		function ubahjml(jml,no) {
			var i=0;
			var idkue=document.getElementsByName("idkue[]");
			var harga=document.getElementsByName("hrg[]");
			$("input[name='jumlah[]']").each(function() {
				var jumlah=parseInt($(this).val())+jml;
				if (i == no && jumlah >= 0) { 
					$(this).val(jumlah);
					var id=idkue[i].value;
					var hrg=harga[i].innerText;
					var subtot = parseInt(hrg) * jumlah;
					$.ajax({
						type:"POST",
						url : "<?php echo base_url(); ?>index.php/resto_con/ubahjmlh",
						data : ({'idkue': id , 'subtotal': subtot, 'jmlh': jumlah}),
						success : function(data){
							
						},
						error: function(err,tr,ss)  {
						}
					});			
				}
				i++;
			});
		}
				
		function detpenjual(idkue) {
			//document.getElementById("idResto").value=idRm;
			//document.getElementById("namaRm").innerHTML=nama+"<br>"+alamat;
			$.ajax({
				type:"POST",
				url : "<?php echo base_url(); ?>index.php/resto_con/penjual",
				data : {"id" : idkue},
				success : function(data){
					var ur = "<?php echo base_url(); ?>index.php/resto_con/penjual";
					
					$("#formaksi").action = ur;
					document.getElementById("isiDetail").innerHTML=data;
				}
			});			
			document.getElementById("namaRm").innerHTML = "Daftar Penjual Kue";
			$('#myModal').modal('show');
		}
		//using multiple modal in 1 page
		function detstandar(idkue) {
			//document.getElementById("idResto").value=idRm;
			//document.getElementById("namaRm").innerHTML=nama+"<br>"+alamat;
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
		
</script>
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formaksi" role="form" action="<?php echo base_url(); ?>index.php/resto_con/insertcart" method="post">
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
                        <button type='submit' class='btn btn-primary btn-round btn-lg'>Beli</button>						
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