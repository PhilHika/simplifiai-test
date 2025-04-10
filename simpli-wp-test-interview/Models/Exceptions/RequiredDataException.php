<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 09/05/18
 * Time: 09:38
 */
namespace SimpliCeremonyStreamingPlugin\Models\Exceptions;

class RequiredDataException extends \Exception {
    private $view;
    private $requiredData;

    public function __construct($view, $requiredData, $message = "The called view doesnt have required data to be rendered", $code = 0, Throwable $previous = null){
        $this->view = $view;
        $this->requiredData = $requiredData;

        parent::__construct($message, $code, $previous);
    }

    public function __toString(){
        return __CLASS__ . ": [{$this->code}]: {$this->message} : {$this->view->GetViewName()} need {$this->requiredData}";
    }
}