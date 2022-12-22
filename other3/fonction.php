." ORDER BY Nom ASC;";
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