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
					<a href="#"><img src="http://localhost/kueku/assets/img/blue-shopping-cart-icon-5505.jpg" width="30px" height="30px" class="hidden-xs"/></i></a>
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

<script>		
		function showRating(idkue, nama, alamat) {
			document.getElementById("idkueue").value=idkue;
			document.getElementById("nmkue").innerHTML=nama+"<br>"+alamat;
			
			$('#myModalDetail').modal('show');
		}
		
		function submitRating(){
			document.getElementById("idmember").value=<?php echo $this->session->userdata('idmember')?>;
			var krit0 = document.getElementsByName("score")[0].value;
			var krit1 = document.getElementsByName("score")[1].value;
			var krit2 = document.getElementsByName("score")[2].value;
			var krit3 = document.getElementsByName("score")[3].value;
			$("#krit0").val(krit0);
			$("#krit1").val(krit1);
			$("#krit2").val(krit2);
			$("#krit3").val(krit3);
			return true;
		}
</script>
                <form role="form" action="<?php echo base_url(); ?>index.php/resto_con/submitRating" method="post">
                        <h3 id = "nmkue">Detail Kue</h3>     
						<input type="hidden" name="idkue" id="idkue" value="">
						<input type="hidden" name="idmember" id="idmember" value="">
					</div>					  
					<script>
						function ganti(no){
							var x = document.getElementsByName("score")[no].value;
							$("#krit"+no).val(x);
						}
					</script>      
						<table border=0 width=80%>
							<thead>
								<tr>
									<td style="text-align:center" width=60%><img src=../../assets/img/trjfp_recycle_icons-enjoy.png width=50px height=50px><br>Ukuran</td>
									<td style="text-align:center"><div class="raty" onclick="ganti(0);"></div><input type="hidden" name="skor1" id="krit0"></td>
								</tr
								<tr>
									<td style="text-align:center" width=60%><img src=../../assets/img/interiors-icon.jpg width=50px height=50px><br>Bahan</td>
									<td> <div class="raty" onclick="ganti(1);"></div><input type="hidden" name="skor2" id="krit1"></td>
								</tr>
								<tr>
									<td style="text-align:center" width=60%><img src=../../assets/img/menu-icon-250.png width=50px height=50px><br>Penyajian</td>
									<td> <div class="raty" onclick="ganti(2);"></div><input type="hidden" name="skor3" id="krit2"></td>
								</tr>
								<tr>	
									<td style="text-align:center" width=60%><img src=../../assets/img/flat-42-512.png width=50px height=50px><br>Rasa</td>
									<td> <div class="raty" onclick="ganti(3);"></div><input type="hidden" name="skor4" id="krit3"></td>
								</tr>	
								<tr>	
									<td style="text-align:center" width=60%>Komentar</td>
									<td width=40%> <textarea name="komen"></textarea></td>
								</tr>
							</thead>
							<tbody id="isiTabelDetail">
							</tbody>
						</table>					  
						<center><button type="submit" class="btn btn-primary btn-round btn-lg" onclick="submitRating();"><strong>Simpan</strong></button>
                        <a href="#" class="btn btn-primary btn-round btn-lg" data-dismiss="modal"><strong>Tutup</strong></a></center>						
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