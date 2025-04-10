<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 07/05/18
 * Time: 14:17
 */

namespace SimpliCeremonyStreamingPlugin\Repositorys;

use SimpliCeremonyStreamingPlugin\Builders\DefunctBuilder;
use SimpliCeremonyStreamingPlugin\Gateways\DefunctGateway;


class DefunctRepository extends Repository {
    protected function __construct(){
        parent::__construct();

    }

    public function Get($identifier){
        $defunct = array();
        $this->SetConsumer(new DefunctGateway());
        $result = $this->consumer->Get($identifier);
        if (!empty($result)) {
                $this->builder = new DefunctBuilder();

            $builder = $this->builder->Create($result);
            $defunct = $builder->Build();

        };
        return $defunct;
    }
}
