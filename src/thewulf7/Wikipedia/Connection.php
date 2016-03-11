<?php
/**
 * Yii-Wikipedia.Connection.php
 * User: johnnyutkin
 * Date: 11.03.16
 * Time: 23:09
 */

namespace thewulf7\Wikipedia;

use yii\base\Component;

/**
 * Class Connection
 *
 * @package thewulf7\Wikipedia
 */
class Connection extends Component
{
    /**
     * @var string
     */
    protected $url = "http://en.wikipedia.org/w/api.php";

    /**
     *
     */
    public function init()
    {

    }

    /**
     * @param array $config
     *
     * @return Command
     */
    public function createCommand($config = [])
    {
        $config['db'] = $this;

        return new Command($config);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return new QueryBuilder($this);
    }

    /**
     * @param array $options
     *
     * @return string
     */
    public function get($options = [])
    {
        return file_get_contents($this->url . '?' . $this->createUrl($options));
    }

    /**
     * @param $options
     *
     * @return string
     */
    protected function createUrl($options)
    {
        return http_build_query($options);
    }
}