<?php
declare(strict_types=1);

namespace App\StaticData\Entity;

use App\Model\Entity\PostalAddressInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class MartaHome implements PostalAddressInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return '5996a40b-7b5f-4876-89e5-586396f29ab3';
    }

    /**
     * @return string
     */
    public function getConnectedPersonId(): string
    {
        return '5647ac2f-e2d5-42a5-973d-5788873bfe6a';
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return 'Musterstraße 1';
    }

    /**
     * @return array|null
     */
    public function getAddressAdditional(): ?array
    {
        return [
            '1. OG'
        ];
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return '20457';
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return 'Hamburg';
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return 'Germany';
    }
}
