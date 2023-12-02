<?php


$aoc = new aocDay2();

echo "Task A: " . $aoc->solveTaskA() ;
echo "Task B: " . $aoc->solveTaskB();


class aocDay2
{

    /* ------------------------------------------------------------------------ */

    public function solveTaskA()
    {
        
        // only 12 red cubes, 13 green cubes, and 14 blue cubes?
        $config = [
            "red"=> 12,
            "blue"=> 14,
            "green"=> 13,
        ] ;

        $lines = explode("\n", $this->readInput());

        $id_sum = 0;


        // Game 2: 1 blue, 2   green; 3 green, 4 blue, 1 red; 1 green, 1 blue
        foreach ($lines as $key => $line) {
            $line = trim ($line);

            if (trim($line)) {
                

                $items = explode(":",$line) ;
                $data_line=trim($items[1]) ;

                $tmp = explode(" ",$items[0]) ;
                $game_id = $tmp[1] ;
                
                $sets = explode(";",$data_line) ;

                $all_sets_valid = true ;

                foreach ($sets as $set_line) {

                    $cube_count = [
                        "red" => 0,
                        "green" => 0,
                        "blue" => 0,
                    ];

                    $set_line = trim($set_line) ;
                    
                    $cubes = explode(",",$set_line) ;
                    foreach ($cubes as $cube_line) {

                        $cube_line = trim($cube_line);

                        $items = explode( " ", $cube_line);

                        $color = trim($items[1]) ;
                        $cnt = trim($items[0]) ;

                        $cube_count[$color] += (int)$cnt ;

                    }

                    if ($cube_count['red'] > $config['red'] || $cube_count['green'] > $config['green'] || $cube_count['blue'] > $config['blue']) {
                        $all_sets_valid = false ;
                    }
                }
                if ($all_sets_valid) {
                    $id_sum += $game_id;
                }
            }
        }

        return $id_sum;

    }

    /* ------------------------------------------------------------------------ */

    public function solveTaskB()
    {

        // only 12 red cubes, 13 green cubes, and 14 blue cubes?
        $config = [
            "red" => 12,
            "blue" => 14,
            "green" => 13,
        ];

        $lines = explode("\n", $this->readInput());

        $sum = 0;


        // Game 2: 1 blue, 2   green; 3 green, 4 blue, 1 red; 1 green, 1 blue
        foreach ($lines as $key => $line) {
            
            $line = trim($line);

            if (trim($line)) {


                $items = explode(":", $line);
                $data_line = trim($items[1]);

                $tmp = explode(" ", $items[0]);
                $game_id = $tmp[1];

                $sets = explode(";", $data_line);

                $cube_count = [
                    "red" => 0,
                    "green" => 0,
                    "blue" => 0,
                ];

                foreach ($sets as $set_line) {

                    $set_line = trim($set_line);

                    $cubes = explode(",", $set_line);
                    foreach ($cubes as $cube_line) {

                        $cube_line = trim($cube_line);

                        $items = explode(" ", $cube_line);

                        $color = trim($items[1]);
                        $cnt = trim($items[0]);
                        
                        if ( $cnt > $cube_count[$color] ) {
                            $cube_count[$color] = $cnt ;
                        }

                    }

                }
                
                $sum += ($cube_count["red"] * $cube_count["blue"] * $cube_count["green"]) ;
            }
        }

        return $sum;

    }

    /* ------------------------------------------------------------------------ */

    private function readInput()
    {
        /* 
        return "
        Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
        Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
        Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
        Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
        Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green        " ; 
        */
        
        return file_get_contents("./data.txt");


    }

    /* ------------------------------------------------------------------------ */

    

}