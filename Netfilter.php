<?php
class NetFilter{
	private $in = array(array());
	private $ou = array(array());
	private $fo = array(array());
	public function __construct(){

	}
	public function lectureIptables(){
		$save = "sudo iptables -S > iptables ";
		exec($save);
		$content = file("iptables");
		$l = count($content);
		for($i = 3;$i < $l ;$i++){
			$ligne = preg_split('/\s+/',$content[$i]);
			$l2 = count($ligne);
			$tab = ["none","all","none","none","none","all","all","all","none"];
			for($j = 0;$j < $l2 - 1;$j++){
				if($ligne[$j] == "-A"){
					$tab[0] = $ligne[$j+1];
				}
				if($ligne[$j] == "-i"){
					$tab[1] = $ligne[$j+1];
				}
				if($ligne[$j] == "-p"){
					$tab[2] = $ligne[$j+1];
				}
				if($ligne[$j] == "--mac-source"){
					$tab[3] = $ligne[$j+1];
				}
				if($ligne[$j] == "--sports" || $ligne[$j] == "--sport"){
					$tab[4] = $ligne[$j+1];	
				}
				if($ligne[$j] == "--dports" || $ligne[$j] == "--dport"){
					$tab[5] = $ligne[$j+1];
				}
				if($ligne[$j] == "-s"){
					$tab[6] = $ligne[$j+1];
				}
				if($ligne[$j] == "-d"){
					$tab[7] = $ligne[$j+1];
				}
				if($ligne[$j] == "-j"){
					$tab[8] = $ligne[$j+1];
				}
			}
			if($tab[0] == "INPUT"){
				array_push($this->in,$tab);
			}
			if($tab[0] == "OUTPUT"){
				array_push($this->ou,$tab);
			}
			if($tab[0] == "FORWARD"){
				array_push($this->fo,$tab);
			}
		}
	}
	public function getIn(){
		return $this->in;
	}
	public function getOu(){
		return $this->ou;
	}
	public function getFo(){
		return $this->fo;
	}
	public function getPort(){
		$port = array(array());
		$content = file("service");
		$l = count($content);
		for($i = 0;$i < $l;$i++){
			$tmp = explode(' ',$content[$i]);
		//	print_r($tmp);
			$tmp2 = explode('/',$tmp[1]);
			$tmp[1] = $tmp2[0]; 
			array_push($port,$tmp);
		}
		return $port;
	}
	public function ajoutChaine($chaine,$interface,$protocole,$mac,$sport,$dport,$source,$destination,$action,){
		$commande = "sudo iptables -A ";
		$commande = $commande.$chaine;
		if($interface != ""){
			$commande = $commande." -i ".$interface;
		}
		if($protocole != ""){
			$commande = $commande." -p ".$protocole;
		}
		if($mac != ""){
			$commande = $commande." -m mac --mac-source ".$mac;
		}
		if($sport != ""){
			$commande = $commande." -m multiport --sports ".$sport;
		}
		if($dport != ""){
			$commande = $commande." -m multiport --dports ".$dport;
		}
		if($source != ""){
			$commande = $commande." -s ".$source;
		}
		if($destination != ""){
			$commande = $commande." -d ".$destination;
		}
		$commande = $commande." -j ".$action;
		return $commande;
	}
}
?>