<?php
declare(strict_types=1);

namespace App\Model\View;

use App\Model\Entity\PersonInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class PersonView extends AbstractView
{
    /**
     * @var PersonInterface[]
     */
    private $persons;

    /**
     * @param PersonInterface[] $persons
     * @param int $offset
     * @param int $limit
     * @param int $total
     */
    public function __construct(array $persons, int $offset, int $limit, int $total)
    {
        parent::__construct($offset, $limit, $total);
        $this->persons = $persons;
    }

    /**
     * @return PersonInterface[]
     */
    public function getPersons(): array
    {
        return $this->persons;
    }
}
