<?php

namespace SimpliCeremonyStreamingPlugin\Gateways;
use SimpliCeremonyStreamingPlugin\Models\Singleton;

class Gateway {
    protected $requester;
    protected $converter;

    public function __construct($converter, $requester){
        $this->requester = $requester;
        $this->converter = $converter;
    }
}