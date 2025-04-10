<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 07/05/18
 * Time: 14:19
 */
namespace SimpliCeremonyStreamingPlugin\Repositorys;
use \SimpliCeremonyStreamingPlugin\Models\Singleton;
use SimpliCeremonyStreamingPlugin\Models\SphinxApiRequester;

abstract class Repository extends Singleton {
    protected $requester;
    protected $builder;
    protected $consumer;

    protected function __construct(){
        $this->requester = new SphinxApiRequester();
    }

    public function SetConsumer($consumer){
        $this->consumer = $consumer;
    }
}