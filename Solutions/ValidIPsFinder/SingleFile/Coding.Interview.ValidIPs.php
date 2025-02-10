<?php

/**
 * Problem statement #
 *
 * Given a string containing only digits, restore it by returning
 * all possible valid IP address combinations.
 * Include a unit test with your solution.
 *
 * Input #
 *
 * A string of numbers
 * Example input: "25525511135"
 *
 * Output #
 *
 * An array of pssible IP addresses
 * Example: ["255.255.11.135", "255.255.111.35"]
 */

class ValidIpsFinder
{
    const MIN_IP_SEGMENT_SIZE = 0;

    const MAX_IP_SEGMENT_SIZE = 255;

    const SEGMENT_DIVISIONS_COUNT = 4;

    const MIN_STR_INPUT_SIZE = 4;

    const MAX_STR_INPUT_SIZE = 12;


    /**
     * Check if a string is a valid ip sequence and return its possible combinations.
     * A valid IPv4 address range is between 0.0.0.0 and 255.255.255
     *
     * @param string $strInput
     * @return array
     */
    public static function possible_valid_ip_addresses(string $strInput): array
    {
        $inputLength = strlen($strInput);
        $validIps = [];

        if(!is_numeric($strInput)) {
            return $validIps;
        }

        if ($inputLength < self::MIN_STR_INPUT_SIZE || $inputLength > self::MAX_STR_INPUT_SIZE) {
            return $validIps;
        }

        // Iterate through all possible positions for the first three dots
        for ($i = 1; $i < $inputLength && $i < self::SEGMENT_DIVISIONS_COUNT; $i++) {
            $firstSegment = substr($strInput, 0, $i);
            if (!self::is_valid_segment($firstSegment)) {
                continue;
            }

            for ($j = 1; $i + $j < $inputLength && $j < self::SEGMENT_DIVISIONS_COUNT; $j++) {
                $secondSegment = substr($strInput, $i, $j);
                if (!self::is_valid_segment($secondSegment)) {
                    continue;
                }

                for ($k = 1; $i + $j + $k < $inputLength && $k < self::SEGMENT_DIVISIONS_COUNT; $k++) {
                    $thirdSegment = substr($strInput, $i + $j, $k);
                    $fourthSegment = substr($strInput, $i + $j + $k);

                    if (self::is_valid_segment($thirdSegment) && self::is_valid_segment($fourthSegment)) {
                        $validIps[] = "$firstSegment.$secondSegment.$thirdSegment.$fourthSegment";
                    }
                }
            }
        }

        return $validIps;
    }

    /**
     * Check if ip segment is valid (string has a valid size and is a number between 0 and 255)
     *
     * @param string $segmentData
     * @return bool
     */
    private static function is_valid_segment(string $segmentData): bool
    {
        $segmentLength = strlen($segmentData);

        // Check if the segment is empty or longer than 3 digits
        if ($segmentLength == 0 || $segmentLength > 3) {
            return false;
        }

        // Check if the segment has leading zeros
        if ($segmentData[0] == '0' && $segmentLength > 1) {
            return false;
        }

        // Check if the segment is a valid number between 0 and 255
        $segmentNumber = (int) $segmentData;
        return $segmentNumber >= self::MIN_IP_SEGMENT_SIZE && $segmentNumber <= self::MAX_IP_SEGMENT_SIZE;
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
            $this->check_if_can_handle_invalid_input_data();
            print_r('all passed!');
        } catch (\Exception|AssertionError $exception){
            print_r('test failed!');
            print_r($exception->getMessage());
        }
    }


    /**
     * @return void
     */
    public function check_if_can_find_valid_ranges(): void
    {
        $ipRanges = ['0000', '255255255255','1111', '25525511135'];
        $expectedResults = [['0.0.0.0'], ['255.255.255.255'], ['1.1.1.1'], ['255.255.11.135','255.255.111.35']];
        foreach ($ipRanges as $key => $value) {
            $results = ValidIpsFinder::possible_valid_ip_addresses($value);
            assert($expectedResults[$key] == $results);
        }
    }

    /**
     * @return void
     */
    public function check_if_can_return_for_invalid_ranges(): void
    {
        $invalidIpRanges = ['0000000000000', '256255255255','2552551113567834', '25525511135678'];
        foreach ($invalidIpRanges as $value) {
            $results = ValidIpsFinder::possible_valid_ip_addresses($value);
            assert([] == $results);
        }
    }

    /**
     * @return void
     */
    public function check_if_can_handle_invalid_input_data(): void
    {
        $invalidIpRanges = ['abcd', '!@#!@$%$','|||||', '  123456  33434'];
        foreach ($invalidIpRanges as $value) {
            $results = ValidIpsFinder::possible_valid_ip_addresses($value);
            assert([] == $results);
        }
    }
}

// Just an interface fallback :)
function possible_valid_ip_addresses($str): array
{
    return ValidIpsFinder::possible_valid_ip_addresses($str);
}

possible_valid_ip_addresses('25525511135'); // ["255.255.11.135","255.255.111.35"]
// Run tests
(new UnitTestsChallenge())->executeAllTests();