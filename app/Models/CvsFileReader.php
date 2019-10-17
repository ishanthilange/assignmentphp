<?php

namespace App\Models;



class CvsFileReader
{
    /**
     * @Author: Ishan
     * @Date: 2019-10-19
     * @Description: Read a given file
     **/
    public function readFile($fileName){
        try{
            $aDataArray = array();
            if (($handle = fopen($fileName, "r")) !== FALSE) {
                $iIndex = 0;
                while (($line = fgetcsv($handle,1000,';')) !== FALSE) {
                    if($iIndex>0){ // ignore the csv file header
                        // Validate the current line
                        $aValidate = $this->validateLine($line);
                        if($aValidate["status"]){
                            $aDataArray[$iIndex]['created_at']= ($line[1]);
                            $aDataArray[$iIndex]['onboard_percentage']= ($line[2]);
                        }else{
                            return $aValidate;
                        }

                    }
                    $iIndex++;
                }
            }
            return array("status"=>true,"data"=>$aDataArray);
        }catch (\Exception $exception){
            return array("status"=>false,"message"=>$exception->getMessage());
        }

    }

    /**
     * @Author: Ishan
     * @Date: 2019-10-19
     * @Description: Validate a record line
     **/
    public function validateLine($aRecordLine){

        // consider only created date and onboard percentage values
        if(count($aRecordLine) == 5){
            if(
                isset($aRecordLine[1]) &&
                isset($aRecordLine[2]) )
                {
                    if(empty($aRecordLine[1])){
                        return array(
                            'status' => false,
                            'message' => 'Onboarding date cannot be empty.'
                        );
                    }
                    if(0==preg_match("([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))",$aRecordLine[1],$match)){
                        return array(
                            'status' => false,
                            'message' => 'Onboarding date format is wrong. It should be in yyyy-mm-dd format'
                        );
                    }
                    if(empty($aRecordLine[2])){
                        return array(
                            'status' => false,
                            'message' => 'Onboarding percentage cannot be empty.'
                        );
                    }
                    if(empty($aRecordLine[2])){
                        return array(
                            'status' => false,
                            'message' => 'Onboarding percentage cannot be empty.'
                        );
                    }
                    if(0==preg_match("/^\d+$/",$aRecordLine[2],$match)){
                        return array(
                            'status' => false,
                            'message' => 'Onboarding percentage should be a numeric value.'
                        );
                    }
                    //TODO validate the onboading percentages with stage percentage values. ( This needs to be complete,
                    //TODO but found few records which are not tally with the given values)
                    return array(
                            'status' => true
                    );

            }
        }

        return array(
            'status' => false,
            'message' => 'This record is not in the correct format.'
        );
    }
}
