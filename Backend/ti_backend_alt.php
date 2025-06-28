<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Get the POST data from the frontend
$data = json_decode(file_get_contents('php://input'), true);

// Check if the prompt is valid
if (isset($data['prompt']) && !empty($data['prompt'])) {
    $prompt = $data['prompt'];
    $style = isset($data['style']) ? $data['style'] : 'realistic';
    
    // For demo purposes, we'll use a placeholder image service
    // In a real implementation, you would integrate with an actual AI image generation API
    
    // Create a unique image based on the prompt using a placeholder service
    $encodedPrompt = urlencode($prompt);
    $imageUrl = "https://via.placeholder.com/400x400/667eea/ffffff?text=" . $encodedPrompt;
    
    // Alternative: Use a more sophisticated placeholder service
    // $imageUrl = "https://picsum.photos/400/400?random=" . time();
    
    // Return success response with image HTML
    echo json_encode([
        'success' => true,
        'imageHtml' => '<img src="' . $imageUrl . '" alt="Generated Image" class="generated-image" style="max-width: 100%; max-height: 400px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">',
        'imageUrl' => $imageUrl,
        'message' => 'Demo image generated based on your prompt: "' . $prompt . '"'
    ]);
    
} else {
    // If the prompt is missing or invalid
    echo json_encode([
        'success' => false,
        'error' => 'No prompt provided. Please enter a valid text prompt.'
    ]);
}
?> 