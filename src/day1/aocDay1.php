<?php

class aocDay1 {
    
    /* ------------------------------------------------------------------------ */

    public function solveTaskA()  {
        
        $lines = explode("\n", $this->readInput() ) ;

        $sum = 0 ;

        foreach ($lines as $key=>$line) {

            if ( trim($line) ) {

                $left_decimal = "" ;
                $right_decimal = "" ;

                for ($i = 0; $i < strlen($line) ; $i++) {
                    if ( $line[$i] >= "0" && $line[$i] <= "9") {
                        $left_decimal = $line[$i];
                        break ;
                    }
                }

                for ($i = strlen($line)-1 ; $i>=0; $i--) {
                    if ( $line[$i] >= "0" && $line[$i] <= "9") {
                        $right_decimal = $line[$i];
                        break ;
                    }
                }
                
                $sum += intval($left_decimal . $right_decimal) ;

            }

        }

        return $sum ;

    } 
    
    /* ------------------------------------------------------------------------ */

    public function solveTaskB () {

        $lines = explode("\n", $this->readInput() ) ;
        
        $tokens = $this->decimalTokens() ;

        $sum = 0 ;

        foreach ($lines as $key=>$line) {
            
            if ( trim($line) ) {
            
                $left_decimal = "" ;
                $right_decimal = "" ;

                $mp = strlen($line) ;
                foreach ($tokens as $k2 => $v2) {

                    $pl = strpos($line,$k2) ;
                    if ( $pl !== false ) {
                        $pl = strpos($line,$k2) ;
                        if ( $pl < $mp ) {
                            $left_decimal = $v2 ;
                            $mp = $pl ;
                        }
                    }

                }
                
                $mp = -1  ;
                foreach ($tokens as $k2 => $v2) {
                    
                    $pr = strrpos($line,$k2) ;
                    if ( $pr !== false ) {
                        if ( $pr > $mp) {
                            $right_decimal = $v2 ;
                            $mp = $pr ;
                        }
                    }

                }

                $sum += (int)($left_decimal . $right_decimal) ;
                
            }
            
        }

        return $sum ;

    }

    /* ------------------------------------------------------------------------ */

    private function readInput() {
        
        return file_get_contents("./data.txt") ;
    
    }

    /* ------------------------------------------------------------------------ */

    private function decimalTokens() {
        return [
        "one" => 1 ,
        "two" => 2 ,
        "three" => 3 ,
        "four" => 4 ,
        "five" => 5 ,
        "six" => 6 ,
        "seven" => 7 ,
        "eight" => 8 ,
        "nine" => 9 ,
        "0" => 0 ,
        "1" => 1 ,
        "2" => 2 ,
        "3" => 3 ,
        "4" => 4 ,
        "5" => 5,
        "6" => 6 ,
        "7" => 7 ,
        "8" => 8 ,
        "9" => 9 ,
        ] ;
    }

}