<?php 
	require_once("Netfilter.php");
	$n = new NetFilter();
	$p = $n->getPort();
?>
<html>
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="iptables.css">
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body style="background: #E6E6FA;">
    	<div class="container mt-5 border p-4" style="background: white;">
       	     <form action="traitement.php" method="post">
        	    <div class="d-flex bd-highlight">
        	    	<div class="flex-fill p-2 bd-highlight">
						<div class="form-floating">
							<select name="chaine" class="form-select" id="c">
								<option selected="selected">Choisier la Chaine</option>
								<option value="INPUT">INPUT</option>
								<option value="OUTPUT">OUTPUT</option>
								<option value="FORWARD">FORWARD</option>
							</select>
							<label for="c">CHAINE</label>
						</div>
						<br>
						<div class="form-floating">
							<select name="action" class="form-select" id="a">
								<option selected="selected" value="">Choisier l'Action</option>
								<option value="ACCEPT">ACCEPT</option>
								<option value="DROP">DROP</option>
								<option value="REJECT">REJECT</option>
							</select>
							<label for="a">ACTION</label>
						</div>
						<br>
						<div class="form-floating">
							<select name="interface" class="form-select" id="i">
								<option selected="selected" value="">Choisier l'Interface</option>
								<option value="">all</option>
								<option value="wlan0">wlan0</option>
								<option value="eth0">eth0</option>
								<option value="eth1">eth1</option>
							</select>
								<label for="i">Interface</label>
						</div>
						<br>
						<div class="form-floating">
							<select name="protocole" class="form-select" id="p">
								<option selected="selected" value="">Choisier le Protocole</option>
								<option value="">not-specified</option>
								<option value="tcp">tcp</option>
								<option value="udp">udp</option>
								<option value="icmp">icmp</option>
							</select>
								<label for="p">Protocole</label>
						</div>
						<br>
						<div class="form-floating mb-3">
							<input name="source" type="texte" class="form-control" id="d">
							<label for="d">Source</label>
						</div>
						<div class="form-floating mb-3">
							<input name="destination" type="texte" class="form-control" id="s">
							<label for="s">Destination</label>
						</div>
						<div class="form-floating mb-3">
							<input name="mac" type="texte" class="form-control" id="m">
							<label for="d">Adresse Mac</label>
						</div>			
					</div>
 					<div id="sport" class="flex-shrink-1 p-2 bd-highlight" style="width: 30%;display: none;">
 						<p> Source Port :</p>
 						 <div class="overflow-auto p-3 mb-3 me-sm-3 bg-light" style="max-width: 100%; max-height: 400px;">
 					 		<?php for($j = 1;$j < count($p);$j++) {?>
 					 			<div class="d-grid gap-2">
									<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
										<input name="<?php echo $j; ?>" type="checkbox" class="btn-check" id= "<?php echo $j?>" autocomplete="off" value="<?php echo $p[$j][1]?>">
										<label class="btn btn-outline-dark" for="<?php echo $j?>"><?php echo $p[$j][0]?></label>
									</div>
								</div>
								<br>
							<?php } ?>		
 						</div>
 					</div>
 					<div id="dport" class="flex-shrink-1 p-2 bd-highlight" style="width: 30%;display: none;">
 						<p> Destination Port :</p>
 						<div class="overflow-auto p-3 mb-3 me-sm-3 bg-light" style="max-width: 100%; max-height: 400px;">
 					 		<?php for($j = -1;$j > -count($p);$j--) {?>
 					 			<div class="d-grid gap-2">
									<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
										<input name="<?php echo $j; ?>" type="checkbox" class="btn-check" id= "<?php echo $j?>" autocomplete="off" value="<?php echo $p[-$j][1]?>">
										<label class="btn btn-outline-dark" for="<?php echo $j?>"><?php echo $p[-$j][0]?></label>
									</div>
								</div>
								<br>
							<?php } ?>					
 						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Ajouter</button>
				<a href="iptables.php"><button type="button" class="btn btn-secondary">Annuler</button></a>
          	</form>
    	</div>
		<script src="iptables.js"></script>
	</body>
</html>