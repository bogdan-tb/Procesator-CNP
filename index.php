<!DOCTYPE html>
<html>
    <head>
        <title>Validator CNP</title>
        <style>
            body{
                margin:0;
                padding:0;
                overflow:hidden;
                display:flex;
                justify-content:center;
                align-items:center;
                height:100vh;
                width:100vw;
                background-color:#f6f5f7;
                font-family:Arial;
                font-size:18px;
            }
            .box{
                height:400px;
                width:400px;
                box-shadow: rgb(0 0 0 / 16%) 0px 0.0625rem 0.25rem 0px;
                border-radius: 0.75rem;
                padding:20px;
                display:flex;
                flex-direction:column;
                justify-content:center;
                align-items:center;
                background:white;
                box-sizing:border-box;
            }
            input{
                box-sizing:border-box;
                padding:7px 15px;
                border-radius:5px;
                outline:none;
                border:1px solid lightgray;
                width:80%;
                margin-bottom:20px;
            }
            h1{
                font-weight:400;
                text-align:center;
            }
            .msg{
                font-size:20px;
            }
            .btn{
                background:black;
                color:white;
                border-radius:5px;
                padding:7px 15px;
                margin-top:20px;
                cursor:pointer;
                text-decoration:none;
                display:block;
            }
            .btn:hover{
                background:#333;
            }
        </style>
    </head>
    <body>
        
        <?php
            
            function isCnpValid(string $value){
                
                //Verificam lungimea CNP-ului
                if(strlen($value) < 13){
                    return 'CNP-ul este prea scurt!';
                }
                elseif(strlen($value) > 13){
                    return 'CNP-ul este prea lung!';
                }
                
                //Verificam daca CNP-ul furnizat este compus doar din cifre
                if(!is_numeric($value)){
                    return 'CNP invalid!';
                }
                
                //Spargem CNP-ul in bucati
                $s = $value[0];
                $aa = $value[1].$value[2];
                $ll = $value[3].$value[4];
                $zz = $value[5].$value[6];
                $jj = $value[7].$value[8];
                $nnn = $value[9].$value[10].$value[11];
                $c = $value[12];
                
                //Verificam daca luna se incadreaza in intervalul 1 - 12
                if(intval($ll) < 1 or intval($ll) > 12){
                    return 'CNP invalid (luna nastere invalida)';
                }
                
                //Extragem anul si sexul
                $an = '';
                $sex = '';
                
                if($s == 1 or $s == 2){
                    $an = 19;
                    if($s == 1){
                        $sex = 'Masculin';
                    }
                    else{
                        $sex = 'Feminin';
                    }
                }
                
                if($s == 3 or $s == 4){
                    $an = 18;
                    if($s == 3){
                        $sex = 'Masculin';
                    }
                    else{
                        $sex = 'Feminin';
                    }
                }
                
                if($s == 5 or $s == 6){
                    $an = 20;
                    if($s == 5){
                        $sex = 'Masculin';
                    }
                    else{
                        $sex = 'Feminin';
                    }
                }
                
                if($s == 7 or $s == 8){
                    $an = 19;
                    if($s == 7){
                        $sex = 'Masculin (Rezident)';
                    }
                    else{
                        $sex = 'Feminin (Rezident)';
                    }
                }
                
                if($s == 9){
                    $an = 19;
                    $sex = 'Strain/ă';
                }
                
                //Verificam daca este an bisect
                $bisect = 0;
                
                if(intval($an.$aa) % 4 == 0){
                    $bisect = 1;
                }
                
                if(intval($an.$aa) % 100 == 0){
                    $bisect = 0;
                }
                
                if(intval($an.$aa) % 400 == 0){
                    $bisect = 1;
                }
                
                //Verificam daca numarul de zile este corect in raport cu luna
                if($ll == '01' or $ll == '03' or $ll == '05' or $ll == '07' or $ll == '08' or $ll == '10' or $ll == '12'){

                    if(intval($zz) < 1 or intval($zz) > 31){
                        return 'CNP invalid! (zi nastere invalida)';
                    }
                }
                
                if($ll == '04' or $ll == '06' or $ll == '09' or $ll == '11'){
                    if(intval($zz) < 1 or intval($zz) > 30){
                        return 'CNP invalid! (zi nastere invalida)';
                    }
                }
                
                //In caz ca este an bisect 
                if($ll == '02'){
                    if($bisect){
                        if(intval($zz) < 1 or intval($zz) > 29){
                            return 'CNP invalid! (zi nastere invalida)';
                        }
                    }
                    else{
                        if(intval($zz) < 1 or intval($zz) > 28){
                            return 'CNP invalid! (zi nastere invalida)';
                        }
                    }
                }
                
                //Preluam judetul
                $judet = '';
                
                if($jj == '01') $judet = 'Alba';
                if($jj == '02') $judet = 'Arad';
                if($jj == '03') $judet = 'Argeș';
                if($jj == '04') $judet = 'Bacău';
                if($jj == '05') $judet = 'Bihor';
                if($jj == '06') $judet = 'Bistrița-Năsăud';
                if($jj == '07') $judet = 'Botoșani';
                if($jj == '08') $judet = 'Brașov';
                if($jj == '09') $judet = 'Brăila';
                if($jj == '10') $judet = 'Buzău';
                if($jj == '11') $judet = 'Caraș-Severin';
                if($jj == '12') $judet = 'Cluj';
                if($jj == '13') $judet = 'Constanța';
                if($jj == '14') $judet = 'Covasna';
                if($jj == '15') $judet = 'Dâmbovița';
                if($jj == '16') $judet = 'Dolj';
                if($jj == '17') $judet = 'Galați';
                if($jj == '18') $judet = 'Gorj';
                if($jj == '19') $judet = 'Harghita';
                if($jj == '20') $judet = 'Hunedoara';
                if($jj == '21') $judet = 'Ialomița';
                if($jj == '22') $judet = 'Iași';
                if($jj == '23') $judet = 'Ilfov';
                if($jj == '24') $judet = 'Maramureș';
                if($jj == '25') $judet = 'Mehedinți';
                if($jj == '26') $judet = 'Mureș';
                if($jj == '27') $judet = 'Neamț';
                if($jj == '28') $judet = 'Olt';
                if($jj == '29') $judet = 'Prahova';
                if($jj == '30') $judet = 'Satu Mare';
                if($jj == '31') $judet = 'Sălaj';
                if($jj == '32') $judet = 'Sibiu';
                if($jj == '33') $judet = 'Suceava';
                if($jj == '34') $judet = 'Teleorman';
                if($jj == '35') $judet = 'Timiș';
                if($jj == '36') $judet = 'Tulcea';
                if($jj == '37') $judet = 'Vaslui';
                if($jj == '38') $judet = 'Vâlcea';
                if($jj == '39') $judet = 'Vrancea';
                if($jj == '40') $judet = 'București';
                if($jj == '41') $judet = 'București Sector 1';
                if($jj == '42') $judet = 'București Sector 2';
                if($jj == '43') $judet = 'București Sector 3';
                if($jj == '44') $judet = 'București Sector 4';
                if($jj == '45') $judet = 'București Sector 5';
                if($jj == '46') $judet = 'București Sector 6';
                if($jj == '51') $judet = 'Călărași';
                if($jj == '52') $judet = 'Giurgiu';
                
                //Daca nu exista judet
                if($judet == ''){
                    return "CNP invalid (cifra judetului nu este corecta)";
                }
                
                //Verificam daca cifra de control este valida (am fi putut face aceasta verificare mai sus dar mesajele de eroare nu ar mai fi fost explicite)
                $cn = '279146358279';
                $nr = 0;
                $cifraControl = 0;

                for($i = 0; $i<12; $i++){
                    $nr = $nr + (intval($value[$i]) * intval($cn[$i]));
                }
                
                if($nr % 11 == 10){
                    $cifraControl = 1;
                }
                else{
                    $cifraControl = $nr % 11;
                }
                
                if($c != $cifraControl){
                    return 'Cifra de control invalida!';
                }
                
                return '<b>Data nasterii:</b> '.$zz.'.'.$ll.'.'.$an.$aa.'<br>
                <b>Sex:</b> '.$sex.'<br>
                <b>Judet:</b> '.$judet.'<br>
                <b>NNN:</b> '.$nnn.'<br>
                <b>Cifra control:</b> '.$c.' (valida)';
            }
            
            if(!isset($_POST['cnp'])){
                echo '
                <form id="cnp" method="post" action="index.php" autocomplete="off" class="box">
                    <h1>Validare CNP</h1>
                    <input type="text" id="input-cnp" name="cnp" placeholder="Introduceti CNP">
                    <button class="btn" type="submit">Verifica CNP</button>
                </form>';
            }
            else{
                echo '
                <div class="box">
                    <p class="msg">'. isCnpValid($_POST['cnp']) .'</p>
                    <a class="btn" href="index.php">Incearca din nou</a>
                </div>';
            }
        
        ?>
    </body>
</html>