<?php
declare(strict_types=1);

namespace App\StaticData\Entity;

use App\Model\Entity\PersonInterface;
use DateTimeInterface;
use DateTimeImmutable;
use Throwable;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class Marta implements PersonInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return '5647ac2f-e2d5-42a5-973d-5788873bfe6a';
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return 'Marta';
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return 'Mustermann';
    }

    /**
     * @return DateTimeInterface
     * @throws Throwable
     */
    public function getBirthday(): DateTimeInterface
    {
        return new DateTimeImmutable('1992-04-15');
    }

    /**
     * @return string[]
     */
    public function getConnectedPostalAddressIds(): array
    {
        return [
            '5996a40b-7b5f-4876-89e5-586396f29ab3'
        ];
    }
}
