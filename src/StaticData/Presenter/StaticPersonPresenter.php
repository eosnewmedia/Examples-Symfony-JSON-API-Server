<?php
declare(strict_types=1);

namespace App\StaticData\Presenter;

use App\Model\Entity\PersonInterface;
use App\Model\View\PersonView;
use App\Presenter\PersonPresenterInterface;
use App\StaticData\Entity\Marta;
use App\StaticData\Entity\Max;
use RuntimeException;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class StaticPersonPresenter implements PersonPresenterInterface
{
    /**
     * @var PersonInterface[]
     */
    private $persons;

    public function __construct()
    {
        $this->persons = [
            new Max(),
            new Marta()
        ];
    }

    /**
     * @param string $id
     * @return PersonInterface|null
     */
    public function showPersonById(string $id): ?PersonInterface
    {
        foreach ($this->persons as $person) {
            if ($id === $person->getId()) {
                return $person;
            }
        }

        return null;
    }

    /**
     * @param string $postalAddressId
     * @return PersonInterface
     * @throws RuntimeException
     */
    public function showPersonByPostalAddressId(string $postalAddressId): PersonInterface
    {
        foreach ($this->persons as $person) {
            if (in_array($postalAddressId, $person->getConnectedPostalAddressIds(), true)) {
                return $person;
            }
        }

        throw new RuntimeException('Not available');
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @return PersonView
     */
    public function createView(?int $offset = null, ?int $limit = null): PersonView
    {
        return new PersonView(
            array_slice($this->persons, $offset ?? 0, $limit ?? count($this->persons)),
            $offset ?? 0,
            $limit ?? count($this->persons),
            count($this->persons)
        );
    }
}
