<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>دردشة المعهد</title>
  <style>
    body { font-family: Cairo, sans-serif; padding: 20px; }
    #chat { border: 1px solid #ccc; height: 300px;
            overflow-y: auto; padding: 10px; }
    .msg { padding: 5px; background: #eff6ff; margin: 5px 0; }
  </style>
</head>
<body>
  <h2>💬 دردشة معهد الحاسوب</h2>
  <div id="chat"></div>
  <input type="text" id="message" placeholder="اكتب رسالتك..." />
  <button onclick="sendMessage()">إرسال</button>

  <script>
    const socket = new WebSocket('ws://192.168.36.1:8080');

    socket.onmessage = function(event) {
      const chat = document.getElementById('chat');
      chat.innerHTML += `<div class="msg">${event.data}</div>`;
      chat.scrollTop = chat.scrollHeight;
    };

    function sendMessage() {
      const input = document.getElementById('message');
      socket.send(input.value);
      input.value = '';
    }
  </script>
</body>
</html>
