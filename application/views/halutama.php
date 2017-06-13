<?php
	$no_visible_elements = true;
	require('assets/header.php'); ?>
	<head>
	
	</head>
	<body onload="load();">

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
                <span>Kueku</span></a>

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
                    <li><a data-value="cyborg" href="do_logout"><i class="whitespace"></i> Logout</a></li>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-globe"></i> Syarat & Ketentuan</a></li>
                <li class="dropdown">
				<li>
					<a href="#"><img src="/assets/img/blue-shopping-cart-icon-5505.jpg" width="30px" height="30px" class="hidden-xs"/></i></a>
				</li>
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
                        <li><a class="ajax-link" href="index.html"><i class="glyphicon glyphicon-home"></i><span> Jualanku</span></a>
                        </li>
                        <li><a href= "<?php echo base_url(); ?>index.php/resto_con/halrating"><i class="glyphicon glyphicon-eye-open"></i><span> Rating & Review</span></a>
                        </li>
                        <li><a class="ajax-link" href="form.html"><i
                                    class="glyphicon glyphicon-edit"></i><span> Kue</span></a></li>
                        <!--<li><a class="ajax-link" href="chart.html"><i class="glyphicon glyphicon-list-alt"></i><span> Kategori</span></a>
                        </li>-->
                        <li><a href= "<?php echo base_url(); ?>index.php/login_con/index"><i class="glyphicon glyphicon-lock"></i><span> Halaman Login</span></a>
                        </li>
						<li><a href= "<?php echo base_url(); ?>index.php/login_con/registrasi"><i class="glyphicon glyphicon-lock"></i><span> Halaman Sign Up</span></a>
                        </li>
                    </ul>
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

	<?php
	foreach($kue as $row){
		$nmkue= $row->nmkue;
		?>
	<div id="item">
		<div class="col-md-3 col-sm-6">
			<div class="product-item">
				<div class="product-thumb">					
					<div class="product-content">
						<?php
						echo "<h3><strong>".$row->nmkue."</strong></h3>";?>
						<!--						
						<a data-toggle="pill" class="well top-block" href="#detjual"></i><img src="<?php //echo $row->gambar;?>" alt style= "width:100px" "height:50px"></a>
						-->
						<a data-toggle="pill" class="well top-block" href="" onclick="detpenjual(<?php echo $row->idkue;?>);"></i><img src="<?php echo $row->gambar;?>" alt style= "width:100px;height:50px;"></a>
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

<script>

		function detpenjual(idkue) {
			//document.getElementById("idResto").value=idRm;
			//document.getElementById("namaRm").innerHTML=nama+"<br>"+alamat;
			$.ajax({
				type:"POST",
				url : "<?php echo base_url(); ?>index.php/resto_con/penjual",
				data : {"id" : idkue},
				success : function(data){
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
                <form role="form" action="<?php echo base_url(); ?>index.php/resto_con/utama" method="post">
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
		
	<footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="" target="_blank">Karina Levina
                Witanto</a> SI 2013</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="">Karina</a></p>
    </footer>

<?php require('assets/footer.php'); ?>