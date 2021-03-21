<?php
namespace Rasty\app;

/**
 * Punto de entrada de la aplicaci�n para archivos pdf.
 * 
 *   
 * @author bernardo
 * @since 03-08-2011
 */
use Rasty\components\AbstractComponent;

use Rasty\render\PDFRenderer;

class ApplicationPDF extends ApplicationComponent{

	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Rasty/app/Rasty\app.Application::getRenderer()
	 */
	protected function getRenderer(AbstractComponent $component){
		
		return $component->getPDFRenderer();
		
	}
	
}