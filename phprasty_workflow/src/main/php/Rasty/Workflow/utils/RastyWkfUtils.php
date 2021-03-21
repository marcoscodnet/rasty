<?php
namespace Rasty\Workflow\utils;


use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\i18n\Locale;
use Rasty\conf\RastyConfig;

use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\factory\PageFactory;

use Cose\Workflow\model\EstadoTarea;
use Cose\Workflow\model\PrioridadTarea;


/**
 * Utilidades para RastyWkf
 *
 * @author Bernardo
 * @since 02-09-2015
 */
class RastyWkfUtils {

	private static $dateFormat = 'd/m/Y';
	private static $dateTimeFormat = 'd/m/y H:i:s';
	private static $timeFormat = 'H:i';
	
	//números
	private static $decimales = '2';
	private static $separadorDecimal = ',';
	private static $separadorMiles = '.';

	//moneda.
	private static $monedaSimbolo = '$';
	private static $monedaISO = 'ARS';
	private static $monedaNombre = 'Pesos';
	private static $monedaPosicionIzq = 1;
	
	
	public static function getWebPath(){
	
		return RastyConfig::getInstance()->getWebPath();
		
	}
	
	public static function getAppPath(){
	
		return RastyConfig::getInstance()->getAppPath();
		
	}
	
	public static function localizeEntities($enumeratedEntities){
		
		$items = array();
		
		foreach ($enumeratedEntities as $key => $keyMessage) {
			$items[$key] = self::localize($keyMessage);
		}
		
		return $items;
	}
	
	public static function localize($keyMessage){
	
		return Locale::localize( $keyMessage );
	}
	
	
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}
	

    /**
     * @return true si hay un usuario logueado.
     */
    public static function isUserLogged() {
    	
    	$user = RastySecurityContext::getUser();
    	
    	$logueado =  ($user != null);
		
		return $logueado;
    }
    
    public static function getUserLogged(){
    
    	$user = RastySecurityContext::getUser();
			
		//$user = WalibaUtils::getUserByUsername($user->getUsername());
		return $user;
    }
    
	public static function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }

    public static function logObject($obj, $clazz=__CLASS__){
    	Logger::logObject($obj, $clazz);
    }
    
	
 	public static function is_empty($var, $allow_false = false, $allow_ws = false) {
	    if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {   
	        return true;
	    } else {
	        return false;
	    }
	}

	
	public static function addMenuOption(MenuOption $menuOption, $options){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$options[] = $menuOption ;
		}
		
		return $options;
			
	}
	
	public static function addMenuOptionToGroup(MenuOption $menuOption, $menuGroup){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$menuGroup->addMenuOption( $menuOption );
		}
			
	}
	
	/**
	 * chequea si el usuario logueado tiene acceso a una página
	 * @param string $pageName
	 */
	public static function tienePermisoAPagina($pageName){

		//si tiene permisos agrego el menú.
		$page = PageFactory::build( $pageName );
		
		try {

			RastySecurityContext::authorize($page);
			return true;				
			
		} catch (UserRequiredException $e) {
			
		} catch (UserPermissionException $e) {
			
		}
		
		return false;
			
	}
	

	public static function startsWith($haystack, $needle) {
	    // search backwards starting from haystack length characters from the end
	    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	public static function endsWith($haystack, $needle) {
	    // search forward starting from end minus needle length characters
	    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}	

	

	public static function getDateFormat()
	{
	    return self::$dateFormat;
	}

	public static function setDateFormat($dateFormat)
	{
	    self::$dateFormat = $dateFormat;
	}

	public static function getDateTimeFormat()
	{
	    return self::$dateTimeFormat;
	}

	public static function setDateTimeFormat($dateTimeFormat)
	{
	    self::$dateTimeFormat = $dateTimeFormat;
	}

	public static function getTimeFormat()
	{
	    return self::$timeFormat;
	}

	public static function setTimeFormat($timeFormat)
	{
	    self::$timeFormat = $timeFormat;
	}

	public static function getDecimales()
	{
	    return self::$decimales;
	}

	public static function setDecimales($decimales)
	{
	    self::$decimales = $decimales;
	}

	public static function getSeparadorDecimal()
	{
	    return self::$separadorDecimal;
	}

	public static function setSeparadorDecimal($separadorDecimal)
	{
	    self::$separadorDecimal = $separadorDecimal;
	}

	public static function getSeparadorMiles()
	{
	    return self::$separadorMiles;
	}

	public static function setSeparadorMiles($separadorMiles)
	{
	    self::$separadorMiles = $separadorMiles;
	}

	public static function getMonedaSimbolo()
	{
	    return self::$monedaSimbolo;
	}

	public static function setMonedaSimbolo($monedaSimbolo)
	{
	    self::$monedaSimbolo = $monedaSimbolo;
	}

	public static function getMonedaISO()
	{
	    return self::$monedaISO;
	}

	public static function setMonedaISO($monedaISO)
	{
	    self::$monedaISO = $monedaISO;
	}

	public static function getMonedaNombre()
	{
	    return self::$monedaNombre;
	}

	public static function setMonedaNombre($monedaNombre)
	{
	    self::$monedaNombre = $monedaNombre;
	}

	public static function getMonedaPosicionIzq()
	{
	    return self::$monedaPosicionIzq;
	}

	public static function setMonedaPosicionIzq($monedaPosicionIzq)
	{
	    self::$monedaPosicionIzq = $monedaPosicionIzq;
	}
	
	
	public static function formatDateToView($value) {
		
		if(!empty($value))
			return $value->format(self::$dateFormat);
		else
			return "";
	}
	
	public static function formatDateTimeToView($value) {
		
		if(!empty($value))
			return $value->format(self::$dateTimeFormat);
		else
			return "";
	}
	
	public static function getEstadoTareaCss($estado){
		$estilos = array(
						EstadoTarea::Pendiente=> "bg-yellow fg-black",
						EstadoTarea::EnProceso=> "bg-green fg-black",
						EstadoTarea::Resuelta=> "bg-blue fg-black",
						EstadoTarea::Cancelada=> "bg-red fg-white"
						);
						
		return $estilos[$estado];
	}
	
	public static function getEstadoTareaLabel($estado){
		
		return self::localize( EstadoTarea::getLabel( $estado )  );
		
	}

	public static function getFirstDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	
		//si es lunes, no hacemos nada, sino, buscamos el lunes anterior.
		if( $f->format("N") > 1 )
			$f->modify("last monday");
    	
    	return $f;
	}
	
	
	public static function getLastDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	$f->modify("next monday");
    	
    	//si no es lunes, restamos un día.
    	if( $fecha->format("N") > 1 )
			$f->sub(new \DateInterval('P1D'));
    	
    	return $f;
	}

	
	public static function getPrioridadTareaCss($prioridad){
		$estilos = array(
						PrioridadTarea::Baja=> "",
						PrioridadTarea::Normal=> "",
						PrioridadTarea::Alta=> "bg-orange fg-black",
						PrioridadTarea::Urgente=> "bg-red fg-white"
						);

		if( array_key_exists($prioridad, $estilos))
			return $estilos[$prioridad];
	}
	
	public static function getPrioridadTareaLabel($prioridad){
		
		return self::localize( PrioridadTarea::getLabel( $prioridad )  );
		
	}

	
}