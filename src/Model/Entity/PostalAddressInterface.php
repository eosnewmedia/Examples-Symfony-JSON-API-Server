<?php
declare(strict_types=1);

namespace App\Model\Entity;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface PostalAddressInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getConnectedPersonId(): string;

    /**
     * @return string
     */
    public function getStreet(): string;

    /**
     * @return array|null
     */
    public function getAddressAdditional(): ?array;

    /**
     * @return string
     */
    public function getPostalCode(): string;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @return string
     */
    public function getCountry(): string;
}
