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
     */
    public function getDetails_throws_an_exception_when_the_starting_digits_or_length_is_invalid(string $number, bool $validity)
    {
        $slPhoneNumber = new PhoneNumber($number);

        if ( !$validity ) {
            $this->expectException(InvalidArgumentException::class);
        }

        $result = $slPhoneNumber->getData();

        $this->assertIsArray($result);
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
            ['0000000000', true], // 10 digits starting with 0
            ['10000000000', false], // 10 digits starting with 1
            ['000000000', false], // 9 digits
            ['00000000000', false], // 11 digits
        ];
    }
}
