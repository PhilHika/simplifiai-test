<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 20/07/18
 * Time: 11:29
 */
namespace SimpliCeremonyStreamingPlugin\Builders;

use SimpliCeremonyStreamingPlugin\Models\Singleton;

abstract class Builder extends Singleton {
    abstract function Create($data);
    abstract function Build();
}