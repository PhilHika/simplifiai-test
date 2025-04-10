<?php

namespace SimpliCeremonyStreamingPlugin\Gateways;

use SimpliCeremonyStreamingPlugin\Models\Requester;

class DefunctGateway extends Gateway implements IDefunctGateway {
    public function __construct(){
        parent::__construct(null, new Requester());

    }

    public function Get($folderUuid){
        $result = array();
        $url = URL_SPHINX_DEFUNCT.'&q=folder_uuid:"'.$folderUuid.'"' ;
        $data = $this->requester->Get($url,null);
        if(isset($data['result']['all_docs'][0])){
            $result = $data['result']['all_docs'][0];
            }
        return $result;
    }

}
