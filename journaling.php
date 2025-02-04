<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Journal</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #fce4ec, #f8bbd0);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff0f6;
      padding: 20px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      border-radius: 15px;
      text-align: center;
      border: 3px solid #ff80ab;
    }

    h1 {
      color: #d81b60;
      font-size: 24px;
      margin-bottom: 10px;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      border: 2px solid #ff80ab;
      border-radius: 10px;
      font-size: 16px;
      background: #fffafc;
      color: #d81b60;
    }

    textarea {
      height: 100px;
      resize: none;
      margin-top: 10px;
    }

    .btn {
      display: block;
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      background: #ff80ab;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.3s ease;
    }

    .btn:hover {
      background: #d81b60;
    }

    .audio-controls {
      margin-top: 10px;
    }

    .entries h2 {
      color: #d81b60;
      font-size: 20px;
      margin-top: 20px;
    }

    .entries ul {
      margin-top: 10px;
    }

    .entries li {
      background: #fffafc;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 10px;
      border: 2px solid #ff80ab;
      color: #d81b60;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>🐶💖 My Journal</h1>
    <form id="journalForm" method="post" action="journal_entry.php">
      <input type="text" id="journalTitle" name="title" placeholder="Enter title... 🐾" required>
      <textarea id="journalEntry" name="entry" placeholder="Write your dreamy thoughts... 🐕✨" required></textarea>
      <button type="submit" class="btn">🐾 Save Entry</button>
    </form>

    <div class="audio-controls">
      <audio id="WaterSound" loop>
        <source src="waterbubbles.mp3" type="audio/mpeg">
      </audio>
    </div>
    <button class="btn" onclick="toggleSound()">💦 Toggle Water Sounds</button>

    <div class="entries" id="entries">
      <?php 
      include 'display_journal.php';
       ?>
    </div>
  </div>

  <script>
    document.getElementById('journalForm').addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent form submission

      const formData = new FormData(this); // Collect form data
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'journal_entry.php', true);

      xhr.onload = function () {
        if (xhr.status === 200) {
          alert('Entry saved successfully!');
          document.getElementById('journalTitle').value = ''; // Clear title field
          document.getElementById('journalEntry').value = ''; // Clear entry field

          // Refresh the entries after submission
          location.reload(); // Reload the page to show the new entry
        } else {
          alert('Error saving entry! ' + xhr.responseText); // Show error response from PHP
        }
      };

      xhr.send(formData); // Send the form data
    });

    function toggleSound() {
      let WaterSound = document.getElementById("WaterSound");
      if (WaterSound.paused) {
        WaterSound.play();
      } else {
        WaterSound.pause();
      }
    }
  </script>
</body>

</html>