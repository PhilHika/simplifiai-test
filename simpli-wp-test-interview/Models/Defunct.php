<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 23/04/18
 * Time: 16:56
 */

namespace SimpliCeremonyStreamingPlugin\Models;
class Defunct
{

    public $uuid;
    public $defunctUuid; //retrocomp

    /**
     * Broadcast constructor.
     *
     * @param $uuid
     */

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
        $this->defunctUuid = $uuid;
    }
}