<?php

namespace Rasty\Forms\form;


use Rasty\Forms\finder\model\ICodeFinder;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\utils\Logger;
use Rasty\Forms\form\DefaultPropertyFormatter;
/**
 * Formulario

 * @author bernardo
 * @since 08/08/2013
 */
abstract class Form extends RastyComponent{
		
	/**
	 * legend para el fieldset.
	 * @var string
	 */
	private $legend;
	
	/**
	 * action del form
	 * @var string
	 */
	private $action;

	/**
	 * method del form
	 * @var string
	 */
	private $method;
	
	/**
	 * label para el submit
	 * @var string
	 */
	private $labelSubmit;

	/**
	 * properties para la entity
	 * @var unknown_type
	 */
	private $properties;

	
	/**
	 * para el mensaje de error
	 * @var string
	 */
	private $error;

	/**
	 * nombre de la página a consultar en el cancel
	 * 
	 * @var string
	 */
	private $backToOnCancel;
	
	/**
	 * nombre de la página a consultar en el success
	 * 
	 * @var unknown_type
	 */
	private $backToOnSuccess;

	/**
	 * determina si el formulario es editable.
	 * @var unknown_type
	 */
	private $isEditable;
	
	/**
	 * javascript a invocar al cancelar
	 * @var unknown_type
	 */
	private $onClickCancel;
	
	/**
	 * javascript a invocar onsuccess
	 * @var unknown_type
	 */
	private $onSuccessCallback;

	/**
	 * texto inicial para la carga de la entity
	 * (lo usamos en los autocomplete cuando la entity buscado
	 * no existe y abrimos un popup con el texto por el cuál se buscó
	 * en el autocomplete)
	 * Cada formulario deberá inicializar el input correspondiente.
	 * @var unknown_type
	 */
	protected $initialText;

	/**
	 * id del div donde se renderiza el formulario si
	 * se abre con un popup 
	 * @var string
	 */
	protected $popupDivId;
	
	/**
	 * incluidos "formateadores" especiales. Esto serviría
	 * por ejemplo para cuando se incluye un combo de opciones donde
	 * se popula el oid de la entity. El formateador lo que hará
	 * es darnos la entity dado el oid. 
	 * La idea es tenerlo para properties específicas por lo que será un array 
	 * donde array["property"] = $formatter
	 * 
	 * @var array[ICodeFinder]
	 */
	protected $specialFormatters;
	
	public function __construct(){
		
		$this->setLabelSubmit("form.aceptar");
		$this->properties = array();
		$this->specialFormatters = array();
		$this->method = "POST";
		$this->isEditable = true;
		
	}

	public function addProperty($property, $entityKey="default", ICodeFinder $formatter=null){
		
		if( empty($formatter)){
			$formatter = new DefaultPropertyFormatter();
		}
		$this->specialFormatters[$property] = $formatter;
		//si entity es null es para la entity default
		

		if(!array_key_exists($entityKey, $this->properties))
			$this->properties[$entityKey] = array();
			
		$this->properties[$entityKey][] = $property;
		
	}
	
	
	protected function formatValueProperty($property, $value, $defaultFormatter){
	
		//$formatter =  new DefaultPropertyFormatter();
		$formatter =  $defaultFormatter;
		
		if(array_key_exists($property, $this->specialFormatters)){
			$formatter =  $this->specialFormatters[$property];
		}
		return $formatter->findEntityByCode($value);
		
	}
	public function fillEntity( $entity ){
		
		if(!array_key_exists("default", $this->properties))
			$this->properties["default"] = array();
			
		foreach ($this->properties["default"] as $property) {
			
			$this->fillEntityProperty( $entity, $property );
			
		}
		
		//chequeamos el back to on success 
		
	}

	public function fillForm( $entity ){
		
		if(!array_key_exists("default", $this->properties))
			$this->properties["default"] = array();
			
		foreach ($this->properties["default"] as $property) {
			
			//Logger::log("fill form $property");
			
			$this->fillFormEntityProperty( $entity, $property );
			
		}
		
		//chequeamos el back to on success 
		
	}
	
