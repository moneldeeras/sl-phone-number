<?php

declare(strict_types=1);

namespace MonElDeeras\SlPhoneNumber;

use InvalidArgumentException;

class PhoneNumberTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     * @dataProvider phoneNumbersWithValidity
     * @param string $number
     * @param bool $validity
     * @param string|null $formatted
     */
    public function get_details_throws_an_exception_when_the_starting_digit_or_length_is_invalid(string $number, bool $validity, string $formatted = null)
    {
        $slPhoneNumber = new PhoneNumber($number);

        if (! $validity) {
            $this->expectException(InvalidArgumentException::class);
        }

        $result = $slPhoneNumber->getData();

        $this->assertEquals(['number' => $formatted], $result);
    }

    /**
     * @test
     * @dataProvider phoneNumbersWithValidity
     * @param string $number
     * @param bool $validity
     */
    public function it_validates_phone_number_by_starting_digits_and_length(string $number, bool $validity)
    {
        $slPhoneNumber = new PhoneNumber($number);

        $this->assertEquals($validity, $slPhoneNumber->isValid());
    }

    // 0(000000000)
    // +94(000000000)
    // 0094(000000000)
    public function phoneNumbersWithValidity()
    {
        return [
            ['0000000000', true, '0000000000'], // 10 digits starting with 0
            ['10000000000', false, null], // 10 digits starting with 1
            ['000000000', false, null], // 9 digits
            ['00000000000', false, null], // 11 digits

            ['+94000000000', true, '0000000000'], // +94 and 9 digits
            ['-94000000000', false, null], // -94 and 9 digits
            ['+9400000000', false, null], // +94 and 8 digits
            ['+940000000000', false, null], // +94 and 10 digits

            ['0094000000000', true, '0000000000'], // 0094 and 9 digits
            ['0096000000000', false, null], // 0096 and 9 digits
            ['009400000000', false, null], // 0094 and 8 digits
            ['00940000000000', false, null], // 0094 and 10 digits
        ];
    }
}
