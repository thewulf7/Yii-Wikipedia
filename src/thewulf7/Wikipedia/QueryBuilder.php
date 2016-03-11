<?php

namespace thewulf7\Wikipedia;

/**
 * Class QueryBuilder
 *
 * @package thewulf7\Wikipedia
 */
class QueryBuilder extends \yii\base\Object
{

    /**
     * @var Connection
     */
    public $db;

    /**
     * QueryBuilder constructor.
     *
     * @param Connection $connection
     * @param array      $config
     */
    public function __construct(Connection $connection, $config = [])
    {
        $this->db = $connection;
        parent::__construct($config);
    }

    /**
     * Build the query
     *
     * @param Query $query
     *
     * @return array
     */
    public function build(Query $query)
    {
        return [
            'query' => [
                'exchars'     => $query->exchars,
                'exsentences' => $query->exsentences,
                'exlimit'     => $query->exlimit,
                'titles'      => $query->titles,
                'explaintext' => $query->explaintext,
                'format'      => $query->format,
                'action'      => $query->action,
                'prop'        => $query->prop,
            ],
        ];
    }
}
