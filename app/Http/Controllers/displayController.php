<?php

namespace App\Http\Controllers;


use App\Models\DataProcessor;
use Illuminate\Http\Request;

class displayController extends Controller
{
    //
    public function displayChart(){

        $oDataProccesor = new DataProcessor();
        $aProcessedDataSeries = $oDataProccesor->getDataForGraph();
        $aChartArray = array();
        if($aProcessedDataSeries["status"]){
            $iIndex = 1;
            foreach( $aProcessedDataSeries["data"] as $aRecords){
                $aChartArray [] = array (
                    'name' => 'Week_'.$iIndex,
                    'data' => $aRecords
                );
                $iIndex++;
            }
        }


        return view('chart',array('chartArray'=>json_encode($aChartArray)));

    }
}
