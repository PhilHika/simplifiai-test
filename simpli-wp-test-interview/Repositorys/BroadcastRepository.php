<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 07/05/18
 * Time: 14:17
 */

namespace SimpliCeremonyStreamingPlugin\Repositorys;

use SimpliCeremonyStreamingPlugin\Builders\BroadcastBuilder;
use SimpliCeremonyStreamingPlugin\Gateways\BroadcastGateway;


class BroadcastRepository extends Repository {
    protected function __construct(){
        parent::__construct();

    }

    public function Get($identifier){
        $broadcast = array();
        $this->SetConsumer(new BroadcastGateway());
        $result = $this->consumer->Get($identifier);
        if (!empty($result)) {
                $this->builder = new BroadcastBuilder();
                $builder = $this->builder->Create($result);
                $broadcast = $builder->Build();
        };
        return $broadcast;
    }
}
