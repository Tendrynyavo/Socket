<?php
    
    function check_Password($first,$match){
		if($first==$match){
			return True;
		}
		else{
			return False;
		}
	}
	function enterPage($log,$Mdp,$all_user){
		$user=checkUsers($log,$all_user);
		$mdp=checkPass($Mdp,$all_user);
		if($user!=False && $mdp){
			return $user;
		}
		else{
			return False;
		}
	}
	function checkUsers($log,$all_user){
		for($i=0;$i < count($all_user);$i++){
			if($log==$all_user[$i]['Email']){
				return $all_user[$i]['IdMembres'];
			}
		}
		return False;
	}
	function checkPass($md,$all_user){
		for($i=0;$i < count($all_user);$i++){
			if($md==$all_user[$i]['MotDePasse']){
				return True;
			}
		}
		return False;	
	}

    function save_publ($txt_p,$type_aff,$bd,$publieur){
        $req="INSERT INTO publication(TextePublication,TypeAffichage,DateHeurePublication,IdMembres) VALUE ('%s',%d,NOW(),%d);";
        $sql=sprintf($req,$txt_p,$type_aff,$publieur);
        mysqli_query($bd,$sql);
    }
    function use_sql_publication($bd){
        $req="SELECT * FROM publication ORDER BY idPublication DESC LIMIT 1,1";
        $donnee=mysqli_query($bd,$req);
        return $donnee;

    }
    // mysqli_connect('localhost','root','usbw','socialmedia');
    function countResult($valiny){
        $count=0;
        while($val=mysqli_fetch_assoc($valiny)){
            $count++;
        }
        return $count;
    }
    
    //fonction qui enlève les espaces et retourne le resultat
    function remove