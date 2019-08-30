<?php
declare(strict_types=1);

namespace App\StaticData\Entity;

use App\Model\Entity\PostalAddressInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class MaxBusiness implements PostalAddressInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return '9e6908be-fe06-4db1-bdcc-b89dd823b7ae';
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
        return 'Musterstraße 10';
    }

    /**
     * @return array|null
     */
    public function getAddressAdditional(): ?array
    {
        return null;
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
