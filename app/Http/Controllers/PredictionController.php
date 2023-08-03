<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportedByPrediction;
use App\Models\Confidence;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class PredictionController extends Controller
{
    public function predict(Request $request)
    {
        // Validate the form data
        $request->validate([
            'selected_model' => 'required',
            'image_file' => 'required|image',
        ]);

        // Get the reporting confidence from the database
        $reportingConfidence = Confidence::where('status', 1)->value('confidence');
        
        // Get the selected model and uploaded image
        $selectedModel = $request->input('selected_model');
        $imageFile = $request->file('image_file');

        // Store the uploaded image in the storage directory
        $imagePath = $imageFile->store('prediction');

        $response = Http::attach(
            'image_file',
            file_get_contents($imageFile->path()),
            $imageFile->getClientOriginalName()
        )->post('http://localhost:8888/predict', [
            'model_name' => $selectedModel,
        ]);

        // Get the JSON response from the Python script
        $predictionData = $response->json();

        if ($predictionData['confidence'] < $reportingConfidence || $predictionData['predicted_class'] == "Healthy") {
            Storage::delete($imagePath);
        }        
            
        // Return the response
        return response()->json([
            'image_path' => $imagePath,
            'selected_model' => $selectedModel,
            'predicted_class' => $predictionData['predicted_class'],
            'confidence' => $predictionData['confidence'],
            'reportingConfidence' => $reportingConfidence,
        ]);
    }

    // In your PredictionController, add a new method to handle the report request

    public function report(Request $request)
    {
            $predictedClass = $request->input('predictedClass');
            $confidence = $request->input('confidence');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $imagePath = $request->input('imagePath');
            $Manager_id = auth()->user()->id;
            $cooperative_id = DB::table('cooperative_user')
                             ->where('user_id', $Manager_id)
                             ->value('cooperative_id');

            // Create a new record in the reported_by_prediction table using Eloquent ORM
            ReportedByPrediction::create([
                'cooperative_id' => $cooperative_id,
                'predicted_class' => $predictedClass,
                'confidence' => $confidence,
                'image' => $imagePath,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            return redirect('CooperativeDiseases')->with('success', 'Prediction reported successfully!');
    }


}
