<?php
namespace Solutions\FloorCeilingFinder;

class FloorCeiling
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