<?php

namespace App\Services;

use Phpml\Classification\MLPClassifier;
use Phpml\ModelManager;

class MachineLearningService
{
    public function predict($data)
    {
        $modelPath = storage_path('app/ml/diseases.tflite');

        // Load the machine learning model
        $modelManager = new ModelManager();
        $model = $modelManager->restoreFromFile($modelPath);

        // Perform inference
        $prediction = $model->predict($data);

        return $prediction;
    }
}

