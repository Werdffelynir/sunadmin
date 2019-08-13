<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Mixins extends Model
{
    use Notifiable;

    protected $table = "mixins";

    protected $fillable = [
        'title', 'type', 'id_chunk', 'created_at', 'updated_at', 'status',
    ];

    public function getMixin(): Array
    {

    }

    static public function getMixinTypes()
    {
        $mixins = DB::table('mixins')
            ->distinct()
            ->select(['type'])
            ->get();

        return $mixins;
    }

    static public function insertMixinType($type)
    {
        $types = (array) self::getMixinTypes();
        if (in_array($type, $types)) {
            return false;
        }

        $mixin = DB::table('mixins')
            ->insert([
                'type' => $type,
                'title' => $type,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

        return $mixin;
    }

    static public function insertMixin($idChunk, $type)
    {

        $mixin = DB::table('mixins')
            ->insert([
                'type' => $type,
                'title' => $type,
                'status' => 0,
                'id_chunk' => $idChunk,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

        return $mixin;
    }
}
