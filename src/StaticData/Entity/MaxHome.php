<?php
declare(strict_types=1);

namespace App\StaticData\Entity;

use App\Model\Entity\PostalAddressInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class MaxHome implements PostalAddressInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return '4bafddd1-b371-4624-b5b6-08031c86a682';
    }

    /**
     * @return string
     */
    public function getConnectedPersonId(): string
    {
        return '6234be1e-59e1-4b8a-a447-d6373584f91c';
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
