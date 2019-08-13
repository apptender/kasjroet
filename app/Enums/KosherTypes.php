<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

final class KosherTypes extends Enum
{
    /** @var string  */
    const MILK = 'melkkost';
    /** @var string  */
    const CHALAV = 'chalav jisroel';
    /** @var string  */
    const MEAT = 'vleeskost';
    /** @var string  */
    const PARVE = 'parve';

    /** @var array  */
    private static $translations = [
        self::MILK => 'Melkkost',
        self::CHALAV => 'Chalav Jisroel',
        self::MEAT => 'Vleeskost',
        self::PARVE => 'Parve',
    ];

    /**
     * @param $value
     *
     * @return string
     * @throws \UnexpectedValueException
     */
    public static function getDutchTranslation($value): string
    {
        return (new static($value))->translateDutch();
    }

    /**
     * Method used to translate an enumeration key to a string in dutch
     *
     * @return string
     */
    public function translateDutch(): string
    {
        return self::$translations[$this->getValue()];
    }

}
