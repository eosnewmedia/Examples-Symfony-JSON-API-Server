<?php
declare(strict_types=1);

namespace App\Presenter;

use App\Model\Entity\PersonInterface;
use App\Model\View\PersonView;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface PersonPresenterInterface
{
    /**
     * @param string $id
     * @return PersonInterface|null
     */
    public function showPersonById(string $id): ?PersonInterface;

    /**
     * @param string $postalAddressId
     * @return PersonInterface
     */
    public function showPersonByPostalAddressId(string $postalAddressId): PersonInterface;

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return PersonView
     */
    public function createView(?int $offset = null, ?int $limit = null): PersonView;
}
