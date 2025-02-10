<?php

namespace Solutions\FloorCeilingFinder;

use AssertionError;

class UnitTests
{

    /**
     * @return void
     */
    public function executeAllTests(): void
    {
        try{
            $this->check_if_can_find_valid_ranges();
            $this->check_if_can_return_for_invalid_ranges();
            print_r('all passed!');
        } catch (\Exception|AssertionError $exception){
            print_r('test failed! ');
            print_r($exception->getMessage());
        }
    }


    /**
     * @return void
     */
    public function check_if_can_find_valid_ranges(): void
    {
        $numbers = [[2, 4, 45, 4555, 8883], [2, 4, 45, 4555, 8883], [0, 1, 2, 3, 4]];
        $targetNumbers = [10000, 5, 2];
        $expectedResults = [[8883, -1], [4, 45], [2,2]];
        foreach ($numbers as $key => $value) {
            $results = FloorCeiling::find($value, $targetNumbers[$key]);
            assert($expectedResults[$key] == $results);
        }
    }

    /**
     * @return void
     */
    public function check_if_can_return_for_invalid_ranges(): void
    {
        $numbers = [[]];
        $targetNumbers = [90000];
        foreach ($numbers as $key => $value) {
            $results = FloorCeiling::find($value, $targetNumbers[$key]);
            assert([-1,-1] == $results);
        }
    }
}