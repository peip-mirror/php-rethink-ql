<?php

namespace TBolier\RethinkQL\Query\Logic;

use TBolier\RethinkQL\Message\MessageInterface;
use TBolier\RethinkQL\Query\Operation\AbstractOperation;
use TBolier\RethinkQL\Query\QueryInterface;
use TBolier\RethinkQL\RethinkInterface;
use TBolier\RethinkQL\Types\Term\TermType;

class NotEqualLogic extends AbstractOperation
{
    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param RethinkInterface $rethink
     * @param MessageInterface $message
     * @param QueryInterface $query
     * @param mixed $value
     */
    public function __construct(
        RethinkInterface $rethink,
        MessageInterface $message,
        QueryInterface $query,
        $value
    ) {
        parent::__construct($rethink, $message);

        $this->value = $value;
        $this->rethink = $rethink;
        $this->message = $message;
        $this->query = $query;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return
            [
                TermType::NE,
                [
                    $this->query->toArray(),
                    $this->value,
                ],
            ];
    }
}