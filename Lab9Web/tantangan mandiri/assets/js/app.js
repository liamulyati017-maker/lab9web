// Konfirmasi sebelum form dikirim: <form data-confirm="Yakin?">
document.addEventListener('submit', function (event) {
    var pesan = event.target.getAttribute('data-confirm');
    if (pesan && !window.confirm(pesan)) {
        event.preventDefault();
    }
});
