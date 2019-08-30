<?php
declare(strict_types=1);

namespace App\StaticData\Presenter;

use App\Model\Entity\PostalAddressInterface;
use App\Model\View\PostalAddressView;
use App\Presenter\PostalAddressPresenterInterface;
use App\StaticData\Entity\MartaHome;
use App\StaticData\Entity\MaxBusiness;
use App\StaticData\Entity\MaxHome;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class StaticPostalAddressPresenter implements PostalAddressPresenterInterface
{
    /**
     * @var PostalAddressInterface[]
     */
    private $postalAddresses;

    public function __construct()
    {
        $this->postalAddresses = [
            new MaxHome(),
            new MaxBusiness(),
            new MartaHome()
        ];
    }

    /**
     * @param string $id
     * @return PostalAddressInterface|null
     */
    public function showPostalAddressById(string $id): ?PostalAddressInterface
    {
        foreach ($this->postalAddresses as $postalAddress) {
            if ($id === $postalAddress->getId()) {
                return $postalAddress;
            }
        }

        return null;
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return PostalAddressView
     */
    public function createView(?int $offset = null, ?int $limit = null): PostalAddressView
    {
        return new PostalAddressView(
            array_slice($this->postalAddresses, $offset ?? 0, $limit ?? count($this->postalAddresses)),
            $offset ?? 0,
            $limit ?? count($this->postalAddresses),
            count($this->postalAddresses)
        );
    }

    /**
     * @param string $personId
     * @param int|null $offset
     * @param int|null $limit
     * @return PostalAddressView
     */
    public function createViewByPersonId(string $personId, ?int $offset = null, ?int $limit = null): PostalAddressView
    {
        $postalAddresses = [];
        foreach ($this->postalAddresses as $postalAddress) {
            if ($postalAddress->getConnectedPersonId() === $personId) {
                $postalAddresses[] = $postalAddress;
            }
        }

        return new PostalAddressView(
            array_slice($postalAddresses, $offset ?? 0, $limit ?? count($postalAddresses)),
            $offset ?? 0,
            $limit ?? count($postalAddresses),
            count($postalAddresses)
        );
    }
}
