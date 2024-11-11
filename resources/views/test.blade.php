{{-- <!-- Bubble Head HTML -->
<div class="bubble-head" onclick="toggleDropup()">
    <i class="bi bi-chat-dots"></i> Hubungi Kami
</div>

<div class="dropup-content" id="dropup">
    <a href="https://wa.me/1234567890" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
    <a href="mailto:contact@example.com"><i class="bi bi-envelope"></i> Email</a>
    <a href="tel:+1234567890"><i class="bi bi-telephone"></i> Telepon</a>
</div>

<style>
    .bubble-head {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #1C4682;
        color: white;
        padding: 12px 20px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        cursor: pointer;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    }

    .bubble-head i {
        margin-right: 8px;
        font-size: 20px;
    }

    .dropup-content {
        display: none;
        position: fixed;
        bottom: 70px;
        right: 20px;
        background-color: #ffffff;
        color: #1C4682;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        padding: 10px 0;
        text-align: center;
    }

    .dropup-content a {
        color: #1C4682;
        padding: 10px 20px;
        text-decoration: none;
        display: block;
        font-weight: bold;
    }

    .dropup-content a:hover {
        background-color: #f1f1f1;
    }

    .dropup-content a i {
        margin-right: 5px;
    }
</style>

<script>
    function toggleDropup() {
        var dropup = document.getElementById("dropup");
        dropup.style.display = (dropup.style.display === "block") ? "none" : "block";
    }

    window.onclick = function(event) {
        var dropup = document.getElementById("dropup");
        var bubbleHead = document.querySelector(".bubble-head");
        if (event.target !== bubbleHead && !bubbleHead.contains(event.target)) {
            dropup.style.display = "none";
        }
    };
</script> --}}