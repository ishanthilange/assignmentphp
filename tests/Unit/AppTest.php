<?php

namespace Tests\Unit;

use App\Models\CvsFileReader;
use App\Models\DataProcessor;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function testPage_loading()
    {

        $response = $this->get('/display');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function testFailure()
    {
        $this->assertFileExists('public/export.csv');
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function test_the_out_put_data_type_of_get_data_for_graph_function(){

        $request = Request::create('/display', 'GET');
        $middleware = new DataProcessor();
        $response = $middleware->getDataForGraph($request, function () {});
        $this->assertEquals($response, array());
    }


    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function test_the_out_put_data_type_of_file_line_validator_method(){

        $request = Request::create('/display', 'GET');
        $middleware = new CvsFileReader();
        $response = $middleware->validateLine($request, function () {});
        $this->assertEquals($response, array());
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function test_the_out_put_data_type_of_file_reading_function(){

        $request = Request::create('/display', 'GET');
        $middleware = new CvsFileReader();
        $response = $middleware->readFile($request, function () {});
        $this->assertEquals($response, array());
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function test_the_out_put_data_type_of_getProcessedDataArray_function(){

        $request = Request::create('/display', 'GET');
        $middleware = new DataProcessor();
        $response = $middleware->getProcessedDataArray($request, function () {});
        $this->assertEquals($response, array());
    }

    //TODO validate the file line validating function
    //TODO validate the getProcessedDataArray function
}
