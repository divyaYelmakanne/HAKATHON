<?php
// Simple test file for text-to-image backend
header('Content-Type: application/json');

// Test data
$testData = [
    'prompt' => 'A beautiful sunset over mountains',
    'style' => 'realistic',
    'size' => '1024x1024'
];

// Simulate the backend response
$imageUrl = "https://via.placeholder.com/400x400/667eea/ffffff?text=" . urlencode($testData['prompt']);

echo json_encode([
    'success' => true,
    'imageHtml' => '<img src="' . $imageUrl . '" alt="Generated Image" class="generated-image" style="max-width: 100%; max-height: 400px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">',
    'imageUrl' => $imageUrl,
    'message' => 'Test image generated successfully!'
]);
?> 