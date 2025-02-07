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

class FloorCeiling
{
    public static function find(array $input, int $x): array
    {
        // Code here
    }
}

// Example
FloorCeiling::find([2, 4, 45, 4555, 8883], 5); // [4, 45]
FloorCeiling::find([2, 4, 45, 4555, 8883], 10000); // [8883, -1]
