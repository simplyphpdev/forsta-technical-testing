<?php
/**
 * Problem statement #
 *
 * You are given a collection of sorted integers ($inputs). For any given number ($x),
 * return a floor and ceil value of from the given array inputs. If either ceil or floor
 * does not exist in the given array, -1 should be returned in its place.
 * Include a unit test with your solution.
 *
 * Input #
 *
 * The inputs are:
 *
 *     An array of integers inputs ($input)
 *     An integer ($x) containing any real number
 *
 * Output #
 *
 *     The output is two Integer variables containing floor and ceiling value of $x.
 */

class FloorCeilingFinder
{
    const CEIL_DEFAULT_VALUE = -1;
    const FLOOR_DEFAULT_VALUE = -1;

    /**
     * Find floor and Ceiling of given array with given int input
     *
     * @param array $inputData
     * @param int $x
     * @return array|int[]
     */
    public static function find(array $inputData, int $x): array
    {
        $inputSize = count($inputData);
        $floor = self::FLOOR_DEFAULT_VALUE;
        $ceil = self::CEIL_DEFAULT_VALUE;

        // if no input data is provided return default values
        if(!$inputSize) {
            return [$floor, $ceil];
        }

        $start = 0;
        $end = $inputSize - 1;

        while ($start <= $end) {
            $mid = intval(($start + $end) / 2);

            if ($inputData[$mid] == $x) {
                // If x is found, both floor and ceil are x
                return [$inputData[$mid], $inputData[$mid]];
            } elseif ($inputData[$mid] < $x) {
                // Update floor and search in the right half
                $floor = $inputData[$mid];
                $start = $mid + 1;
            } else {
                // Update ceil and search in the left half
                $ceil = $inputData[$mid];
                $end = $mid - 1;
            }
        }

        return [$floor, $ceil];
    }
}

class UnitTestsChallenge
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
            $results = FloorCeilingFinder::find($value, $targetNumbers[$key]);
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
            $results = FloorCeilingFinder::find($value, $targetNumbers[$key]);
            assert([-1,-1] == $results);
        }
    }
}

// Example
FloorCeiling::find([2, 4, 45, 4555, 8883], 5); // [4, 45]
FloorCeiling::find([2, 4, 45, 4555, 8883], 10000); // [8883, -1]

// Run tests
(new UnitTestsChallenge())->executeAllTests();
