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
        'title', 'body', 'options', 'author', 'created_at', 'updated_at', 'status',
    ];

    static protected $selectedFields = [
        'chunks.id',
        'chunks.name',
        'chunks.title',
        'chunks.body',
        'chunks.options',
        'chunks.author',
        'chunks.created_at',
        'chunks.updated_at',
        'chunks.status',
    ];

    static public function defaultFormData(array $data = null)
    {
        $defaultData = [
            'title' => '',
            'name' => '',
            'body' => '',
            'options' => '',
            'author' => '',
            'created_at' => '',
            'updated_at' => '',
            'status' => true,
            'type' => '',
            'mixins' => [],
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
            ->where('id', '=', $id)
            ->get();

        $chunk = $chunks->first();

        $mixins = DB::table('mixins')
            ->select('id', 'type', 'id_chunk')
            ->where('id_chunk', '=', $chunk->id)
            ->get();

        $chunk->mixins = $mixins;

        return $chunk;
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


    static public function insertChunk($data, $mixins)
    {
        DB::beginTransaction();

        $chunkId = DB::table('chunks')
            ->insertGetId($data);

        foreach ($mixins as $mixin) {
            DB::table('mixins')
                ->insert([
                    'type' => $mixin['type'],
                    'title' => $mixin['type'],
                    'id_chunk' => $chunkId,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        DB::commit();

        return $chunkId;
    }

    static public function updateChunk ($chunkId, $data, $mixins) {

        DB::beginTransaction();

        DB::table('chunks')
            ->where('id', $chunkId)
            ->update($data);

        $result = DB::table('mixins')->where('id_chunk', $chunkId)->delete();

        foreach ($mixins as $mixin) {
            $result = DB::table('mixins')
                ->insert([
                    'type' => $mixin['type'],
                    'title' => $mixin['type'],
                    'id_chunk' => $chunkId,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        DB::commit();

        return !!$result;
    }

    static public function removeChunk($id) {
        DB::beginTransaction();
        DB::table('chunks')
            ->delete($id);
        $result = DB::table('mixins')
            ->where('id_chunk', $id)
            ->delete();
        DB::commit();
        return !!$result;
    }

}
