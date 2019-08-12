<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Chunks extends Model
{
    use Notifiable;

    protected $table = "chunks";

    protected $fillable = [
        'title', 'body', 'author', 'created_at', 'updated_at', 'status',
    ];

    static protected $selectedFields = [
        'chunks.id',
        'chunks.title',
        'chunks.body',
        'chunks.author',
        'chunks.created_at',
        'chunks.updated_at',
        'chunks.status',
        'mixins.type as type',
        'mixins.title as mixins_title',
        'mixins.id as mixins_id',
    ];

    static public function defaultFormData(array $data = null)
    {
        $defaultData = [
            'title' => '',
            'body' => '',
            'author' => '',
            'created_at' => '',
            'updated_at' => '',
            'status' => '',
            'type' => '',
            'mixins_id' => '',
        ];
        if ($data) {
            $defaultData = array_merge($defaultData, $data);
        }
        return (object) $defaultData;
    }

    static public function getChunk($id)
    {
        $chunks = DB::table('chunks')
            ->select(self::$selectedFields)
            ->leftJoin('mixins', 'mixins.id_chunk', '=', 'chunks.id')
            ->where('chunks.id', '=', $id)
            ->get();

        return $chunks;
    }

    static public function getChunksMixins()
    {
        $chunks = DB::table('chunks')
            ->select(self::$selectedFields)
            ->join('mixins', 'mixins.id_chunk', '=', 'chunks.id')
            ->get();

        return $chunks;
    }

    static public function getChunksByType($type)
    {
        $chunks = DB::table('chunks')
            ->select(self::$selectedFields)
            ->leftJoin('mixins', 'mixins.id_chunk', '=', 'chunks.id')
            ->where('mixins.type', '=', $type)
            ->get();

        return $chunks;
    }

    static public function getChunksByTitle($title)
    {
        $chunks = DB::table('chunks')
            ->select(self::$selectedFields)
            ->leftJoin('mixins', 'mixins.id_chunk', '=', 'chunks.id')
            ->where('chunks.title', '=', $title)
            ->get();

        return $chunks;
    }

    static public function getMixinsByTitle($title)
    {
        $chunks = DB::table('chunks')
            ->select(self::$selectedFields)
            ->leftJoin('mixins', 'mixins.id_chunk', '=', 'chunks.id')
            ->where('mixins.title', '=', $title)
            ->get();

        return $chunks;
    }

    static public function insertChunk($title, $body, $author, $status, $type)
    {
        DB::beginTransaction();

        $chunkId = DB::table('chunks')
            ->insertGetId([
                'title' => $title,
                'body' => $body,
                'author' => (int) $author,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => $status,
            ]);

        $mixin = DB::table('mixins')
            ->insert([
                'type' => $type,
                'title' => $type,
                'status' => (int) $status,
                'id_chunk' => $chunkId,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

        DB::commit();

        return $chunkId;
    }

    static public function incomplete () {
        return static::where('status', 0)
            ->leftJoin('mixins', 'mixins.id', '=', 'chunks.id')
            ->get();
    }

    static public function updateChunk ($chunkId, $data, $type, $mixinsId) {

        DB::beginTransaction();

        $result =  DB::table('mixins')->where('id', $mixinsId)->get()->first();


        if ($result && $result->type !== $type) {
            $result = DB::table('mixins')
                ->where('id', $mixinsId)
                ->update([
                    'type' => $type,
                    'title' => $type,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = DB::table('chunks')
            ->where('id', $chunkId)
            ->update($data);

        DB::commit();

        return !!$result;
    }

}
