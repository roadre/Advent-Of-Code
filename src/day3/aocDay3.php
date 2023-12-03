<?php


$aoc = new aoc();

echo "Task A: " . $aoc->solveTaskA() ;
echo "Task B: " . $aoc->solveTaskB() ;


class aoc
{

    /* ------------------------------------------------------------------------ */

    public function solveTaskA()
    {

        /* 
            4 6 7 . . 1 1 4 . .
            . . . * . . . . . . 
            . . 3 5 . . 6 3 3 . 
            . . . . . . # . . . 
            6 1 7 * . . . . . . 
            . . . . . + . 5 8 . 
            . . 5 9 2 . . . . . 
            . . . . . . 7 5 5 . 
            . . . $ . * . . . . 
            . 6 6 4 . 5 9 8 . . 

        */

        $lines = $this->readInput() ;

        $digits = [] ;

        $sum = 0;


        /* 
            Scan for Numbers in the Array Lines
        */

        $line_number = 0;
        foreach ($lines as $line) {
            $i = 0 ;
            do {
                if ( $this->is_digit($line[$i]) ) {

                    $pos = [ 'line' => $line_number, 'pos' => $i, 'len' => 0, 'value' => '', 'has_adjacent' => false ] ;

                    while( $i < strlen($line) && $this->is_digit($line[$i]) ) {
                        $pos['len'] ++ ;
                        $pos['value'] .= $line[$i] ;
                        $i++ ;
                    }
                    $digits[] = $pos ;

                } else {
                    $i++;
                }
            } while ($i < strlen($line)) ;
            $line_number ++;
        }

        /* 
            Scan adjacents
        */

        for ($i = 0; $i < count($digits); $i ++) {
            
            $has_adjacent = false ;

            $digit = $digits[$i];

            // Above
            
            if ( $digit['line'] > 0) {
                
                for ( $pos = $digit['pos'] - 1 ; $pos < $digit['pos'] + $digit['len'] + 1; $pos++ ) {
                    
                    $char = $this->char_at($lines,$digit['line']-1,$pos) ;
                    
                    if ( $this->is_adjacent_char($char) ) {
                        $has_adjacent = true;
                    }

                }
            }

            
            // Same Line
            
            $char = $this->char_at($lines, $digit['line'], $digit['pos']-1);
            if ($this->is_adjacent_char($char)) {
                $has_adjacent = true;
            }

            $char = $this->char_at($lines, $digit['line'], $digit['pos'] + $digit['len'] );
            if ($this->is_adjacent_char($char)) {
                $has_adjacent = true;
            }


            // Below
            
            if ( $digit['line'] < count($lines) ) {

                for ($pos = $digit['pos'] - 1; $pos < $digit['pos'] + $digit['len'] + 1; $pos++) {

                    $char = $this->char_at($lines, $digit['line']+1, $pos);
                    if ($this->is_adjacent_char($char)) {
                        $has_adjacent = true;
                    }

                }
            }


            $digits[$i]['has_adjacent'] = $has_adjacent;
            if ( $has_adjacent ) {
                $sum += $digits[$i]['value'] ;
            }

        }
        
        return $sum;

    }

    /* ------------------------------------------------------------------------ */

