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
        $fields = ['title', 'body', 'author', 'updated_at', 'status' ];
        $requires = ['title', 'body'];
        $data = [];
        $id = trim(\request('id'));
        $type = trim(\request('type'));
        $mixins_id = trim(\request('mixins_id'));

        array_map(function ($it) use (&$data) {
            $value = \request($it);
            if ($value !== null) {
                $data[$it] = $value;
            }

        }, $fields);

        if (array_filter($requires, function ($k) use ($data) {return empty($data[$k]);})) {
            return response()->json( $insertSuccess);
        }

        if ($id) {


            print_r($id);
            print_r($data);
            print_r($type);
            print_r($mixins_id);
            die;
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
