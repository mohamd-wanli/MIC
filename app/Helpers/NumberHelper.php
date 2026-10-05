<?php

namespace App\Helpers;

class NumberHelper
{
    private static array $ones = [
        '', 'واحد', 'اثنان', 'ثلاثة', 'أربعة', 'خمسة',
        'ستة', 'سبعة', 'ثمانية', 'تسعة', 'عشرة',
        'أحد عشر', 'اثنا عشر', 'ثلاثة عشر', 'أربعة عشر', 'خمسة عشر',
        'ستة عشر', 'سبعة عشر', 'ثمانية عشر', 'تسعة عشر',
    ];

    private static array $tens = [
        '', '', 'عشرون', 'ثلاثون', 'أربعون', 'خمسون',
        'ستون', 'سبعون', 'ثمانون', 'تسعون',
    ];

    private static array $hundreds = [
        '', 'مئة', 'مئتان', 'ثلاثمئة', 'أربعمئة', 'خمسمئة',
        'ستمئة', 'سبعمئة', 'ثمانمئة', 'تسعمئة',
    ];

    public static function toWords($number): string
    {
        $number = (int) round((float) $number);

        if ($number === 0) return 'صفر';
        if ($number < 0)  return 'سالب ' . self::toWords(abs($number));

        $parts = [];

        // Billions
        $billions = intdiv($number, 1_000_000_000);
        $number   = $number % 1_000_000_000;
        if ($billions > 0) {
            $parts[] = self::scaleWords($billions, 'مليار', 'ملياران', 'مليارات', 'مليار');
        }

        // Millions
        $millions = intdiv($number, 1_000_000);
        $number   = $number % 1_000_000;
        if ($millions > 0) {
            $parts[] = self::scaleWords($millions, 'مليون', 'مليونان', 'ملايين', 'مليون');
        }

        // Thousands
        $thousands = intdiv($number, 1_000);
        $number    = $number % 1_000;
        if ($thousands > 0) {
            $parts[] = self::scaleWords($thousands, 'ألف', 'ألفان', 'آلاف', 'ألف');
        }

        // Remainder (< 1000)
        if ($number > 0) {
            $parts[] = self::threeDigitWords($number);
        }

        return implode(' و', $parts);
    }

    private static function scaleWords(
        int $count,
        string $singular,
        string $dual,
        string $plural,
        string $singularAfter
    ): string {
        if ($count === 1) return $singular;
        if ($count === 2) return $dual;
        if ($count >= 3 && $count <= 10) {
            return self::threeDigitWords($count) . ' ' . $plural;
        }
        return self::threeDigitWords($count) . ' ' . $singularAfter;
    }

    private static function threeDigitWords(int $num): string
    {
        $parts = [];

        $h   = intdiv($num, 100);
        $rem = $num % 100;

        if ($h > 0) {
            $parts[] = self::$hundreds[$h];
        }

        if ($rem > 0) {
            if ($rem < 20) {
                $parts[] = self::$ones[$rem];
            } else {
                $unit = $rem % 10;
                $ten  = intdiv($rem, 10);
                if ($unit > 0) {
                    $parts[] = self::$ones[$unit] . ' و' . self::$tens[$ten];
                } else {
                    $parts[] = self::$tens[$ten];
                }
            }
        }

        return implode(' و', $parts);
    }
}