    public function solveTaskB()
    {

        /* 
            4 6 7 . . 1 1 4 . .
            . . . * . . . . . . 
            . . 3 5 . . 6 3 3 . 
            . . . . . . # . . . 
            6 1 7 * . . . . . . 
            . . . . . + . 5 8 . 
            . . 5 9 2 . . . . . 
            . . . . . . 7 5 5 . 
            . . . $ . * . . . . 
            . 6 6 4 . 5 9 8 . . 

        */

        $lines = $this->readInput();

        $digits = [];

        $sum = 0;

        $gears = [];

        /* 
            Scan for Numbers in the Array Lines
        */

        $line_number = 0;
        foreach ($lines as $line) {
            $i = 0;
            do {
                if ($this->is_digit($line[$i])) {

                    $pos = ['line' => $line_number, 'pos' => $i, 'len' => 0, 'value' => '', 'has_adjacent' => false];

                    while ($i < strlen($line) && $this->is_digit($line[$i])) {
                        $pos['len']++;
                        $pos['value'] .= $line[$i];
                        $i++;
                    }
                    $digits[] = $pos;

                } else {
                    $i++;
                }
            } while ($i < strlen($line));
            $line_number++;
        }

        /* 
            Scan adjacents for "*"
        */

        for ($i = 0; $i < count($digits); $i++) {

            $digit = $digits[$i];

            // Above

            if ($digit['line'] > 0) {
                for ($pos = $digit['pos'] - 1; $pos < $digit['pos'] + $digit['len'] + 1; $pos++) {

                    $char = $this->char_at($lines, $digit['line'] - 1, $pos);
                    if ( $char == "*") {
                        $this->addToGear($gears, $digit['line'] - 1, $pos, $i);
                    }
                }
            }


            // Same Line

            $char = $this->char_at($lines, $digit['line'], $digit['pos'] - 1);
            if ($char == "*") {
                $this->addToGear( $gears, $digit['line'], $digit['pos'] - 1, $i ) ;
            }

            $char = $this->char_at($lines, $digit['line'], $digit['pos'] + $digit['len']);
            if ($char == "*") {
                $this->addToGear($gears, $digit['line'], $digit['pos'] + $digit['len'], $i);
            }

            // Below

            if ($digit['line'] < count($lines)) {

                for ($pos = $digit['pos'] - 1; $pos < $digit['pos'] + $digit['len'] + 1; $pos++) {

                    $char = $this->char_at($lines, $digit['line'] + 1, $pos);
                    if ($char == "*") {
                        $this->addToGear($gears, $digit['line'] + 1, $pos, $i);
                    }

                }
            }

        }

        $total_sum = 0 ;

        foreach ( $gears as $key => $value ) {
            
            if ( count($value) > 1) {
                $total_sum += $digits[ $value[0] ]['value'] * $digits[ $value[1] ]['value'] ;
            }
        }

        return $total_sum;

    }

    /* ------------------------------------------------------------------------ */

    public function addToGear( &$gears, $line, $pos, $index)
    {
        $key = "l" . $line . "_p" . $pos;
        if (!array_key_exists($key, $gears)) {
            $gears[$key] = [];
        }
        $gears[$key][] = $index;

    }

    /* ------------------------------------------------------------------------ */
    
    public function is_digit( $char ) {
        return $char >= "0" && $char <= "9" ;
    }

    /* ------------------------------------------------------------------------ */

    public function is_adjacent_char($char)
    {
        return $char != null && $char != "." && ! ($char >= "0" && $char <= "9") ;
    }

    /* ------------------------------------------------------------------------ */
    
    public function char_at( $array , $line , $pos ) {
        
        if ( $line < 0 ) {
            return null ;
        } elseif ($line >= count( $array )) {
            return null ;
        } elseif ( $pos < 0 ) {
            return null ;
        } elseif ( $pos >= strlen($array[$line]) ) {
            return null ;
        } else {
            return $array[$line][$pos] ;
        }
    }

    /* ------------------------------------------------------------------------ */
    private function readInput()
    {
        $inp = $this->readFileInput() ;
        // $inp = $this->readDemoInput();

        $lines = explode("\n", $inp);

        $ret = [];

        // Game 2: 1 blue, 2   green; 3 green, 4 blue, 1 red; 1 green, 1 blue
        foreach ($lines as $key => $line) {
            $line = trim($line);

            if (trim($line)) {
                $ret[] = trim($line);
            }
        }

        return $ret ;
    }

    private function readDemoInput()
    {
        $inp = "
            467..114..
            ...*......
            ..35..633.
            ......#...
            617*......
            .....+.58.
            ..592.....
            ......755.
            ...$.*....
            .664.598..
        " ;
        return $inp ;
    }

    private function readFileInput()
    {

        return file_get_contents("./data.txt");

    }
    /* ------------------------------------------------------------------------ */



}