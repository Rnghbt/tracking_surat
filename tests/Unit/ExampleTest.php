<?php

namespace Tests\Unit;


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\testupload;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testHttpRequest()
    {
        $client = new Client();

        $response = $client->request('POST', 'http://103.100.27.59/~lacaksurat/add_history_disposisi.php', [
            'headers' => [
                'id_pegawai' => '1'
            ],
            'form_params' => [
                'p_tiket_id' => 'BEEAD7',
                'p_id_pegawai_penerima' => '2',
                'p_keterangan' => 'XXXXXXXXXXXX'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $this->assertEquals(200, $statusCode);

        $contentType = $response->getHeaderLine('content-type');
        $this->assertStringContainsString('application/json', $contentType);

        $body = $response->getBody()->getContents();
        // Perform assertions on $body as needed based on the expected response

        // Example assertion:
        // $this->assertStringContainsString('expected content', $body);
    }
}
