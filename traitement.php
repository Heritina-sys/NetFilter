<?php 
	require_once("Netfilter.php");
	$n = new NetFilter();
	$p = $n->getPort();
	$chaine = $_POST['chaine'];
	$action = $_POST['action'];

	$interface = "";
	$protocole = "";
	$source = "";
	$destination = "";
	$mac = "";
	$sport = "";
	$dport = "";

	if(isset($_POST['interface'])){
		$interface = $_POST['interface'];
	}	
	if(isset($_POST['protocole'])){
		$protocole = $_POST['protocole'];
	}
	if(isset($_POST['source'])){
		$source = $_POST['source'];
	}
	if(isset($_POST['destination'])){
		$destination = $_POST['destination'];
	}
	if(isset($_POST['mac'])){
		$mac = $_POST['mac'];
	}
	if($protocole != ""){
		for($j = 1;$j < count($p);$j++) {
			if(isset($_POST[$j])){
				$sport = $sport.",".$_POST[$j];
			}
		}
		if($sport != ""){
			$sport = substr($sport,1);
		}
		for($j = -1;$j > -count($p);$j--) {
			if(isset($_POST[$j])){
				$dport = $dport.",".$_POST[$j];
			}
		}
		if($dport != ""){
			$dport = substr($dport,1);
		}
	}
	$commande = $n->ajoutChaine($chaine,$interface,$protocole,$mac,$sport,$dport,$source,$destination,$action);
	exec($commande);
//	echo $commande;
	header('Location: iptables.php');
?>