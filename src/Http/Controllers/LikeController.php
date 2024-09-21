<?php

namespace Mimachh\LikeIt\Http\Controllers;

use App\Http\Controllers\Controller;

class LikeController extends Controller
{
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

    protected function getModel($type, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($type);

        if (!class_exists($modelClass)) {
            return null;
        }

        return $modelClass::find($id);
    }
}
