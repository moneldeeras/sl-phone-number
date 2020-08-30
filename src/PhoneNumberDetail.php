<?php

declare(strict_types=1);

namespace MonElDeeras\SlPhoneNumber;

class PhoneNumberDetail
{
    /** @var string */
    private $number;

    /** @var string */
    private $type;

    /** @var string */
    private $operator;

    /** @var array */
    private $location;

    /** @var string */
    private $province = null;

    /** @var string */
    private $district = null;

    /** @var string */
    private $area = null;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        $this->checkLocationDetails();
        return $this->province;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        $this->checkLocationDetails();
        return $this->district;
    }

    /**
     * @return string
     */
    public function getArea(): string
    {
        $this->checkLocationDetails();
        return $this->area;
    }

    /**
     * PhoneNumberDetail constructor.
     * @param string $number
     * @param string $type
     * @param string $operator
     * @param array $location
     */
    public function __construct(string $number, string $type, string $operator, array $location = null)
    {
        $this->number = $number;
        $this->type = $type;
        $this->operator = $operator;
        if ($location !== null) {
            $this->province = $location['province'];
            $this->district = $location['district'];
            $this->area = $location['area'];
        }
    }

    private function checkLocationDetails(): void
    {
        if ($this->province === null && $this->district === null && $this->area === null) {
            throw new \LogicException('Can not read location details');
        }
    }
}
