<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGenEd Backend</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .file-list {
            list-style: none;
            padding: 0;
        }
        .file-list li {
            margin: 10px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .file-list a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .file-list a:hover {
            color: #0056b3;
        }
        .status {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 NextGenEd Backend Server</h1>
        
        <div class="status">
            ✅ PHP Server is running successfully on localhost:8000
        </div>
        
        <h2>Available PHP Files:</h2>
        <ul class="file-list">
            <?php
            $files = glob("*.php");
            foreach($files as $file) {
                if($file != "index.php") {
                    echo "<li><a href='$file'>$file</a></li>";
                }
            }
            ?>
        </ul>
        
        <p style="text-align: center; margin-top: 30px; color: #666;">
            Your backend is ready! You can now use your frontend at <strong>http://localhost:8080</strong>
        </p>
    </div>
</body>
</html> 