<?php

namespace App\Models;



class DataProcessor
{
    /**
     * @Author: Ishan
     * @Date: 2019-10-16
     * @description: get the processed data for the chart after reading the csv file
    **/
    CONST STEP_01  = 0;
    CONST STEP_02  = 20;
    CONST STEP_03  = 40;
    CONST STEP_04  = 50;
    CONST STEP_05  = 70;
    CONST STEP_06  = 90;
    CONST STEP_07  = 99;
    CONST STEP_08  = 100;

    public function getDataForGraph(){
        $oCsvFileReader = new CvsFileReader();
        $aReadData = $oCsvFileReader->readFile('export.csv');
        if($aReadData["status"]){
            $aProcessedDataArray = array();
            $iIndex = 0;

            foreach ($aReadData["data"] as $aRecord){

                // get the week of the year
                $oDate = new \DateTime($aRecord['created_at']);
                $iWeek = $oDate->format("W");

                switch ($aRecord['onboard_percentage']){
                    case self::STEP_01: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 1;
                    }
                    break;
                    case self::STEP_02: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 2;
                    }
                    break;
                    case self::STEP_03: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 3;
                    }
                    break;
                    case self::STEP_04: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 4;
                    }
                    break;
                    case self::STEP_05: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 5;
                    }
                    break;
                    case self::STEP_06: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 6;
                    }
                    break;
                    case self::STEP_07: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 7;
                    }
                    break;
                    case self::STEP_08: {
                        $aProcessedDataArray[$iWeek][$iIndex]['stage'] = 8;
                    }
                    break;

                }
                $iIndex++;
            }

            return $this->getProcessedDataArray($aProcessedDataArray);

        }else{
            return $aReadData;
        }


    }

    // Get the stage wise and weekly wise processed data
    public function getProcessedDataArray($aProcessedDataArray){


        if(!empty($aProcessedDataArray)){
            $aFinalArray = array();
            foreach ($aProcessedDataArray as $key => $aWeeklyData){
                $iNumberOfUsers = count($aWeeklyData);

                $iStageCount_01 = 0;
                $iStageCount_02 = 0;
                $iStageCount_03 = 0;
                $iStageCount_04 = 0;
                $iStageCount_05 = 0;
                $iStageCount_06 = 0;
                $iStageCount_07 = 0;
                $iStageCount_08 = 0;

                // This method can modify to get the processed array using two for loops, but due to the time limitation, I had to submit this version

                foreach ($aWeeklyData as $aRecord){
                    if($aRecord['stage']==1){
                        $iStageCount_01++;
                    }if($aRecord['stage']==2){
                        $iStageCount_02++;
                    }if($aRecord['stage']==3){
                        $iStageCount_03++;
                    }if($aRecord['stage']==4){
                        $iStageCount_04++;
                    }if($aRecord['stage']==5){
                        $iStageCount_05++;
                    }if($aRecord['stage']==6){
                        $iStageCount_06++;
                    }if($aRecord['stage']==7){
                        $iStageCount_07++;
                    }if($aRecord['stage']==8){
                        $iStageCount_08++;
                    }
                }

                $aFinalArray[$key][0] = (float)(($iStageCount_01+$iStageCount_02+$iStageCount_03+$iStageCount_04+$iStageCount_05+$iStageCount_06+$iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][1] = (float)(($iStageCount_02+$iStageCount_03+$iStageCount_04+$iStageCount_05+$iStageCount_06+$iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][2] = (float)(($iStageCount_03+$iStageCount_04+$iStageCount_05+$iStageCount_06+$iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][3] = (float)(($iStageCount_04+$iStageCount_05+$iStageCount_06+$iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][4] = (float)(($iStageCount_05+$iStageCount_06+$iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][5] = (float)(($iStageCount_06+$iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][6] = (float)(($iStageCount_07+$iStageCount_08)/$iNumberOfUsers)*100;
                $aFinalArray[$key][7] = (float)(($iStageCount_08)/$iNumberOfUsers)*100;

            }
            return array("status"=>true, "data"=>$aFinalArray);
        }else{
            return array("status"=>false, "data"=>"No array submitted");
        }


    }
}
