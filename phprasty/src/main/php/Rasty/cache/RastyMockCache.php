<?php
namespace Rasty\cache;

/**
 * Implementación mock de caché .
 * 
 * @author bernardo
 * @since 04-09-2015
 */
class RastyMockCache implements IRastyCache{
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::fetch()
	 */
    public function fetch($id)
    {
        return $id;
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::contains()
     */
    public function contains($id)
    {
        return false;
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::save()
     */
    public function save($id, $data, $lifeTime = 0)
    {
        return true;
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::delete()
     */
    public function delete($id)
    {
        return true;
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::getStats()
     */
    public function getStats()
    {
    	return array();
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::flushAll()
     */
    public function flushAll()
    {
        return true;
    }

    /**
     * (non-PHPdoc)
     * @see src/main/php/Rasty/cache/Rasty\cache.IRastyCache::deleteAll()
     */
    public function deleteAll()
    {
        return true;
    }

}