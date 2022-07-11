<?php

namespace Tests\Feature\Traits\API;

use App\Traits\API\ApiResponse;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiResponseTest extends TestCase
{
    use ApiResponse;

    /** @test **/
    public function it_should_should_return_status_200(): void
    {
        $response = $this->okResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->okResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[200]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_201(): void
    {
        $response = $this->createdResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->createdResponse();

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[201]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_204(): void
    {
        $response = $this->noContentResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->noContentResponse();

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[204]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_302(): void
    {
        $response = $this->foundResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->foundResponse();

        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[302]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_400(): void
    {
        $response = $this->badRequestResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->badRequestResponse();

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[400]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_401(): void
    {
        $response = $this->unauthorizedResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->unauthorizedResponse();

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[401]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_403(): void
    {
        $response = $this->forbiddenResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->forbiddenResponse();

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[403]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_404(): void
    {
        $response = $this->notFoundResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->notFoundResponse();

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[404]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_405(): void
    {
        $response = $this->methodNotAllowedResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->methodNotAllowedResponse();

        $this->assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[405]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_409(): void
    {
        $response = $this->conflictResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_CONFLICT, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->conflictResponse();

        $this->assertEquals(Response::HTTP_CONFLICT, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[409]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_422(): void
    {
        $response = $this->unprocessableResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->unprocessableResponse();

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[422]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }

    /** @test **/
    public function it_should_should_return_status_500(): void
    {
        $response = $this->internalServerErrorResponse('Message', ['user' => 'user']);

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());

        $content = ['message' => 'Message', 'data' => ['user' => 'user']];

        $this->assertEquals(json_encode($content), $response->getContent());

        $response = $this->internalServerErrorResponse();

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());

        $content = ['message' => trans(Response::$statusTexts[500]), 'data' => []];

        $this->assertEquals(json_encode($content), $response->getContent());
    }
}
