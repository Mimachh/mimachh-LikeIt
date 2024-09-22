<?php

namespace Mimachh\LikeIt\Http\Controllers;

use Illuminate\Routing\Controller; 

class LikeController extends Controller
{

    public function hasLike($type, $id)
    {
        $auth = auth()->user();
    
        if (!$auth) {
            return response()->json(['hasLiked' => false], 401);
        }

        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['hasLiked' => false], 404);
        }

        $hasLiked = $model->hasLike($auth->id);

        return response()->json(['hasLiked' => $hasLiked]);
    }
    
    public function like($type, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(['error' => 'Vous devez être connecté pour aimer.'], 401);
        }
        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['error' => 'Modèle non trouvé.'], 404);
        }

        $model->addLike(auth()->id());

        return response()->json(['message' => 'Liked successfully']);
    }

    public function unlike($type, $id)
    {
        $auth = auth()->user();
        if (!$auth) {
            return response()->json(['error' => 'Vous devez être connecté pour aimer.'], 401);
        }
        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['error' => 'Modèle non trouvé.'], 404);
        }

        $model->removeLike(auth()->id());

        return response()->json(['message' => 'Unliked successfully']);
    }

        /**
     * Alterner entre like et unlike pour un modèle spécifique.
     *
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleLike($type, $id)
    {
   
        $auth = auth()->user();
       
        $model = $this->getModel($type, $id);
        
        if (!$model) {
            return response()->json(['error' => 'Modèle non trouvé.'], 404);
        }

        // Appeler la méthode toggleLike sur le modèle
        $model->toggleLike($auth->id);

        return response()->json(['message' => 'Toggled like successfully']);
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
