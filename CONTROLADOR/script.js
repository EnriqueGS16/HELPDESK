document.addEventListener("DOMContentLoaded", () => {
    const barralateral = document.querySelector(".barra-lateral");
    const foto = document.getElementById("foto");
    const spans = document.querySelectorAll("span");

    if (foto) {
        foto.addEventListener("click", () => {
            barralateral.classList.toggle("mini-barra-lateral");

            // Iteramos sobre cada span para agregar la clase 'oculto'
            spans.forEach((span) => {
                span.classList.toggle("oculto");
            });
        });
    } else {
        console.log("No se encontró el elemento foto");
    }
});
