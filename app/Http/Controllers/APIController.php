<?php

namespace App\Http\Controllers;

use App\Chunks;
use Illuminate\Http\Request;

class APIController extends Controller
{
    protected $dataResponse = [
        'error' => false,
        'success' => false,
        'data' => false,
        'length' => 0,
    ];

    public function prepareDataResponse(array $data): array
    {
        return array_merge($this->dataResponse , $data);
    }

    public function chunk(): string
    {
        $title = trim( \request('title'));
        $data = Chunks::getChunksByTitle($title);

        $dataResponse = $this->prepareDataResponse([
            'success' => !!$data,
            'error' => !$data,
            'data' => $data,
            'length' => count($data),
        ]);

        return response()->json( $dataResponse );
    }

    public function mixin(): string
    {
        $type = trim( \request('type'));
        $title = trim( \request('title'));
        $data = Chunks::getMixinsByTitle($title);

        $dataResponse = $this->prepareDataResponse([
            'success' => !!$data,
            'error' => !$data,
            'data' => $data,
            'length' => count($data),
        ]);

        return response()->json( $dataResponse );
    }

}
