<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 09/05/18
 * Time: 09:28
 */
namespace SimpliCeremonyStreamingPlugin\Models;


class View {
    private $fileName;
    private $requiredDatas;

    /**
     * View constructor.
     *
     * @param $fileName
     * @param $data
     */
    public function __construct($fileName, $requiredDatas){
        $this->fileName = $fileName;
        $this->requiredDatas = $requiredDatas;

    }

    public function Render($datas){
        if($this->VerifyRequiredField($datas)){
            foreach ($datas as $key => $data){
                $$key = $data;
            }

            include $this->fileName;
        }
    }

    public function VerifyRequiredField($datas){

        try{
            foreach ($this->requiredDatas as $requiredData){
                if( ! in_array($requiredData, array_keys($datas))){
                    throw new RequiredDataException();
                }
            }

            return true;
        } catch(RequiredDataException $e){
            error_log($e);
            exit();
        }
    }

    public function GetViewName(){
        return $this->fileName;
    }

}
