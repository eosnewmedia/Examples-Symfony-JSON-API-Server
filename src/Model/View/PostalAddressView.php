<?php
declare(strict_types=1);

namespace App\Model\View;

use App\Model\Entity\PostalAddressInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class PostalAddressView extends AbstractView
{
    /**
     * @var PostalAddressInterface[]
     */
    private $postalAddresses;

    /**
     * @param PostalAddressInterface[] $postalAddresses
     * @param int $offset
     * @param int $limit
     * @param int $total
     */
    public function __construct(array $postalAddresses, int $offset, int $limit, int $total)
    {
        parent::__construct($offset, $limit, $total);
        $this->postalAddresses = $postalAddresses;
    }

    /**
     * @return PostalAddressInterface[]
     */
    public function getPostalAddresses(): array
    {
        return $this->postalAddresses;
    }
}
