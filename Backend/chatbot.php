<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGenEd - Lecture Notes Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e3f2fd;
        }
        .header {
            background-color: navy;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            height: 50px;
            padding-top: 17px;
            font-weight: bold;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000; /* Ensures header stays on top */
        }
        .back-button {
            position: absolute;
            left: 20px;
            background: orangered;
            color: white;
            padding: 10px;
            width: 80px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .chat-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .chat-box {
            max-height: 500px;
            overflow-y: auto;
            margin: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .input-container {
            display: flex;
            justify-content: space-between;
        }
        .input-container input {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .input-container button {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        .input-container button:hover {
            background-color: #0056b3;
        }
        .bot-message {
            background-color: #e1f5fe;
            padding: 12px;
            border-radius: 10px;
            font-family: 'Times New Roman', serif;
            text-align: justify;
            margin: 15px;
            font-size: 16px;
            border-left: 5px solid #2196F3;
            position: relative;
        }
        .bot-message strong {
            display: block;
            text-align: center;
            color: orangered;
        }
        .bot-message::after {
            content: "NextGenEd";
            position: absolute;
            bottom: 5px;
            right: 10px;
            font-size: 12px;
            color: rgba(0, 0, 0, 0.5);
        }
        .user-message {
            background-color: #d1ecf1;
            padding: 10px;
            border-radius: 8px;
            border-left: 5px solid #17a2b8;
            margin: 10px;
        }
        .print-button {
            display: none;
            margin-top: 10px;
            padding: 8px 15px;
            border: none;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .print-button:hover {
            background-color: #218838;
        }
        .loading {
            font-weight: bold;
            color: #ff4500;
            margin: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="header">
<button class="back-button" onclick="window.location.href='canti.php';">Back</button>NextGenEd</div><br><br><br><br><br><br>
<div class="chat-container">
    <h2>NextGenEd - Lecture Notes Generator</h2>
    <div id="chat-box" class="chat-box"></div>
    <button id="print-button" class="print-button" onclick="printNotes()">Print Notes</button><br><br>
    <div class="input-container">
        <input type="text" id="user-query" placeholder="Enter lecture topic..." onkeypress="handleKeyPress(event)">
        <button onclick="sendQuery()">Generate</button>
    </div>
</div>

<script>
    function sendQuery() {
        var userQuery = document.getElementById('user-query').value.trim();
        if (userQuery === "") return;

        addMessage('📌 ' + userQuery, 'user-message');
        showLoading();

        fetch('chatbot_backend.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'query=' + encodeURIComponent(userQuery),
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            document.getElementById('print-button').style.display = 'inline-block';
            if (data.error) {
                addMessage('Error: ' + data.error, 'bot-message');
            } else {
                addMessage('<strong>Lecture Notes</strong><br>📖 ' + formatResponse(data.answer), 'bot-message');
            }
        })
        .catch(() => {
            hideLoading();
            addMessage('Error: Something went wrong!', 'bot-message');
        });

        document.getElementById('user-query').value = '';
    }

    function addMessage(message, className) {
        var chatBox = document.getElementById('chat-box');
        var messageDiv = document.createElement('div');
        messageDiv.innerHTML = message;
        messageDiv.classList.add(className);
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function showLoading() {
        var chatBox = document.getElementById('chat-box');
        var loadingDiv = document.createElement('div');
        loadingDiv.id = 'loading';
        loadingDiv.className = 'loading';
        loadingDiv.textContent = 'NextGenEd is working on your request...';
        chatBox.appendChild(loadingDiv);
    }

    function hideLoading() {
        var loadingDiv = document.getElementById('loading');
        if (loadingDiv) loadingDiv.remove();
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            sendQuery();
        }
    }

    function printNotes() {
        var chatBox = document.getElementById('chat-box').innerHTML;
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Lecture Notes</title></head><body>' + chatBox + '</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    function formatResponse(response) {
        let paragraphs = response.split('\n').filter(p => p.trim() !== "");
        return paragraphs.map(p => `<p>${p}</p>`).join('');
    }
</script>

</body>
</html>