<?php

namespace SimpliCeremonyStreamingPlugin\Gateways;


interface IBroadcastGateway {
    public function Get($identifier);
}