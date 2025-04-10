<?php

namespace SimpliCeremonyStreamingPlugin\Gateways;


interface IDefunctGateway {
    public function Get($folderUuid);
}