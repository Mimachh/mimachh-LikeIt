<?php

namespace Mimachh\Traits\LikeIt;

use Mimachh\Guardians\Models\Like;

trait Likeable
{

    /**
     * Ajouter un like à ce modèle pour un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return void
     */
    public function addLike($userId)
    {
        if (!$this->hasLike($userId)) {
            $this->likes()->create(['user_id' => $userId]);
        }
    }

    /**
     * Retirer le like de ce modèle pour un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return void
     */
    public function removeLike($userId)
    {
        $this->likes()->where('user_id', $userId)->delete();
    }

    /**
     * Vérifier si le modèle est liké par un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return bool
     */
    public function hasLike($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Obtenir tous les likes pour ce modèle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    /**
     * Obtenir le nombre de likes pour ce modèle.
     *
     * @return int
     */
    public function likesCount()
    {
        return $this->likes()->count();
    }

    /**
     * Alterner l'état de like/unlike pour un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return void
     */
    public function toggleLike($userId)
    {
        if ($this->hasLike($userId)) {
            $this->removeLike($userId);
        } else {
            $this->addLike($userId);
        }
    }
}
