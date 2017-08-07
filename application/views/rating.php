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
                <ul class="" id="themes">
                   <!--<li><a data-value="classic" href="#"><i class="whitespace"></i> History</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Ubah Data Diri</a></li> -->
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
						<a href="<?php echo base_url(); ?>index.php/resto_con/insertproduk"><i class="glyphicon glyphicon-home"></i><span> JualanKu</span></a>
					</li>
					<li>
						<a href= "#"><i class="glyphicon glyphicon-eye-open"></i><span> Rating & Review</span></a>
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

<script>		
	function showRating(idkue, idbeli, nmkue) {
		document.getElementById("idkue").value=idkue;
		document.getElementById("idbeli").value=idbeli;
		document.getElementById("nmkue").innerHTML=nmkue;
		$('#myModalDetail').modal('show');
	}
	
	function submitRating(){		
		<?php if (null != $this->session->userdata('username')) { ?> 
		document.getElementById("idmember").value=<?php echo $this->session->userdata('idmember')?>;
		<?php } ?>
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
	
	function rating(id) {
		$.ajax({
			type:"POST",
			url : "<?php echo base_url(); ?>index.php/resto_con/org",
			data : {"id" : id},
			success : function(data){
				document.getElementById("isiDetail").innerHTML=data;
				//$("#formaksi").action = "<?php echo base_url(); ?>index.php/resto_con/org";
				}
		});			
		//document.getElementById("namaRm").innerHTML = "Orang Mereview";
		$('#myModal').modal('show');
	}

	function belanja(pros){
			$.ajax({
				type:"POST",
				url : "<?php echo site_url('resto_con/statusbelanjapembeli/')?>/"+pros,
				//data : ({'proses' : pros}),
				success : function(data){
					//alert (pros);
					document.getElementById("pesanan").innerHTML=data;
				},
				error: function(err,tr,ss)  {
					alert (ss);
				}
			});
		}
</script>

<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formaksi" role="form" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h3 id = "namaRm">Orang Mereview</h3>     
					</div>
                    <div class="modal-body">      
						<table border=0 width=100%>
							<thead>
							</thead>
							<tbody id="isiDetail">
							</tbody>
						</table>
                    <div class="modal-footer">					
                        <a href="#" class="btn btn-primary btn-round btn-lg" data-dismiss="modal"><strong>Tutup</strong></a>                
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" class="well top-block" href="#what">            
			<i class="glyphicon glyphicon-star blue"></i>
            <div>Review Pelanggan</div>
        </a>
	</div>

	<div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" class="well top-block" href="#belanja">            
			<i class="glyphicon glyphicon-heart blue"></i>
            <div>BelanjaanKu</div>
        </a>
	</div>
</div>

<div class="tab-content">
    <div id="what" class="tab-pane fade in active">
	<center>
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
								echo "<h3><strong>".$row->nmkue."</strong> - ".$row->nmmember."</h3>";?>
								<input type="hidden" class="form-control" name="id" value='<?php echo $row->id;?>'>
								<a data-toggle="pill" class="well top-block" href=""></i><img src="/assets/img/produk/<?php echo $row->gambar;?>" alt style= "width:100px;height:50px;"></a>
								<a data-toggle="pill" class="well top-block" href="" onclick="rating(<?php echo $row->id;?>);"><strong> Orang Mereview</strong></button></a>
							
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php  }   ?>
	</center>
    </div>
	

	<div id="belanja" class="tab-pane fade">
	<center>
	<center>
		<div class="form-group has-success">
			<label class="radio-inline">
				<input type="radio" name="order" id="tk" value="tk" onclick="belanja('0');" checked><strong> Tunggu Konfirmasi
			</label>
			<label class="radio-inline">
				<input type="radio" name="order" id="dp" value="dp" onclick="belanja('1');"><strong> Dalam Proses Pembuatan
			</label>
			<label class="radio-inline">
				<input type="radio" name="order" id="t" value="t" onclick="belanja('2');"><strong> Ditolak
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
	

<div class="modal fade" id="myModalDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
			<form role="form" action="<?php echo base_url(); ?>index.php/resto_con/submitRating" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">x</button>
					<h3 id = "nmkue">Detail Kue</h3>     
					<input type="hidden" name="idkue" id="idkue" value="">
					<input type="hidden" name="idbeli" id="idbeli" value="">
					<input type="hidden" name="idmember" id="idmember" value="">
				</div>
					<script>
						function ganti(no){
							var x = document.getElementsByName("score")[no].value;
							$("#krit"+no).val(x);
						}
					</script>     
                    <div class="modal-body">      					
					<table border=0 width=80%>
						<thead>
							<tr>
								<td style="text-align:center" width=60%><img src=/assets/img/icon/icon-765124_960_720.jpg width=50px height=50px><br>Ukuran</td>
								<td style="text-align:center"><div class="raty" onclick="ganti(0);"></div><input type="hidden" name="skor1" id="krit0"></td>
							</tr>
							<tr>
								<td style="text-align:center" width=60%><img src=/assets/img/icon/depositphotos_7599564-stock-photo-recipe-icon.jpg width=50px height=50px><br>Bahan</td>
								<td> <div class="raty" onclick="ganti(1);"></div><input type="hidden" name="skor2" id="krit1"></td>
							</tr>
							<tr>
								<td style="text-align:center" width=60%><img src=/assets/img/icon/128268-200.png width=50px height=50px><br>Penyajian</td>
								<td> <div class="raty" onclick="ganti(2);"></div><input type="hidden" name="skor3" id="krit2"></td>
							</tr>
							<tr>	
								<td style="text-align:center" width=60%><img src=/assets/img/icon/Savouring-Emoji-Taste-Tongue-Emoticon-512.png width=50px height=50px><br>Rasa</td>
								<td> <div class="raty" onclick="ganti(3);"></div><input type="hidden" name="skor4" id="krit3"></td>
							</tr>	
							<tr>	
								<td style="text-align:center" width=60%>Komentar</td>
								<td width=40%> <textarea name="review"></textarea></td>
							</tr>
						</thead>
						<tbody id="isiTabelDetail">
						</tbody>
					</table>
					<div class="modal-footer">
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