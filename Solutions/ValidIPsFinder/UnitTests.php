<?php

namespace Solutions\ValidIPsFinder;

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
            $results = ValidIps::possible_valid_ip_addresses($value);
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
            $results = ValidIps::possible_valid_ip_addresses($value);
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
            $results = ValidIps::possible_valid_ip_addresses($value);
            assert([] == $results);
        }
    }
}