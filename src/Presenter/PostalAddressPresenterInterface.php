<?php
declare(strict_types=1);

namespace App\Presenter;

use App\Model\Entity\PostalAddressInterface;
use App\Model\View\PostalAddressView;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface PostalAddressPresenterInterface
{
    /**
     * @param string $id
     * @return PostalAddressInterface|null
     */
    public function showPostalAddressById(string $id): ?PostalAddressInterface;

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return PostalAddressView
     */
    public function createView(?int $offset = null, ?int $limit = null): PostalAddressView;

    /**
     * @param string $personId
     * @param int|null $offset
     * @param int|null $limit
     * @return PostalAddressView
     */
    public function createViewByPersonId(string $personId, ?int $offset = null, ?int $limit = null): PostalAddressView;
}
