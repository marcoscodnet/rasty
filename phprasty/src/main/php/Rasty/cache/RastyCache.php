<?php
namespace Rasty\cache;
use Rasty\utils\ReflectionUtils;

use Rasty\conf\RastyConfig;

use Rasty\cache\RastyApcCache;

/**
 * Caché para rasty.
 * 
 * @author bernardo
 * @since 27-11-2013
 */
class RastyCache{
	
	private static $instance;
	/**
	 * implementación de cache doctrine
	 * @var IRastyCache
	 */
	private $cache;
	
	private $cacheId;
	
	private function __construct(){
		
		//TODO podríamos tener una variable de configuración
		//para determinar el tipo de caché a utilizar.
		
		//$this->cache = new RastyApcCache();
		$this->cache = ReflectionUtils::newInstance( RastyConfig::getInstance()->getCacheType() );
		$this->cacheId = RastyConfig::getInstance()->getCacheId();
	}
	
	public static function getInstance(){
		if (  !self::$instance instanceof self ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	
	private function enhanceId( $id ){
		return $this->getCacheId() . $id;
	}
	
    /**
     * {@inheritdoc}
     */
    public function fetch($id)
    {
        return $this->cache->fetch( $this->enhanceId($id) );
    }

    /**
     * {@inheritdoc}
     */
    public function contains($id)
    {
        return $this->cache->contains($this->enhanceId($id));
    }

    /**
     * {@inheritdoc}
     */
    public function save($id, $data, $lifeTime = 0)
    {
        return $this->cache->save($this->enhanceId($id), $data, $lifeTime);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        return $this->cache->delete($this->enhanceId($id));
    }

    /**
     * {@inheritdoc}
     */
    public function getStats()
    {
        return $this->cache->getStats();
    }

    /**
     * Flushes all cache entries.
     *
     * @return boolean TRUE if the cache entries were successfully flushed, FALSE otherwise.
     */
    public function flushAll()
    {
        return $this->cache->flushAll();
    }

    /**
     * Deletes all cache entries.
     *
     * @return boolean TRUE if the cache entries were successfully deleted, FALSE otherwise.
     */
    public function deleteAll()
    {
        return $this->cache->deleteAll();
    }


	public function getCacheId()
	{
	    return $this->cacheId;
	}

	public function setCacheId($cacheId)
	{
	    $this->cacheId = $cacheId;
	}
}