<?php
declare(strict_types=1);

namespace App\Model\View;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
abstract class AbstractView
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $total;

    /**
     * @param int $offset
     * @param int $limit
     * @param int $total
     */
    public function __construct(int $offset, int $limit, int $total)
    {
        $this->offset = $offset;
        $this->limit = $limit;
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
