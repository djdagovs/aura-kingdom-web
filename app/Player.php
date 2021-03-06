<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'name', 'level', 'class', 'gold', 'family_name' ];

    /**
     * Types of columns to search by
     *
     * @var array
     */
    protected $types = [ 'level' => 'level', 'gold' => 'gold', 'pvp' => 'pk_count' ];

    /**
     * Search for the current type of rank
     *
     * @param $query
     * @param $sub
     * @return mixed
     */
    public function scopeType( $query, $sub )
    {
        return $query
            ->whereNotIn( 'id', explode( ',', settings( 'ranking_ignore_characters', '0' ) ) )
            ->orderBy( isset( $this->types[ $sub ] ) ? $this->types[ $sub ] : 'level' , 'desc' );
    }
}
