<?php

namespace SimpliCeremonyStreamingPlugin\Gateways;

use SimpliCeremonyStreamingPlugin\Models\Requester;

class BroadcastGateway extends Gateway implements IBroadcastGateway {
    public function __construct(){
        parent::__construct(null, new Requester());

    }

    public function Get($identifier){
        $result = array();
        $url = URL_SPHINX_BROADCAST.'&q=external_reference:"'.$identifier.'"' ;
        $data = $this->requester->Get($url,null);
        if(isset($data['result']['all_docs'][0])){
            $result = $data['result']['all_docs'][0];
            }
        return $result;
    }
    public function GetDetails($folderUuid){
        $result = array();
        $url = URL_SPHINX_BROADCAST.'&q=folder_uuid:"'.$folderUuid.'"' ;
        $data = $this->requester->Get($url,null);
        if(isset($data['result']['all_docs'][0])){
            $result = $data['result']['all_docs'][0];
        }
        return $result;
    }
}
