<?php


namespace MonElDeeras\SlPhoneNumber;


use InvalidArgumentException;

class PhoneNumber
{
    private $areaCode = [
        '063' => ['province' => 'Eastern', 'district' => 'Ampara', 'area' => 'Ampara'],
        '025' => ['province' => 'North Central', 'district' => 'Anuradhapura', 'area' => 'Anuradhapura'],
        '036' => ['province' => 'Western, Sabaragamuwa', 'district' => 'colombo, Kegalle, Rathnapura', 'area' => 'Avissawella'],
        '055' => ['province' => 'Uva', 'district' => 'Monaragala,Badulla', 'area' => 'Monaragala,Badulla'],
        '057' => ['province' => 'Uva', 'district' => 'Badulla', 'area' => 'Bandarawela'],
        '065' => ['province' => 'Eastern', 'district' => 'Batticaloa', 'area' => 'Batticaloa'],
        '032' => ['province' => 'North Western', 'district' => 'Puttalam', 'area' => 'Chilaw'],
        '011' => ['province' => 'Western', 'district' => 'Colombo', 'area' => 'Colombo'],
        '091' => ['province' => 'Southern', 'district' => 'Galle', 'area' => 'Galle'],
        '033' => ['province' => 'Western', 'district' => 'Gampaha', 'area' => 'Gampaha'],
        '047' => ['province' => 'Southern', 'district' => 'Hambantota', 'area' => 'Hambantota'],
        '051' => ['province' => 'Central', 'district' => 'Nuwara Eliya', 'area' => 'Hatton, Sri Lanka|Hatton'],
        '021' => ['province' => 'Northern', 'district' => 'Jaffna', 'area' => 'Jaffna'],
        '067' => ['province' => 'Eastern', 'district' => 'Ampara', 'area' => 'Kalmunai'],
        '034' => ['province' => 'Western', 'district' => 'Kalutara', 'area' => 'Kalutara'],
        '081' => ['province' => 'Central', 'district' => 'Kandy', 'area' => 'Kandy'],
        '035' => ['province' => 'Sabaragamuwa', 'district' => 'Kegalle', 'area' => 'Kegalle'],
        '037' => ['province' => 'North Western', 'district' => 'Kurunegala', 'area' => 'Kurunegala'],
        '023' => ['province' => 'Northern', 'district' => 'Mannar', 'area' => 'Mannar'],
        '066' => ['province' => 'Central', 'district' => 'Matale', 'area' => 'Matale'],
        '041' => ['province' => 'Southern', 'district' => 'Matara', 'area' => 'Matara'],
        '054' => ['province' => 'Central', 'district' => 'Kandy', 'area' => 'Nawalapitiya'],
        '031' => ['province' => 'Western', 'district' => 'Gampaha', 'area' => 'Negombo'],
        '052' => ['province' => 'Central', 'district' => 'Nuwara Eliya', 'area' => 'Nuwara Eliya'],
        '038' => ['province' => 'Western', 'district' => 'Kalutara', 'area' => 'Panadura'],
        '027' => ['province' => 'North Central', 'district' => 'Polonnaruwa', 'area' => 'Polonnaruwa'],
        '045' => ['province' => 'Sabaragamuwa', 'district' => 'Ratnapura', 'area' => 'Ratnapura'],
        '026' => ['province' => 'Eastern', 'district' => 'Trincomalee', 'area' => 'Trincomalee'],
        '024' => ['province' => 'Northern', 'district' => 'Vavuniya', 'area' => 'Vavuniy'],
    ];

    private $operatorCode = [
        '0' => ['name' => 'Lanka Bell', 'type' => 'Fixed LTE'],
        '2' => ['name' => 'Sri Lanka Telecom', 'type' => 'Fixed Fiber or Copper'],
        '3' => ['name' => 'Sri Lanka Telecom', 'type' => 'Fixed CDMA or LTE'],
        '4' => ['name' => 'Dialog', 'type' => 'Fixed LTD'],
        '5' => ['name' => 'Lanka Bell', 'type' => 'Fixed CDMA'],
        '7' => ['name' => 'Dialog', 'type' => 'Fixed LTE'],
        '9' => ['name' => 'Tritel', 'type' => 'Public Payphones'],
    ];

    private $mobileOperatorCode = [
      '070' => ['name' => 'Mobitel'],
      '071' => ['name' => 'Mobitel'],
      '072' => ['name' => 'Hutch'],
      '074' => ['name' => 'Dialog'],
      '075' => ['name' => 'Airtel'],
      '076' => ['name' => 'Dialog'],
      '077' => ['name' => 'Dialog'],
      '078' => ['name' => 'Hutch'],
    ];

    /** @var string */
    private $number;

    /**
     * PhoneNumber constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getData(): array
    {
        if (! preg_match('/^0[0-9]{9}$/', $this->number)) {
            throw new InvalidArgumentException('Invalid Phone number.');
        }

        return [
          'number' => $this->number
        ];
    }

    public function isValid(): bool
    {
        try {
            $this->getData();

            return true;
        } catch (InvalidArgumentException $exception) {
            return false;
        }
    }
}
