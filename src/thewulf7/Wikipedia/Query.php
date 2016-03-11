<?php
/**
 * Yii-Wikipedia.Query.php
 * User: johnnyutkin
 * Date: 11.03.16
 * Time: 23:42
 */

namespace thewulf7\Wikipedia;


use yii\base\Component;
use yii\db\QueryInterface;
use yii\db\QueryTrait;

/**
 * Class Query
 *
 * @package thewulf7\Wikipedia
 */
class Query extends Component implements QueryInterface
{
    use QueryTrait;

    /**
     * No less than 1
     * @var null
     */
    public $exchars = null;

    /**
     * Between 1 and 10
     * @var null
     */
    public $exsentences = null;

    /**
     * Max 20
     * @var int
     */
    public $exlimit = 1;

    /**
     * The page title to search
     * @var null
     */
    public $titles = null;

    /**
     * Return format as plain text instead of HTML
     * @var bool
     */
    public $explaintext = true;

    /**
     * // json|xml|php|wddx|yaml|jsonfm|txt|dbg|dump
     *
     * @var string
     */
    public $format = 'php';

    /**
     * @var string
     */
    protected $action = 'query';

    /**
     * @var string
     */
    protected $prop = 'extracts';

    /**
     * Allowed response formats
     *
     * @link https://www.mediawiki.org/wiki/API:Data_formats
     * @var array
     */
    protected $allowedFormats = ['json', 'xml', 'php', 'wddx', 'yaml', 'jsonfm', 'txt', 'dbg', 'dump'];

    /**
     * @param Connection|null $db
     *
     * @return Command
     * @throws \yii\base\InvalidConfigException
     */
    public function createCommand(Connection $db = null)
    {
        if ($db === null) {
            $db = \Yii::$app->get('wikipedia');
        }

        $commandConfig = $db->getQueryBuilder()->build($this);

        return $db->createCommand($commandConfig);
    }

    /**
     * @param $value
     *
     * @return $this|bool
     */
    public function exchars($value)
    {
        if ($value < 1)
        {
            return false;
        }

        $this->exchars = $value;
        $this->exsentences($value);
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function exsentences($value)
    {
        $this->exsentences = $value;
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this|bool
     */
    public function exlimit($value)
    {
        if ($value < 1 || $value > 20)
        {
            return false;
        }

        $this->exlimit = $value;
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function titles($value)
    {
        $this->titles = $value;
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function explaintext($value)
    {
        $this->explaintext = $value;
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this|bool
     */
    public function format($value)
    {
        if (!in_array($value, $this->allowedFormats, true))
        {
            return false;
        }

        $this->format = $value;
        return $this;
    }

    /**
     * @param null $db
     */
    public function all($db = null){}

    /**
     * @param null $db
     */
    public function one($db = null){}

    /**
     * @param string $q
     * @param null   $db
     */
    public function count($q = '*', $db = null){}

    /**
     * @param null $db
     */
    public function exists($db = null){}
}