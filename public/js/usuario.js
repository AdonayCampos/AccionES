destroy = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'El usuario será eliminado',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((res) => {
        if (res.isConfirmed) {
            const request = new XMLHttpRequest();
            request.open('delete', url);
            request.setRequestHeader('X-CSRF-TOKEN', token);
            request.onload = () => {
                if (request.status == 200) {
                    e.closest('tr').remove();
                    Swal.fire({
                        icon: 'success',
                        text: 'Usuario eliminado'
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};