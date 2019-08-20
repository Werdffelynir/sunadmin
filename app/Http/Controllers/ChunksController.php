<?php

namespace App\Http\Controllers;

use App\Chunks;
use App\Mixins;


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

        if ($id) {
            $chunk = Chunks::getChunk($id);
            $chunk->status = !!$chunk->status;
        }

        return view('edit', [
            'chunk' => $chunk,
            'types' => $types,
        ]);
    }

    public function save() {
        $id = trim(\request('id'));
        $mixins = \request('mixins');
        if (empty($mixins))
            $mixins = [['type' => 'main']];

        $data = [
            'title' => trim(\request('title')),
            'body' => trim(\request('body')),
            'author' => \request('author') ? trim(\request('author')) : 'Anonymous',
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => \request('status') ? 1 : 0,
        ];

        if ($id) {
            $result = Chunks::updateChunk($id, $data, $mixins) ? "ok" : "err";
        } else {
            $result = Chunks::insertChunk($data, $mixins );
        }

        return response()->json( [
            'status' => $result ? "ok" : "err",
            'id' => $result,
            'event' => $id ? 'update' : 'insert',
        ]);

    }

    public function remove()
    {
        $success = false;
        $id = trim(\request('id'));
        $mixins_id = trim(\request('mixins_id'));

        if ($id && $mixins_id) {
            $success = Chunks::removeChunk($id, $mixins_id);
        }

        return response()->json( [
            'status' => $success ? "ok" : "err",
            'id' => $id,
            'event' => 'remove',
        ]);
    }
}
