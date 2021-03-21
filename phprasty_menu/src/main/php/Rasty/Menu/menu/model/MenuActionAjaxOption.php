<?php

namespace Rasty\Menu\menu\model;

use Rasty\utils\LinkBuilder;

/**
 * menu option a un action.
 * 
 * @author bernardo
 * @since 15-08-2013
 *
 */
class MenuActionAjaxOption extends MenuActionOption{

	/**
	 * js callback on success de la acción.
	 * @var string
	 */
	private $onSuccessCallback;
	
	/**
	 * título para el diálogo de confirmación
	 * @var string
	 */
	private $confirmTitle;
	
	/**
	 * mensaje para confirmar la operación
	 * @var string
	 */
	private $confirmMessage;
	
	/**
	 * (non-PHPdoc)
	 * @see menu/model/Rasty\Menu\menu\model.MenuOption::getLink()
	 */
	public function getLink(){
		return LinkBuilder::getActionAjaxUrl($this->getActionName(), $this->getParams() );
	}

	public function getOnclick(){
		
		$success = $this->getOnSuccessCallback();

		if(empty($success))
			$success = 'false';
		
		$confirmMessage = $this->getConfirmMessage();
		$confirmTitle = $this->getConfirmTitle();
			
		if(!empty($confirmMessage)){
		
			return "doAjaxConfirmation('". $this->getLink() . "', $success, '$confirmMessage', '$confirmTitle');return false";
		}
		else
			return "doAjax('". $this->getLink() . "', $success);return false";
		
	}

	

	public function getOnSuccessCallback()
	{
	    return $this->onSuccessCallback;
	}

	public function setOnSuccessCallback($onSuccessCallback)
	{
	    $this->onSuccessCallback = $onSuccessCallback;
	}

	public function getConfirmTitle()
	{
	    return $this->confirmTitle;
	}

	public function setConfirmTitle($confirmTitle)
	{
	    $this->confirmTitle = $confirmTitle;
	}

	public function getConfirmMessage()
	{
	    return $this->confirmMessage;
	}

	public function setConfirmMessage($confirmMessage)
	{
	    $this->confirmMessage = $confirmMessage;
	}
}