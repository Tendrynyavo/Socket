Space($valiny){
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
                $Query=$Query