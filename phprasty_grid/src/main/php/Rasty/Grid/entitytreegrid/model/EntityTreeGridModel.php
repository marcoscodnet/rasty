<?php
namespace Rasty\Grid\entitytreegrid\model;

use Rasty\Grid\entitygrid\model\EntityGridModel;

use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\conf\RastyConfig;
use Rasty\i18n\Locale;

use Rasty\utils\Logger;

/**
 * Modelo para la grilla tipo tree
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 03-09-2015
 *
 */
abstract class EntityTreeGridModel extends EntityGridModel{

	public function getTree(){
	
		Logger::log("GET TREE");
		$tree = $this->buildNode();
		Logger::logObject($tree);
		
		return $tree;
	}
	
	public function buildNode($level=0, $entity=null){

		$node =  array();
		
		if($entity){
			$node[] =  array( $level, $entity);
		}
		
		
		$children = $this->getChildren( $entity );

		$level++;
		Logger::log("Level $level");
		foreach ($children as $child) {

			
			Logger::log("Child $child");
			$childnode = $this->buildNode($level, $child);
			
			$node = array_merge($node, $childnode);
			//$node[] =  $childnode;
			
		}
		
		return $node;
	}
	
		
	/**
	 * se obtienen todos los hijos de la entity.
	 * si entity es null entonces retornará todos los roots del tree
	 * 
	 * @param $entity
	 */
	public abstract function getChildren($entity=null);
	
}