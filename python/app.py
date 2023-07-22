from fastapi import FastAPI, UploadFile, File
from PIL import Image
import io
import numpy as np
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
from enum import Enum

# Create the FastAPI instance
app = FastAPI()

# Define the available model names as an Enum
class ModelName(str, Enum):
    INCEPTION_V3 = "inceptionv3"
    RESNET = "resnet"
    VGG16 = "vgg16"
    XCEPTION = "xception"

# Set the image size
img_width, img_height = 224, 224

# Define the shared class names
class_names = ['Healthy', 'Miner', 'Redspidermite', 'Rust']

# Define the API route to accept image file and model name, and return predictions
@app.post('/predict')
async def predict(image_file: UploadFile = File(...), model_name: ModelName = ModelName.INCEPTION_V3):
    # Load the corresponding model based on the provided model name
    model_path = get_model_path(model_name)
    loaded_model = load_model(model_path)

    # Read the image file
    contents = await image_file.read()
    img = Image.open(io.BytesIO(contents))
    if model_name == ModelName.INCEPTION_V3:
        img_width, img_height = 299, 299
    elif model_name == ModelName.XCEPTION:
        img_width, img_height = 299, 299
    else:
        img_width, img_height = 224, 224
    # Preprocess the image
    img = img.resize((img_width, img_height))
    img_array = image.img_to_array(img)
    img_array = np.expand_dims(img_array, axis=0)
    img_array /= 255.0
    print("bellow is the image size:::::::::::::::::::::::::::::::::::::::::::::::::::::::")
    print(img_width)
    # Make predictions on the image
    predictions = loaded_model.predict(img_array)
    predicted_class_index = np.argmax(predictions)
    predicted_class_name = class_names[predicted_class_index]
    confidence = np.max(predictions)

    # Return the predicted class and confidence as JSON response
    return {'predicted_class': predicted_class_name, 'confidence': float(confidence)}

# Helper function to get the model path based on the model name
def get_model_path(model_name):
    if model_name == ModelName.INCEPTION_V3:
        return 'InceptionV3_model.h5'
    elif model_name == ModelName.RESNET:
        return 'resnet_model.h5'
    elif model_name == ModelName.VGG16:
        return 'vgg16_model.h5'
    elif model_name == ModelName.XCEPTION:
        return 'Xception_model.h5'
    
