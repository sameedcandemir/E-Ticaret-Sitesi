document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Formun varsayılan gönderimini engelle

        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm_password").value.trim();

        // Şifre eşleşmesi kontrolü
        if (password !== confirmPassword) {
            alert("Şifreler eşleşmiyor. Lütfen tekrar deneyin.");
            return;
        }

        // Form verilerini oluştur
        const formData = new FormData();
        formData.append("username", username);
        formData.append("email", email);
        formData.append("password", password);
        formData.append("confirm_password", confirmPassword);

        // AJAX isteği
        fetch("register.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.text())
            .then((data) => {
                alert(data); // PHP'den gelen mesajı göster
                form.reset(); // Formu sıfırla
            })
            .catch((error) => {
                console.error("Hata:", error);
                alert("Bir hata oluştu. Lütfen tekrar deneyin.");
            });
    });
});
