<?php

namespace App\Services;

use Phpml\Classification\Classifier;
use Phpml\Classification\MLPClassifier;
use Phpml\ModelManager;

class LeafDiseaseDetector
{
    protected $model;
    
    public function __construct()
    {
        // Load the ML model from the storage directory
        $modelPath = storage_path('app/ml/model.h5');
        $modelManager = new ModelManager();
        $this->model = $modelManager->restoreFromFile($modelPath);
    }
    
    public function detectLeafDisease()
    {
        // Load the leaf image
        $imagePath = storage_path('app/diseases/disease.jpg');
        $imageData = file_get_contents($imagePath);
        
        // Preprocess the image data, if needed
        
        // Perform inference using the loaded model
        $prediction = $this->model->predict([$imageData]);
        
        // Return the prediction result
        return $prediction;
    }
}
