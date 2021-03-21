<?php
namespace Rasty\app;

use Rasty\actions\RestfulAction;

use Rasty\conf\RastyConfig;

use Rasty\actions\Forward;

use Rasty\utils\ReflectionUtils;

/**
 *  
 * @author bernardo
 * @since 03-03-2010
 */
class ApplicationRestful{

	const METHOD_GET = "GET";
	const METHOD_PUT = "PUT";
	const METHOD_DELETE = "DELETE";
	const METHOD_POST = "POST";
	
	private $method;

	private $request;
	
	public function ApplicationRestful(){
	}
	
	public function execute(Forward $forward=null){
			
		//avisamos a los subscritores de cambios
//		$listeners = RastyConfig::getInstance()->getAppListeners();
//		foreach ($listeners as $listener) {
//			$listener->actionJsonExecuted( $action );
//		}
//				
//		if( isset($_GET["jsoncallback"]) ){
//			$response = $_GET["jsoncallback"]."(".json_encode( $action->execute() ).")";
//		}else 
//			$response = json_encode( $action->execute() ); 
//		
		
//		header("Access-Control-Allow-Orgin: *");
//      header("Access-Control-Allow-Methods: *");
//      header("Content-Type: application/json");
		
		//CORS 
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: X-Requested-With'); 
		header('Content-Type: application/json');

		

        try {

	        $this->method = $_SERVER['REQUEST_METHOD'];
	        if ($this->method == self::METHOD_POST && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
	            if ($_SERVER['HTTP_X_HTTP_METHOD'] == self::METHOD_DELETE) {
	                $this->method = self::METHOD_DELETE;
	            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == self::METHOD_PUT) {
	                $this->method = self::METHOD_PUT;
	            } else {
	                $response = 'Invalid Method';
			        $code = 405;
			        $this->_response($response, $code );
			        die();
	            }
	        }

        	$path = $_GET['path'] ;
			$map = new RastyMapHelper();
			$action_description =  $map->getRestfulapi($path);
			//obtenemos el action que atiende el request.
			
			$action = ReflectionUtils::newInstance( $action_description["class"] );

			if( $action->isSecure() ){
			
			    $action->checkAuthentication();
			}
			
			$code = 200;
	        switch($this->method) {
		        case 'DELETE':
		        	$response = $action->doDelete();
		            break;
		        case 'POST':
		        	$response = $action->doPost();
		            break;
		        case 'GET':
		        	$response = $action->doGet();
		            break;
		        case 'PUT':
		            $this->file = file_get_contents("php://input");
		            $response = $action->doPut();
		            break;
		        default:
		            $response = 'Invalid Method';
		            $code = 405;
		            break;
	        }
	    
	        $response["status"] = RestfulAction::STATUS_SUCCESS;
	        $this->_response($response, $code );
	        
   		} catch (RastyException $e) {
			
   			$response["status"] = RestfulAction::STATUS_ERROR;
   			$response["msg"] =  $e->getMessage();
			$this->_response( $response );
			
	        
        } catch (Exception $e) {
        	
        	$response["status"] = RestfulAction::STATUS_ERROR;
   			$response["msg"] =  $e->getMessage();
			$this->_response( $response );
        	
        } catch (\Exception $e) {
        	
        	$response["status"] = RestfulAction::STATUS_ERROR;
   			$response["msg"] =  $e->getMessage();
			$this->_response( $response );
        }
        
 	}

	protected  function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        echo json_encode($data);
    }

    private function _cleanInputs($data) {
        $clean_input = Array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    private function _requestStatus($code) {
        $status = array(  
            200 => 'OK',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 
        return ($status[$code])?$status[$code]:$status[500]; 
    }	
    
    
}