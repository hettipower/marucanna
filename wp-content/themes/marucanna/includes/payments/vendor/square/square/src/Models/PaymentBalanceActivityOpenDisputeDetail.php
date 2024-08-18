<?php

/**
 * SimplePie Redis Cache Extension
 *
 * @package SimplePie
 * @author Jan Kozak <galvani78@gmail.com>
 * @link http://galvani.cz/
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version 0.2.9
 */


/**
 * Caches data to redis
 *
 * Registered for URLs with the "redis" protocol
 *
 * For example, `redis://localhost:6379/?timeout=3600&prefix=sp_&dbIndex=0` will
 * connect to redis on `localhost` on port 6379. All tables will be
 * prefixed with `simple_primary-` and data will expire after 3600 seconds
 *
 * @package SimplePie
 * @subpackage Caching
 * @uses Redis
 */
class SimplePie_Cache_Redis implements SimplePie_Cache_Base {
    /**
     * Redis instance
     *
     * @var \Redis
     */
    protected $cache;

    /**
     * Options
     *
     * @var array
     */
    protected $options;

    /**
     * Cache name
     *
     * @var string
     */
    protected $name;

    /**
     * Cache Data
     *
     * @var type
     */
    protected $data;

    /**
     * Create a new cache object
     *
     * @param string $location Location string (from SimplePie::$cache_location)
     * @param string $name Unique ID for the cache
     * @param string $type Either TYPE_FEED for SimplePie data, or TYPE_IMAGE for image data
     */
    public function __construct($location, $name, $options = null) {
        //$this->cache = \flow\simple\cache\Redis::getRedisClientInstance();
        $parsed = SimplePie_Cache::parse_URL($location);
        $redis = new Redis();
        $redis->connect($parsed['host'], $parsed['port']);
        if (isset($parsed['pass'])) {
            $redis->auth($parsed['pass']);
        }
        if (isset($parsed['path'])) {
            $redis->select((int)substr($parsed['path'], 1));
        }
        $this->cache = $redis;

        if (!is_null($options) && is_array($options)) {
            $this->options = $options;
        } else {
            $this->options = array (
          