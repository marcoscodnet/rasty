<?php

namespace Rasty\Layout\layout;
use Rasty\conf\RastyConfig;

class RastyHeaderFooterLayout extends RastyLayout{

	public function getContent(){
		
		//contenido del componente..
				
		$xtpl = $this->getXTemplate( dirname(__DIR__) .  "/layout/RastyHeaderFooterLayout.htm" );
		$xtpl->assign('WEB_PATH', RastyConfig::getInstance()->getWebPath() );
				
		$xtpl->assign('title',   $this->oPage->getTitle() );
		
		$xtpl->assign('page',   $this->oPage->render() );
		
		$xtpl->parse("main");
		$content = $xtpl->text("main");
		
		/*
		echo "<pre>";
		var_dump($xtpl);
		echo "</pre>";
		*/
		
		return $content;
	}
	
	public function getType(){
		
		return "RastyHeaderFooterLayout";
		
	}	
		
}
?>