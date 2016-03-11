<?php
namespace thewulf7\Wikipedia;


use yii\base\Component;

/**
 * Class Command
 *
 * @package thewulf7\Wikipedia
 */
class Command extends Component
{
    /**
     * @var Connection
     */
    public $db;

    /**
     * @var array
     */
    public $query = [];

    /**
     * @param string $term
     *
     * @return null
     */
    public function search($term)
    {
        $this->query = $this->db->getQueryBuilder()->build(new Query(array_merge(['titles' => $term], $this->query)));

        return $this;
    }

    /**
     * @param $sentences
     *
     * @return bool|null
     */
    public function getSentences($sentences)
    {
        if (!$this->query)
        {
            return false;
        }

        $query = $this->db->getQueryBuilder()->build(new Query(array_merge(['exsentences' => $sentences], $this->query)));

        return $this->getResponseArray($this->db->get($query));
    }

    /**
     * @param $chars
     *
     * @return bool|null
     */
    public function getChars($chars)
    {
        if (!$this->query)
        {
            return false;
        }

        $query = $this->db->getQueryBuilder()->build(new Query(array_merge(['exchars' => $chars], $this->query)));

        return $this->getResponseArray($this->db->get($query));
    }

    /**
     * @param $serializedResponse
     *
     * @return null
     */
    protected function getResponseArray($serializedResponse)
    {
        $response = unserialize($serializedResponse);

        $page = reset($response['query']['pages']);

        if (!isset($page['extract']))
        {
            return null;
        }

        return $page['extract'];
    }
}