<?php
namespace SimpliCeremonyStreamingPlugin\Builders;

use SimpliCeremonyStreamingPlugin\Models\Defunct;

class DefunctBuilder extends Builder implements IDefunctBuilder {
    public $uuid;

    function Create($data){
        $this->uuid =  $data['defunct_uuid'];
        return $this;
    }
    function Build(){
        return new Defunct($this->uuid);
    }
}