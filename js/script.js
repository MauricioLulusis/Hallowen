document.addEventListener("DOMContentLoaded", function() {
    const votarButtons = document.querySelectorAll(".votar");

    votarButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const disfrazId = button.getAttribute("data-id");

            fetch("votar_disfraz.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: disfrazId }),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("¡Gracias por tu voto!");

                    // Actualizar el contador de votos en la interfaz
                    const votosElement = document.getElementById(`votos-${disfrazId}`);
                    if (votosElement) {
                        votosElement.textContent = data.votos;
                    }
                } else {
                    alert(data.message || "Hubo un error al enviar tu voto. Inténtalo nuevamente.");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("No se pudo enviar el voto. Verifica tu conexión.");
            });
        });
    });
});
