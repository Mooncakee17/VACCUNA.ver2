<?php


include('../templates/Header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccuna</title>

    <link rel="stylesheet" type="text/css" href="../assets/css/style4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<div class="container1">
        <div class="column1">
            
          <?php include('../templates/Parent-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <!-- Chats container -->
            <div class="chat-container"></div>
    
            <!-- Typing container -->
            <div class="typing-container">
                <div class="typing-content">
                    <div class="typing-textarea">
                        <textarea id="chat-input" spellcheck="false" placeholder="Ask your question here" required></textarea>
                        <span id="send-btn" class="material-symbols-rounded">send</span>
                    </div>
                    <div class="typing-controls">
                        <span id="theme-btn" class="material-symbols-rounded">light_mode</span>
                        <span id="delete-btn" class="material-symbols-rounded">delete</span>
                </div>
            </div>
        </div>
</div>
    <script src="js/index.js"></script>
    <script src="../assets/js/AIChatbot.js"></script>
    
</body>
</html>