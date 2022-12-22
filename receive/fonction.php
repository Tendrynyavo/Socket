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
    function removeSpace($valiny){
        $temp_str=array();
        $a=0;
       for($i=0;$i<strlen($valiny);$i++){
           if ($valiny[$i]==" ") {
               $i=$i+1;
            }
            $temp_str[$a]=$valiny[$i];
            $a++;
        }
        //get str
        $retour="";
        foreach($temp_str as $b){
            $retour=$retour.$b;
        }
        return $retour;
    }

    //retourne les indices membres    
    function getResult($valiny,$keyWord){
        $temp_val=array();
        $a=0;
        while($val=mysqli_fetch_assoc($valiny)){
            $temp_name=removeSpace($val['Nom']);
            $keyWord=removeSpace($keyWord);
            $position=strpos(strtolower($temp_name),strtolower($keyWord));
            $pos2=strrpos(strtolower($temp_name),strtolower($keyWord));
            $pos3=strchr(strtolower($temp_name),strtolower($keyWord));
            if($position==true || $pos2==true || $pos3==true){
                $temp_val[$a]=$val['IdMembres'];
                $a++;
            }
        }
        if($a==0){
            return 0;
        }
        else{
            return $temp_val;
        }
    }

    function ConstructQuery($val){
        $Query="SELECT * FROM membres WHERE ";
        for($i=0;$i<count($val);$i++){
            $Query=$Query." IdMembres=".$val[$i];
            if($i < count($val)-1){
                $Query=$Query." or ";
            }
            if($i==count($val)-1){
                $Query=$Query." ORDER BY Nom ASC;";
            }
        }
        return $Query;
    }
    function check_invit($Mpandefa,$nandefasana,$bd){
        $req='SELECT IdMembre1,IdMembre2 FROM amis Where DateHeureAcceptation is Null';
        $resultat=mysqli_query($bd,$req);
        while ($resultat == true && $donnee=mysqli_fetch_assoc($resultat)) {
            if (($Mpandefa == $donnee['IdMembre1'] || $Mpandefa == $donnee['IdMembre2']) && ($nandefasana == $donnee['IdMembre1'] || $nandefasana == $donnee['IdMembre2'])) {
                return true;
            }
        }
        return false;
    }
    function check_amis($idM,$bd){
        // $bdd=bdconnection('socialmedia');
        $req='SELECT IdMembre1,IdMembre2 FROM amis Where DateHeureAcceptation is not Null';
        $resultat=mysqli_query($bd,$req);
        while ($resultat == true && $donnee=mysqli_fetch_assoc($resultat)) {
            if ($idM==$donnee['IdMembre1'] || $idM==$donnee['IdMembre2']) {
                return true;
            }
        }
        return false;
    }
    function check_demande($IdMembre,$bd){
        // $bdd=bdconnection('socialmedia');
        $req='SELECT IdMembre1,IdMembre2 FROM amis Where DateHeureAcceptation is Null';
        $resultat=mysqli_query($bd,$req);
        while ($resultat == true && $donnee=mysqli_fetch_assoc($resultat)) {
            if ($IdMembre == $donnee['IdMembre2']) {
                return true;
            }
        }
        return false;
    }
?>