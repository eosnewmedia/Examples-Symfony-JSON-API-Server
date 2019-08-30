<?php
declare(strict_types=1);

namespace App\Model\Entity;

use DateTimeInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface PersonInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return DateTimeInterface
     */
    public function getBirthday(): DateTimeInterface;

    /**
     * @return string[]
     */
    public function getConnectedPostalAddressIds(): array;
}