	public function fillRelatedEntity($entityKey, $entity ){
		
		
		foreach ($this->properties[ $entityKey ] as $property) {
			
			$this->fillEntityProperty( $entity, $property );
			
		}
		
	}
	
	public function fillEntityProperty( $entity, $property ){
		$input = $this->getComponentById($property);
		//Logger::logObject($property);
		$formatterClazz = $input->getFormatterClazz();
		if(empty($formatterClazz))
			$formatterClazz = get_class(new DefaultPropertyFormatter());
		$defaultFormatter = ReflectionUtils::newInstance($formatterClazz); 
		$value = $input->getPopulatedValue( $this->getMethod() );			
		$value = $this->formatValueProperty($property, $value, $defaultFormatter);
		ReflectionUtils::doSetter( $entity, $property, $value );
	}
	
	public function fillFormEntityProperty( $entity, $property ){
		
		$this->fillInput($property, ReflectionUtils::doGetter( $entity, $property ));
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend", $this->getLegend() );
		$xtpl->assign("action", $this->getAction() );
		$xtpl->assign("method", $this->getMethod() );
		$xtpl->assign("lbl_submit", $this->localize( $this->getLabelSubmit() ) );
		
		$msg = $this->getError();
		
		if( !empty($msg) ){
			
			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}
		
		
		$xtpl->assign("onClickCancel", $this->getOnClickCancel());
		$xtpl->assign("onSuccessCallback", $this->getOnSuccessCallback());
		
		
		$this->cleanSavedProperties();	
	}

	public function getLegend()
	{
	    return $this->legend;
	}

	public function setLegend($legend)
	{
	    $this->legend = $legend;
	}

	public function getAction()
	{
	    return $this->action;
	}

	public function setAction($action)
	{
	    $this->action = $action;
	}

	public function getLabelSubmit()
	{
	    return $this->labelSubmit;
	}

	public function setLabelSubmit($labelSubmit)
	{
	    $this->labelSubmit = $labelSubmit;
	}


	public function getMethod()
	{
	    return $this->method;
	}

	public function setMethod($method)
	{
	    $this->method = $method;
	}

	public function getProperties()
	{
	    return $this->properties;
	}

	public function setProperties($properties)
	{
	    $this->properties = $properties;
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}

	public function getBackToOnCancel()
	{
		$value = "";
		$method = $this->getMethod();
		if( strtoupper($method)=="POST" ){
			$value = RastyUtils::getParamPOST( "backToOnCancel" );
		}else{
			$value = RastyUtils::getParamGET( "backToOnCancel" );
		}
		
		if(empty($value))
			$value = $this->backToOnCancel;
		
	    return $value;
		
	}

	public function setBackToOnCancel($backToOnCancel)
	{
		if(!empty($backToOnCancel) )
	    	$this->backToOnCancel = $backToOnCancel;
	}

	public function getBackToOnSuccess()
	{

		$value = "";
		$method = $this->getMethod();
		if( strtoupper($method)=="POST" ){
			$value = RastyUtils::getParamPOST( "backToOnSuccess" );
		}else{
			$value = RastyUtils::getParamGET( "backToOnSuccess" );
		}
		
		if(empty($value))
			$value = $this->backToOnSuccess;
		
	    return $value;
	}

	public function setBackToOnSuccess($backToOnSuccess)
	{
		if(!empty($backToOnSuccess) )
	    	$this->backToOnSuccess = $backToOnSuccess;
	}
	
	/**
	 * llena el form con los valores guardados en sesión.
	 */
	public function fillFromSaved($entity=null){
	
		Logger::log("fillFromSaved");
		
		if(!array_key_exists("default", $this->properties))
			$this->properties["default"] = array();
		
		foreach ($this->properties["default"] as $property) {
			
			$value = $this->getSavedProperty($property);

			
			if(!empty($value) && $value!=null){
				
				$input = $this->getComponentById($property);
				$value = $input->formatValue($value);
				$input->setValue($value);	
				
				if(!empty($entity))
					ReflectionUtils::doSetter( $entity, $property, $value );
			}
			
		}
	}
	
