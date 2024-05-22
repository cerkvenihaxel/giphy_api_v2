<?php

namespace Tests\Unit;

use App\Http\Controllers\GiphyController;
use App\Services\GiphyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class GiphyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $giphyServiceMock;
    protected $logInfoControllerMock;
    protected $giphyController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->giphyServiceMock = Mockery::mock(GiphyService::class);
        $this->logInfoControllerMock = Mockery::mock(\App\Http\Controllers\LogInfoController::class);
        $this->giphyController = new GiphyController($this->giphyServiceMock, $this->logInfoControllerMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    //API Services Testing
    public function testSearch()
    {
        $request = Request::create('/search', 'GET', ['query' => 'funny']);

        $this->giphyServiceMock->shouldReceive('searchGifs')
            ->with('funny', null, null)
            ->andReturn(['data' => []]);

        $this->logInfoControllerMock->shouldReceive('registerActivity')
            ->once()
            ->with('search', 'funny', 200, $request);

        $response = $this->giphyController->search($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent(), json_encode(['data' => []]));
    }

    public function testSearchById()
    {
        $request = Request::create('/searchById', 'GET', ['id' => 'abc123']);

        $this->giphyServiceMock->shouldReceive('searchGifById')
            ->with('abc123')
            ->andReturn(['data' => []]);

        $this->logInfoControllerMock->shouldReceive('registerActivity')
            ->once()
            ->with('searchById', 'abc123', 200, $request);

        $response = $this->giphyController->searchById($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent(), json_encode(['data' => []]));
    }



}
