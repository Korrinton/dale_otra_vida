const tarjetas = document.querySelectorAll('.características-tarjetas');

tarjetas.forEach(tarjeta => {
    tarjeta.addEventListener('mouseenter', () => {
        tarjeta.classList.add('mostrar');
    });

    tarjeta.addEventListener('mouseleave', () => {
        tarjeta.classList.remove('mostrar');
    });
});