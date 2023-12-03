<?php


$aoc = new aoc();

echo "Task A: " . $aoc->solveTaskA();
echo "Task B: " . $aoc->solveTaskB();


class aoc
{

    /* ------------------------------------------------------------------------ */

    public function solveTaskA()
    {

        // only 12 red cubes, 13 green cubes, and 14 blue cubes?
        $config = [
            "red" => 12,
            "blue" => 14,
            "green" => 13,
        ];

        $lines = explode("\n", $this->readInput());

        $id_sum = 0;


        // Game 2: 1 blue, 2   green; 3 green, 4 blue, 1 red; 1 green, 1 blue
        foreach ($lines as $key => $line) {
            $line = trim($line);

            if (trim($line)) {
            }



        }

        return $id_sum;

    }

    /* ------------------------------------------------------------------------ */

    public function solveTaskB()
    {
 
        $lines = explode("\n", $this->readInput());

        $sum = 0;


        // Game 2: 1 blue, 2   green; 3 green, 4 blue, 1 red; 1 green, 1 blue
        foreach ($lines as $key => $line) {

            $line = trim($line);

            if (trim($line)) {




            }
        }

        return $sum;

    }

    /* ------------------------------------------------------------------------ */

    private function readInput()
    {
        return file_get_contents("./data.txt");
    }

    /* ------------------------------------------------------------------------ */



}