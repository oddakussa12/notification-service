<?php
    require "CustomController.php";
    require "lib/nusoap.php";

    $customer = new CustomController();
    die($customer->registerCustomer());

    // die($customer->deleteCustomer());


    

//    require_once '../htdocs/send.php';
//    require_once '../htdocs/db.php';
   $server = new nusoap_server();
   $server->configureWSDL("sdp", "http://www.csapi.org/schema/parlayx/data/sync/v1_0/local");
   $server->register(
    "syncOrderRelation",
    array("UserId" => "tns:UserId", "spId" => "xsd:string", "productID" => "xsd:string", "serviceID" => "xsd:string", "serviceList" => "xsd:string", "updateType" => "xsd:string"),
    array("syncOrderRelationResponse" => "xsd:Array"),
    "http://www.csapi.org/schema/parlayx/data/sync/v1_0/local", '', "rpc", "literal", "syncOrderRelation"
   );
   $post = file_get_contents("php://input");
   $server->service($post);
   $server->wsdl->addComplexType("UserId", "complexType", "struct", "all", '',
    array(
     "ID" => array("name" => "ID", "type" => "xsd:string"),
    "type" => array("name" => "type", "type" => "xsd:string")
    ));
   $server->wsdl->addComplexType("syncOrderRelationResponse", "complexType", "struct", "all", '',
    array(
       "result" => array("name" => "result", "type" => "xsd:string"),
      "resultDescription" => array("name" => "resultDescription", "type" => "xsd:string")
    ));

    class syncOrderRelationResponse
{
    public $result = "0";
    public $resultDescription = "OK";
}

class UserID {
    public $ID;
    public $type;
}
$server->wsdl->schemaTargetNamespace = "http://soapinterop.org/xsd/";

  function SyncOrderRelation(array $UserID, $spId, $productID, $serviceID, $serviceList, $updateType)
  {
      global $db;
      global $MO;

      foreach ($UserID as $key => $value) {
        if ($key == "ID") {
            $ID = htmlspecialchars("{$value}");
















               //register customers

                if ($updateType == "1")
                {

                    $phoneNumber=$ID;
                          //two tasks
                          //1. register user into a database;
                          //2. send a request to website.


                    break;
                }

                else{
                                           //two tasks
                          //1. register user into a database;
                          //2. send a request to website.
                    break;
                }


















            }
            }

        $resp = array();
        $resp["result"] = 0;
        $resp["resultDescription"] = "OK";
        return $resp;
   }

?>
