<?php

namespace Rasty\Menu\menu\model;

use Rasty\utils\LinkBuilder;

/**
 * menu option.
 *
 * @author bernardo
 * @since 15-08-2013
 *
 */
class MenuOption {

	/**
	 * label del menú.
	 * @var string
	 */
	private $label;

	/**
	 * image source.
	 * @var string
	 */
	private $imageSource;


	/**
	 * nombre de la página a consultar
	 * @var string
	 */
	private $pageName;


	/**
	 * nombre del action a consultar
	 * @var string
	 */
	private $actionName;

	/**
	 * parámetros para la página
	 * @var array
	 */
	private $params;

	/**
	 * icon class
	 * @var string
	 */
	private $iconClass;


	/**
	 * orden en el menú.
	 * @var int
	 */
	private $order;

	private $css;

	private $target;

	private $pdf;

    /**
     * opciones del menú
     * @var array [subMenuOption]
     */
    private $subMenuOptions;

    private $selected;

    /**
     * @return mixed
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * @param mixed $selected
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;
    }

    /**
     * @return array
     */
    public function getSubMenuOptions()
    {
        return $this->subMenuOptions;
    }

    /**
     * @param array $subMenuOptions
     */
    public function setSubMenuOptions($subMenuOptions)
    {
        $this->subMenuOptions = $subMenuOptions;
    }

	public function __construct(){
        $this->subMenuOptions = array();

		$this->params = array();
	}

	public function getLabel()
	{
	    return $this->label;
	}

	public function setLabel($label)
	{
	    $this->label = $label;
	}


	public function getPageName()
	{
	    return $this->pageName;
	}

	public function setPageName($pageName)
	{
	    $this->pageName = $pageName;
	}

	public function addParam($name, $value){
		$this->params[$name]=$value;
	 }

	public function getParams()
	{
	    return $this->params;
	}

	public function setParams($params)
	{
	    $this->params = $params;
	}

	public function getImageSource()
	{
	    return $this->imageSource;
	}

	public function setImageSource($imageSource)
	{
	    $this->imageSource = $imageSource;
	}

	public function getLink(){
		if ($this->getPdf()) {
			return LinkBuilder::getPdfUrl($this->getPageName(), $this->getParams() );
		}
		else return LinkBuilder::getPageUrl($this->getPageName(), $this->getParams() );
	}

	public function getOnclick(){
		if ($this->getTarget()) {
			return "gotoLink('". $this->getLink() . "','". $this->getTarget() . "');return false";
		}
		else
		return "gotoLink('". $this->getLink() . "');return false";
	}


	public function getIconClass()
	{
	    return $this->iconClass;
	}

	public function setIconClass($iconClass)
	{
	    $this->iconClass = $iconClass;
	}

	public function hasSubmenu(){
		return false;
	}


	public function getActionName()
	{
	    return $this->actionName;
	}

	public function setActionName($actionName)
	{
	    $this->actionName = $actionName;
	}

	public function getOrder()
	{
	    return $this->order;
	}

	public function setOrder($order)
	{
	    $this->order = $order;
	}

	public function getCss()
	{
	    return $this->css;
	}

	public function setCss($css)
	{
	    $this->css = $css;
	}

	public function getTarget()
	{
	    return $this->target;
	}

	public function setTarget($target)
	{
	    $this->target = $target;
	}

	public function getPdf()
	{
	    return $this->pdf;
	}

	public function setPdf($pdf)
	{
	    $this->pdf = $pdf;
	}

    public function addSubMenuOption(MenuOption $menuOption){

        $order = $menuOption->getOrder();
        if( !empty($order) )
            $this->subMenuOptions[$order] = $menuOption;
        else
            $this->subMenuOptions[] = $menuOption;
    }
}
