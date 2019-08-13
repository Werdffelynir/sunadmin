<?php

namespace App\Http\Controllers;

use App\Chunks;
use App\Mixins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChunksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $chunks = Chunks::getChunksByType('main');
        $types = Mixins::getMixinTypes();

        return view('records', [
            'chunks' => $chunks,
            'types' => $types,
        ]);
    }


    public function chunksType()
    {
        $type = trim(\request('type'));
        $chunks = Chunks::getChunksByType($type);

        return response()->json( [
            'chunks' => $chunks,
        ]);
    }

    public function editor($id = null)
    {
        $chunk = Chunks::defaultFormData();
        $types = Mixins::getMixinTypes();

        if ($id && $chunk = Chunks::getChunk($id)) {
            $chunk = $chunk->first();
        }

        if ($chunk) {
            if (!$chunk->type)
                $chunk->type = 'main';
            $chunk->status = !!$chunk->status;

            return view('edit', [
                'chunk' => $chunk,
                'types' => $types,
            ]);
        }
        return null;
    }

    public function save() {

        $insertSuccess = "require";
        $fields = ['title', 'body', 'author', 'updated_at', 'status' ];
        $requires = ['title', 'body'];

        $data = [];
        $id = trim(\request('id'));
        $type = trim(\request('type'));
        $mixins_id = trim(\request('mixins_id'));

        array_map(function ($it) use (&$data) {
            $value = \request($it);
            if ($value !== null)
                $data[$it] = $value;
        }, $fields);

        $data['status'] = $data['status'] ? 1 : 0;

        if (array_filter($requires, function ($k) use ($data) {return empty($data[$k]);})) {
            return response()->json( $insertSuccess);
        }


        if ($id) {
            $insertSuccess = Chunks::updateChunk($id, $data, $type, $mixins_id) ? "ok" : "err";
        } else {
            $insertSuccess = Chunks::insertChunk(
                $data['title'],
                $data['body'],
                "Anonymous",
                empty($data['status']) ? 0 : 1,
                $type
            ) ;
        }

        return response()->json( [
            'status' => $insertSuccess ? "ok" : "err",
            'id' => $insertSuccess,
            'event' => $id ? 'update' : 'insert',
        ]);
    }

    public function delete()
    {

    }
}
