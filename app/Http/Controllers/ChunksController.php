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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('chunks');
    }

    public function list()
    {
        $chunks = Chunks::getChunksMixins();

        return view('chunks', [
            'chunks' => $chunks
        ]);
    }

    public function edit($id)
    {
        $chunk = Chunks::getChunk($id);

        if ($chunk) {
            return $this->create((array) $chunk->first());
        }
        else
            return $this->list();
    }

    public function create(array $chunk = null)
    {
        $chunk = Chunks::defaultFormData($chunk);
        $types = Mixins::getMixinTypes();

        if ($chunk) {
            if (!$chunk->type)
                $chunk->type = 'main';

            return view('editor', [
                'chunk' => $chunk,
                'types' => $types,
            ]);
        }
        return null;
    }


    public function save()
    {
        $insertSuccess = "require";

        $type = trim(\request('type'));
        $title = trim( \request('title'));

        if ($type && $title) {
            $body = \request('body');
            $author = \request('author') ? \request('author') : "Anonimus";
            $status = \request('status') ? \request('status') : 0;
            $insertSuccess = Chunks::insertChunk($title, $body ,$author , $status, $type) ? "ok" : "err";
        }
        return response()->json( $insertSuccess);
    }

    public function delete()
    {

    }
}
