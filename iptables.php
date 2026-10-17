<?php 
	require_once("Netfilter.php");
	$n = new NetFilter();
	$n->lectureIptables();
	$in = $n->getIn();
	$ou = $n->getOu();
	$fo = $n->getFo();
	function println($in,$init){
		for($j = 1;$j < count($in);$j++){
			$color = "table-light";
			if($in[$j][8] == "DROP"){
				$color = "table-danger";
			}
			if($in[$j][8] == "REJECT"){
				$color = "table-warning";
			}
			$sp = explode(",",$in[$j][4]);
			$dp = explode(",",$in[$j][5]);
	?>
			<tr height = 50 class=<?php echo $color;?>>
				<td width = 20%> <?php echo $in[$j][1]; ?></td>
				<td width = 20%> <?php echo $in[$j][2]; ?></td>
				<td width = 20%> <?php echo $in[$j][3]; ?></td>
				<td width = 20%> 
					<div class="accordion" id="ap">
						<div class="accordion-item">
							<h2 class="accordion-header" id="hp">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $j*$init;?>" aria-expanded="true" aria-controls="collapseOne">
								Liste
								</button>
							</h2>
							<div id="<?php echo $j*$init;?>" class="accordion-collapse collapse hide" aria-labelledby="hp" data-bs-parent="#ap">
								<div class="accordion-body">
									<?php for($k = 0;$k < count($sp);$k++){?>
										<p><?php echo $sp[$k];?></p>
									<?php }?>
								</div>
							</div>
						</div>
					</div>					
				</td>
				<td width = 20%>
					<div class="accordion" id="as">
						<div class="accordion-item">
							<h2 class="accordion-header" id="hs">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $j/$init;?>" aria-expanded="true" aria-controls="collapseOne">
								Liste
								</button>
							</h2>
							<div id="<?php echo $j/$init;?>" class="accordion-collapse collapse hide" aria-labelledby="hs" data-bs-parent="#as">
								<div class="accordion-body">
									<?php for($k = 0;$k < count($dp);$k++){?>
										<p><?php echo $dp[$k];?></p>
									<?php }?>
								</div>
							</div>
						</div>
					</div>	
				</td>
				<td width = 20%> <?php echo $in[$j][6]; ?></td>
				<td width = 20%> <?php echo $in[$j][7]; ?></td>
				<td width = 5%><button type="button" class="btn btn-outline-dark">...</button></td>
				<td width = 5%><button type="button" class="btn btn-outline-danger">X</button></td>
			</tr>
	<?php } 
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>	
	<body style="background: #E6E6FA;">
		<nav class="navbar navbar-dark bg-dark fixed-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">NetFilter</a>
				<a class="navbar-toggler" href="ajout.php">Ajouter</a>
				<a class="navbar-toggler" href="iptables.php">Actualiser</a>
				<a class="navbar-toggler" href="#">Reinstaller</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
						<div class="offcanvas-header">
							<h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">NetFilter</h5>
							<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
								<li class="nav-item">
									<div class="d-grid gap-2">
										<button id="bh" class="btn btn-outline-light">Home</button>
										<br>
									</div>
								</li>
								<li class="nav-item">
									<div class="d-grid gap-2">
										<button id="bi" class="btn btn-outline-light">Input</button>
										<br>
									</div>
								</li>
								<li class="nav-item">
									<div class="d-grid gap-2">
										<button id="bo" class="btn btn-outline-light">Output</button>
										<br>
									</div>
								</li>
								<li class="nav-item">
									<div class="d-grid gap-2">
										<button id="bf" class="btn btn-outline-light">Formard</button>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</div>
		<br>
		<div id="dh" class="container mt-5 border p-4" style="display:block;">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<h1>WELCOME IN NETFILTER :)</h1>
				</div>
			</div>
		</div>
		<div id="di" class="container mt-5 border p-4" style="display: none;background: white;">
			<div class="table-responsive-xl">
				<table class="table caption-top">
					<caption>INPUT</caption>
					<thead>
						<tr height=20%>
							<th scope="col">Interface</th>
    					  	<th scope="col">Protocole</th>
							<th scope="col">Mac</th>
							<th scope="col">Source Port</th>
							<th scope="col">Destination Port</th>
							<th scope="col">Source</th>
							<th scope="col">Destination</th>
							<th scope="col">Modifier</th>
							<th scope="col">Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php println($in,33); ?>
					</tbody>
				</table>	
			</div>
		</div>
		<div id="do" class="container mt-5 border p-4" style="display: none;background: white;">
			<div class="row justify-content-center">
			<div class="table-responsive-xl">
				<table class="table caption-top">
					<caption>OUTPUT</caption>
					<thead>
						<tr height=20%>
							<th scope="col">Interface</th>
    					  	<th scope="col">Protocole</th>
							<th scope="col">Mac</th>
							<th scope="col">Source Port</th>
							<th scope="col">Destination Port</th>
							<th scope="col">Source</th>
							<th scope="col">Destination</th>
							<th scope="col">Modifier</th>
							<th scope="col">Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php println($ou,5);?>
					</tbody>
				</table>	
			</div>
			</div>
		</div>
		<div id="df" class="container mt-5 border p-4" style="display: none;background: white;">
			<div class="row justify-content-center">
			<div class="table-responsive-xl">
				<table class="table caption-top">
					<caption>FORWARD</caption>
					<thead>
						<tr height=20%>
							<th scope="col">Interface</th>
    					  	<th scope="col">Protocole</th>
							<th scope="col">Mac</th>
							<th scope="col">Source Port</th>
							<th scope="col">Destination Port</th>
							<th scope="col">Source</th>
							<th scope="col">Destination</th>
							<th scope="col">Modifier</th>
							<th scope="col">Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php println($fo,7); ?>
					</tbody>
				</table>	
			</div>
		</div>
		<script src="div.js"></script>
	</body>
</html>