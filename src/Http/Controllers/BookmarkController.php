<?php

namespace Mimachh\LikeIt\Http\Controllers;

use Illuminate\Routing\Controller; 

class BookmarkController extends Controller
{

    public function hasBookmark($type, $id)
    {
        $auth = auth()->user();
    
        if (!$auth) {
            return response()->json(['hasBookmark' => false], 401);
        }

        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['hasBookmark' => false], 404);
        }

        $hasBookmark = $model->hasBookmark($auth->id);

        return response()->json(['hasBookmark' => $hasBookmark]);
    }
    
    public function bookmark($type, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(['error' => 'You must be auth.'], 401);
        }
        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['error' => 'Model not found.'], 404);
        }

        $model->addBookmark(auth()->id());

        return response()->json(['message' => 'Bookmarked successfully']);
    }

    public function unbookmarked($type, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(['error' => 'You must be auth.'], 401);
        }
        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['error' => 'Modèle non trouvé.'], 404);
        }

        $model->removeBookmark(auth()->id());

        return response()->json(['message' => 'Unbookmarked successfully']);
    }

        /**
     * Alterner entre like et unlike pour un modèle spécifique.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleBookmark($type, $id)
    {
   
        $auth = auth()->user();
       
        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['error' => 'Model not found.'], 404);
        }

        // Appeler la méthode toggleLike sur le modèle
        $model->toggleBookmark($auth->id);

        return response()->json(['message' => 'Toggled bookmark successfully']);
    }
    
    protected function getModel($type, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($type);

        if (!class_exists($modelClass)) {
            return null;
        }

        return $modelClass::find($id);
    }
}
