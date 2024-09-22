<?php

namespace Mimachh\LikeIt;

use Mimachh\LikeIt\Models\Bookmark;

trait Bookmarkable
{

    /**
     * Ajouter un like à ce modèle pour un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return void
     */
    public function addBookmark($userId)
    {
        if (!$this->hasBookmark($userId)) {
            $this->bookmarks()->create(['user_id' => $userId]);
        }
    }

    /**
     * Retirer le like de ce modèle pour un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return void
     */
    public function removeBookmark($userId)
    {
        $this->bookmarks()->where('user_id', $userId)->delete();
    }

    /**
     * Vérifier si le modèle est liké par un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return bool
     */
    public function hasBookmark($userId)
    {
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    /**
     * Obtenir tous les likes pour ce modèle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Obtenir le nombre de likes pour ce modèle.
     *
     * @return int
     */
    public function bookmarksCount()
    {
        return $this->bookmarks()->count();
    }

    /**
     * Alterner l'état de like/unlike pour un utilisateur spécifique.
     *
     * @param  int  $userId
     * @return void
     */
    public function toggleBookmark($userId)
    {
        if ($this->hasBookmark($userId)) {
            $this->removeBookmark($userId);
        } else {
            $this->addBookmark($userId);
        }
    }
}
