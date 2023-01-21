<?php

namespace App\Actions\App;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class CreateValidPhoneNumber
{
    public function createPhone($value)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phone = $phoneUtil->parse($value,'PS');
            $valid = $phoneUtil->isValidNumber($phone);
            if ($valid) {
                return $phoneUtil->format($phone, PhoneNumberFormat::E164);
            }
        } catch (NumberParseException $e) {
            return $e->getMessage();
        }
    }
}