	/**
	 * llena el form con los valores guardados en sesión.
	 */
	public function fillRelatedFromSaved($entityKey, $entity=null){
	
		foreach ($this->properties[$entityKey] as $property) {
			
			$value = $this->getSavedProperty($property, $entityKey);

			
			if(!empty($value )){
				
				$input = $this->getComponentById($property);
				$value = $input->formatValue($value);
				$input->setValue($value);	
				
				if(!empty($entity))
					ReflectionUtils::doSetter( $entity, $property, $value );
			}
			
		}
	}
	
	/**
	 * setea un valor para un input del formulario
	 */
	public function fillInput($property, $value ){
		//Logger::log("fill input $property $value");
				
		if(!empty($value)){
		//if($value){	

			$input = $this->getComponentById($property);
			if($input!=null){
				//$value = $input->formatValue($value);
				$input->setValue($value);	
			}
			
			

		}
				
	}
	
	/**
	 * setea en sesión los valores del form.
	 */
	public function save(){
		
		//primero limpiamos la búsqueda anterior.
		$this->cleanSavedProperties();
		
		//Logger::log("begin save");
		
		if(!array_key_exists("default", $this->properties))
			$this->properties["default"] = array();
		
		foreach ($this->properties["default"] as $property) {

			$input = $this->getComponentById($property);
			
			$value = $input->getPopulatedValue( $this->getMethod() );
			$value = $input->unformatValue($value);

			if( !empty($value) ){
					
				$this->saveProperty($property, $value);
					
			}
		}
	
		foreach ($this->properties as $key => $values) {

			if( $key!="default"){
				
				foreach ($values as $property) {
				
							$input = $this->getComponentById($property);
							
							$value = $input->getPopulatedValue( $this->getMethod() );
							$value = $input->unformatValue($value);
				
							if( !empty($value) ){
									
								$this->saveProperty($property, $value, $key);
									
							}
						}
								
			}
			
		}
		
	}
	public function saveProperty($name, $value, $entity=null){
		
		$nametosave = str_replace('.', '_', $name);
		
		if($entity!=null)
			$nametosave .= str_replace('.', '_', $entity);
			
		$_SESSION[get_class($this)][$nametosave] = $value;
		
		//Logger::log("savedProperty($name): $nametosave => $value to " . get_class($this));
		
	}
	
	public function getSavedProperty($name, $entity=null){
		
		$nametosave = str_replace('.', '_', $name);
		if($entity!=null)
			$nametosave .= str_replace('.', '_', $entity);
		
		$value = (isset($_SESSION[ get_class($this) ][$nametosave] ))?$_SESSION[get_class($this)][$nametosave] :null;
		
		//Logger::log("getSavedProperty($name): $nametosave => $value from " . get_class($this));
		
		return $value;
		
	}
	
	public function cleanSavedProperties(){
		//Logger::log("cleanSavedProperties from " . get_class($this));
		
		unset( $_SESSION[ get_class($this) ] );
	}
	

	public function getOnClickCancel()
	{
	    return $this->onClickCancel;
	}

	public function setOnClickCancel($onClickCancel)
	{
	    $this->onClickCancel = $onClickCancel;
	}

	public function getOnSuccessCallback()
	{
	    return $this->onSuccessCallback;
	}

	public function setOnSuccessCallback($onSuccessCallback)
	{
	    $this->onSuccessCallback = $onSuccessCallback;
	}

	public function getIsEditable()
	{
	    return $this->isEditable;
	}

	public function setIsEditable($isEditable)
	{
	    $this->isEditable = $isEditable;
	}

	public function getInitialText()
	{
	    return $this->initialText;
	}

	public function setInitialText($initialText)
	{
	    $this->initialText = $initialText;
	}

	public function getPopupDivId()
	{
	    return $this->popupDivId;
	}

	public function setPopupDivId($popupDivId)
	{
	    $this->popupDivId = $popupDivId;
	}
}
?>