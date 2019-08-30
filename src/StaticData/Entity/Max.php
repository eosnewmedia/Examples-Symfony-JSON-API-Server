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
class Max implements PersonInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return '6234be1e-59e1-4b8a-a447-d6373584f91c';
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return 'Max';
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
        return new DateTimeImmutable('1990-08-01');
    }

    /**
     * @return string[]
     */
    public function getConnectedPostalAddressIds(): array
    {
        return [
            '4bafddd1-b371-4624-b5b6-08031c86a682',
            '9e6908be-fe06-4db1-bdcc-b89dd823b7ae'
        ];
    }
}
