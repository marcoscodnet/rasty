<?php
namespace Rasty\Forms\addpopup;

use Rasty\Forms\finder\model\IAutocompleteFinder;

use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;
use Rasty\utils\ReflectionUtils;
use Rasty\exception\RastyException;

use Rasty\components\RastyComponent;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;
/**
 * se consultan entities para seleccionar una de ellas
 * 
 * @author bernardo
 * @since 18/08/2013
 */
class AddPopup extends RastyComponent{

	/**
	 * javascript a invocar onsuccess
	 * @var string
	 */
	private $onSuccessCallback;
	
	/**
	 * tipo del formulario para instanciarlo
	 * @var string
	 */
	protected $formType;

	/**
	 * texto inicial para la carga de la entity.
	 * @var string
	 */
	protected $initialText;
	
	
	protected $form;

	/**
	 * id del div donde se renderiza el popup
	 * @var string
	 */
	protected $popupDivId;

	
	protected $formActionURL;
	
	public function getType(){
		
		return "AddPopup";
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		//$xtpl->assign("legend_resultados", $this->localize("filter.resultados") );
		$xtpl->assign("id", $this->getId());
	}
	

	public function getFormType()
	{
	    return $this->formType;
	}

	public function setFormType($formType)
	{
	    $this->formType = $formType;
	    
	    //generamos el form a partir del type.
	    $componentConfig = new ComponentConfig();
	    $componentConfig->setId( "form" );
		$componentConfig->setType( $formType );
		//echo $this->getOnSuccessCallback();
		//esto setearlo en el .rasty
	    $this->form = ComponentFactory::buildByType($componentConfig, $this);
	    $this->form->setMethod( "POST" );
	    $this->form->setAction( $this->getFormAction() );
	    $this->form->setOnSuccessCallback( $this->getOnSuccessCallback() );
	    $this->form->setInitialText( $this->getInitialText() );
	    
	    $id = $this->getId();
	    
	    //echo $this->form->getOnSuccessCallback();
	    
	}

	public function getForm()
	{
	    return $this->form;
	}

	public function setForm($form)
	{
	    $this->form = $form;
	}


	public function getOnSuccessCallback()
	{
	    return $this->onSuccessCallback;
	}

	public function setOnSuccessCallback($onSuccessCallback)
	{
	    $this->onSuccessCallback = $onSuccessCallback;
	}

	public function getInitialText()
	{
	    return $this->initialText;
	}

	public function setInitialText($initialText)
	{
		
	    $this->initialText = $initialText;
	    
	    if( $this->form != null )
	    	$this->form->setInitialText( $initialText );
	}

	public function getPopupDivId()
	{
	    return $this->popupDivId;
	}

	public function setPopupDivId($popupDivId)
	{
	    $this->popupDivId = $popupDivId;
	}

	

	public function getFormAction()
	{
	    return $this->formAction;
	}

	public function setFormAction($formAction)
	{
	    $this->formAction = $formAction;
	}
}
?>