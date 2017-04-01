<?php
	$no_visible_elements = true;
	require('assets/header.php'); ?>
	<head>
	
	 <!-- <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAA8G9ZUehlmgHFYSk0eHkvMxSMGSzrQzuxP9i0yI8OwKXwu_vyNhQuc40vTW0co5ModYSrK6lCkwof0Q" type="text/javascript"></script>
	-->
	<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=id" type="text/javascript"></script>
	<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=AIzaSyAu0vqoIGSqdyxILIX5neET6krbzCmRbUQ" type="text/javascript"></script>
	-->
	<script type="text/javascript">
	var geocoder = new google.maps.Geocoder();

	// http://cariprogram.blogspot.com
	// nuramijaya@gmail.com

	function initialize() {
		//var latLng = new google.maps.LatLng(-5.1694899, 119.4106163);
		var map = new google.maps.Map(document.getElementById('mapCanvas'), {
		zoom: 12,
		//center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
		});
 
	var locations = [ <?php echo $lokasi; ?> ];
	var infowindow = new google.maps.InfoWindow();
	var marker, i;
     
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][3], locations[i][4]),
        title: locations[i][1],
		map: map
		//icon: 'grad-icon.png'
      });
		
	  google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
		  var infoResto = "<br/><button onclick=\"showRating(";
		  infoResto += locations[i][0]+",'"+locations[i][1]+"','"+locations[i][2];
		  infoResto += "');\">Rate It!</button>";
          infowindow.setContent(locations[i][1]+"<br>"+locations[i][2]+infoResto);
          infowindow.open(map, marker);
        }
      })(marker, i));
	 }

	// Try HTML5 geolocation
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
		document.getElementById("lati").value = position.coords.latitude;
		document.getElementById("long").value = position.coords.longitude;
		var marker1 = new google.maps.Marker({
			position : pos,
			animation:google.maps.Animation.BOUNCE,
			title : 'Lokasi Anda',
			icon : 'assets/icon.png',
			map : map
			//draggable : true
		});
			map.setCenter(pos);
   
		}, function() {
			//=handleNoGeolocation(true);
		var marker1 = new google.maps.Marker({
			position : latLng,
			animation:google.maps.Animation.BOUNCE,
			title : 'Lokasi Anda',
			//icon : 'assets/icon.png',
			map : map
			//draggable : true
		});
    });
	} else {
		var marker1 = new google.maps.Marker({
			position : latLng,
			animation:google.maps.Animation.BOUNCE,
			title : 'lokasi',
			//icon : 'assets/icon.png',
			map : map
			//draggable : true
		});
		}
	}

	// Onload handler to fire off the app.
		google.maps.event.addDomListener(window, 'load', initialize);
 
  </script>
	</head>
	<body onload="load();">
