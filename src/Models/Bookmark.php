<?php

namespace Mimachh\LikeIt\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'likable_id', 'likable_type'];

    /**
     * Obtenir le modèle parent (post, comment, etc.) du like.
     */
    public function bookmarkable()
    {
        return $this->morphTo();
    }

    /**
     * Obtenir l'utilisateur qui a effectué le like.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
