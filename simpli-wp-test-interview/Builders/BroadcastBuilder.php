<?php
namespace SimpliCeremonyStreamingPlugin\Builders;

use SimpliCeremonyStreamingPlugin\Models\Broadcast;

class BroadcastBuilder extends Builder implements IBroadcastBuilder {
    public $slug;
    public $description;
    public $externalReference;



    function Create($data){
        $this->slug =  $data['slug'];
        $this->externalReference = $data['external_reference'];
        $this->description = "Cérémonie en hommage à ".$data['defunct_name'];
        return $this;
    }
    function Build(){
        return new Broadcast($this->slug,$this->externalReference,$this->description);
    }
}