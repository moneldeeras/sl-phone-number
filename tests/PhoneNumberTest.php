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
     * @param string|null $type
     */
    public function get_details_throws_an_exception_when_the_starting_digit_or_length_is_invalid(
        string $number,
        bool $validity,
        string $formatted = null
    ) {
        $slPhoneNumber = new PhoneNumber($number);

        if (! $validity) {
            $this->expectException(InvalidArgumentException::class);
        }

        /** PhoneNumberDetail $result */
        $result = $slPhoneNumber->getDetails();

        $this->assertEquals($formatted, $result->getNumber());
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
            ['0112000000', true, '0112000000'], // 10 digits starting with 0
            ['0770000000', true, '0770000000'], // 10 digits starting with 0
            ['10000000000', false, null, null], // 10 digits starting with 1
            ['000000000', false, null], // 9 digits
            ['00000000000', false, null], // 11 digits

            ['+94112000000', true, '0112000000'], // +94 and 9 digits
            ['+94770000000', true, '0770000000'], // +94 and 9 digits
            ['-94000000000', false, null, null], // -94 and 9 digits
            ['+9400000000', false, null, null], // +94 and 8 digits
            ['+940000000000', false, null, null], // +94 and 10 digits

            ['0094112000000', true, '0112000000'], // 0094 and 9 digits
            ['0094770000000', true, '0770000000'], // 0094 and 9 digits
            ['0096000000000', false, null, null], // 0096 and 9 digits
            ['009400000000', false, null, null], // 0094 and 8 digits
            ['00940000000000', false, null, null], // 0094 and 10 digits
        ];
    }

    /** @test */
    public function get_details_returns_phone_number_detail_object()
    {
        $details = (new PhoneNumber('0770000000'))->getDetails();

        $this->assertInstanceOf(PhoneNumberDetail::class, $details);
        $this->assertEquals('Dialog', $details->getOperator());

        $fixedDetails = (new PhoneNumber('0112000000'))->getDetails();

        $this->assertInstanceOf(PhoneNumberDetail::class, $fixedDetails);
        $this->assertEquals('Sri Lanka Telecom', $fixedDetails->getOperator());
        $this->assertEquals('Western', $fixedDetails->getProvince());
        $this->assertEquals('Colombo', $fixedDetails->getDistrict());
        $this->assertEquals('Colombo', $fixedDetails->getArea());
    }

    /** @test */
    public function it_throws_logic_exception_when_trying_to_get_province_from_mobile_number()
    {
        $details = (new PhoneNumber('0770000000'))->getDetails();
        $this->expectException(\LogicException::class);
        $details->getProvince();
    }

    /** @test */
    public function it_throws_logic_exception_when_trying_to_get_district_from_mobile_number()
    {
        $details = (new PhoneNumber('0770000000'))->getDetails();
        $this->expectException(\LogicException::class);
        $details->getDistrict();
    }

    /** @test */
    public function it_throws_logic_exception_when_trying_to_get_area_from_mobile_number()
    {
        $details = (new PhoneNumber('0770000000'))->getDetails();
        $this->expectException(\LogicException::class);
        $details->getArea();
    }
}
