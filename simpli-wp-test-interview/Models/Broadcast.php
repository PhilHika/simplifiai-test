<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 23/04/18
 * Time: 16:56
 */

namespace SimpliCeremonyStreamingPlugin\Models;
class Broadcast
{

    public $divId;
    public $slug;
    public $description;
    public $externalReference;

    /**
     * Broadcast constructor.
     *
     * @param $divId
     * @param $slug
     */

    public function __construct($slug, $externalReference,$description)
    {
        $this->divId = 'boxcast-widget-'.$slug;
        $this->slug = $slug;
        $this->description = $description;
        $this->externalReference =$externalReference;
    }
}