<script>
</script>

	<div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>            
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> User</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="do_logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

          </div>
    </div>
	<div class="ch-container" onclick="">
		<center>
			<div id="mapCanvas" ondblclick= "" style="width: 320px; height: 300px; "></div>
		    <div hidden id="panel" style="width: 100%; float: bootom;"></div> 
		</center>
	</div>
	<br>
	<input type="hidden" id="lati"/>
	<input type="hidden" id="long"/>
	
	<script>
		function arahLokasi(idRm, lat, lng){
			var dest = new google.maps.LatLng(lat,lng);				   
			var from = new google.maps.LatLng(document.getElementById("lati").value,document.getElementById("long").value);
			 var directionsService = new google.maps.DirectionsService();
			 var directionsDisplay = new google.maps.DirectionsRenderer();
			 var map = new google.maps.Map(document.getElementById('mapCanvas'), {
			   zoom:7,
			   mapTypeId: google.maps.MapTypeId.ROADMAP
			 });
			
			 directionsDisplay.setMap(map);
			 directionsDisplay.setPanel(document.getElementById('panel'));
			 var request = {
			   origin: from, 
			   destination: dest,
			   travelMode: google.maps.DirectionsTravelMode.DRIVING
			 };
		
			 directionsService.route(request, function(response, status) {
			   if (status == google.maps.DirectionsStatus.OK) {
				 directionsDisplay.setDirections(response);
			   }
			 });
		}
		function showRating(idRm, nama, alamat) {
			document.getElementById("idResto").value=idRm;
			document.getElementById("namaRm").innerHTML=nama+"<br>"+alamat;
			
			$('#myModalDetail').modal('show');
		}
		
		function findresto(){
			var cari = document.getElementById("lokasi").value;
			var kond = document.getElementById("bn").checked;
			var krit;
			if (kond) krit = 1; else krit=0;
			$.ajax({
				type:"POST",
				url : "<?php echo base_url(); ?>index.php/resto_con/findresto",
				data : {"cari" : cari, "krit" : krit},
				success : function(data){
					document.getElementById("cari").innerHTML=data;
				}
			});
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
	
	<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="Giving You The Information About Top 5 Resto in Makassar" class="well top-block" href="#top5">            
			<i class="glyphicon glyphicon-star green"></i>
            <div>Top 5 Resto</div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="Help You to See What Are You Doing All This Time" class="well top-block" href="#history">            
			<i class="glyphicon glyphicon-shopping-cart yellow"></i>
            <div>History</div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="You Will Be Able to See What Other People Rating" class="well top-block" href="#what">           
			<i class="glyphicon glyphicon-user blue"></i>
            <div>What Other People Say</div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="pill" title="Help You to Find A Restaurant By Typing It's Name" class="well top-block" href="#find">
            <i class="glyphicon glyphicon-envelope red"></i>
            <div>Find Resto</div>
            </a>
    </div>
</div>

	<div class="tab-content">
    <div id="top5" class="tab-pane fade in active">
	<center>
	<?php
		foreach($qryTop5 as $row){
			echo "<h3><strong>".$row->namaRm."</strong></h3>";
			echo "<p><a class='well top-block'>".$row->alamat."</a><h4>".$row->deskripsi."</h4></p>";		
			echo "<p style='vertical-align:middle;'><img src=../../assets/img/trjfp_recycle_icons-enjoy.png width=50px height=50px>".$row->Kenyamanan.
			"&nbsp;<img src=../../assets/img/interiors-icon.jpg width=50px height=50px>".$row->Interior.
			"&nbsp;<img src=../../assets/img/menu-icon-250.png width=50px height=50px>".$row->Menu.
			"&nbsp;<img src=../../assets/img/flat-42-512.png width=50px height=50px>".$row->Pelayanan;
		}
	?>
	</center>
    </div>
	
    <div id="history" class="tab-pane fade">
	<center>
	<?php
		foreach($history as $row){
			echo "<h3><strong>".$row->namaRm. "</strong></h3><h4> (".$row->waktu.")</h4>";		
			echo "<h4><a class='well top-block'>".$row->alamat. "</a></h4><br>";
			echo "<p style='vertical-align:middle;'><img src=../../assets/img/trjfp_recycle_icons-enjoy.png width=50px height=50px>".$row->Kenyamanan.
			"&nbsp;<img src=../../assets/img/interiors-icon.jpg width=50px height=50px>".$row->Interior.
			"&nbsp;<img src=../../assets/img/menu-icon-250.png width=50px height=50px>".$row->Menu.
			"&nbsp;<img src=../../assets/img/flat-42-512.png width=50px height=50px>".$row->Pelayanan;
		}
	?>
	</center>
    </div>
	
    <div id="what" class="tab-pane fade">
	<center>
    <?php
		foreach($wops as $row){
			echo "<h3><strong>".$row->namaMember. "</strong><br></h3><h4>" .$row->namaRm. " (".$row->waktu.")</h4>";
			echo "<h5><i><font color='orange'>".$row->Komentar. "</font></i></h5><br>";
			echo "<p style='vertical-align:middle;'><img src=../../assets/img/trjfp_recycle_icons-enjoy.png width=50px height=50px>".$row->Kenyamanan.
			"&nbsp;<img src=../../assets/img/interiors-icon.jpg width=50px height=50px>".$row->Interior.
			"&nbsp;<img src=../../assets/img/menu-icon-250.png width=50px height=50px>".$row->Menu.
			"&nbsp;<img src=../../assets/img/flat-42-512.png width=50px height=50px>".$row->Pelayanan;	
		}
	?>
	</center>
    </div>
	
    <div id="find" class="tab-pane fade">
	<center>
		<div class="form-group has-success">
			<label class="radio-inline">
				<input type="radio" name="cari" id="bn" value="bn" checked><strong> By Name
			</label>
			<label class="radio-inline">
				<input type="radio" name="cari" id="ba" value="ba"> By Address
			</label>
			<input type="text" placeholder="Ketikkan Disini" class="form-control" id="lokasi">
			<button type="submit" class="btn btn-primary btn-round btn-lg" onclick="findresto();">Cari</strong></button>
		</div>
		<div id="cari"></div>
	</center>
    </div>
  </div>

    <!-- content ends -->

<div class="modal fade" id="myModalDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" action="<?php echo base_url(); ?>index.php/resto_con/submitRating" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h3 id = "namaRm">Detail Resto</h3>     
						<input type="hidden" name="idRm" id="idResto" value="">
						<input type="hidden" name="idmember" id="idmember" value="">
						<strong><p id="nomorspkDetail"></p></strong>
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
									<td style="text-align:center" width=60%><img src=../../assets/img/trjfp_recycle_icons-enjoy.png width=50px height=50px><br>Kenyamanan</td>
									<td style="text-align:center"><div class="raty" onclick="ganti(0);"></div><input type="hidden" name="skor1" id="krit0"></td>
								</tr
								<tr>
									<td style="text-align:center" width=60%><img src=../../assets/img/interiors-icon.jpg width=50px height=50px><br>Interior</td>
									<td> <div class="raty" onclick="ganti(1);"></div><input type="hidden" name="skor2" id="krit1"></td>
								</tr>
								<tr>
									<td style="text-align:center" width=60%><img src=../../assets/img/menu-icon-250.png width=50px height=50px><br>Menu</td>
									<td> <div class="raty" onclick="ganti(2);"></div><input type="hidden" name="skor3" id="krit2"></td>
								</tr>
								<tr>	
									<td style="text-align:center" width=60%><img src=../../assets/img/flat-42-512.png width=50px height=50px><br>Pelayanan</td>
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
                    <div class="modal-footer">					  
						<button type="submit" class="btn btn-primary btn-round btn-lg" onclick="submitRating();"><strong>Simpan</strong></button>
                        <a href="#" class="btn btn-primary btn-round btn-lg" data-dismiss="modal"><strong>Tutup</strong></a>                
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require('assets/footer.php'); ?>