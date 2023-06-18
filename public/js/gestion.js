destroy = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'La Gestión será eliminada',
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
                        text: 'Gestión eliminada'
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};

destroyRes = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'El responsable será eliminada de esta gestión',
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
                        text: 'Responsable eliminado de la Gestión'
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};

aprobarGes = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'Esta gestión será aprobada',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((res) => {
        if (res.isConfirmed) {
            const request = new XMLHttpRequest();
            request.open('put', url);
            request.setRequestHeader('X-CSRF-TOKEN', token);
            request.onload = () => {
                if (request.status == 200) {
                    e.closest('tr').remove();
                    Swal.fire({
                        icon: 'success',
                        text: 'Gestión aprobada'
                    }).then(() => {
                        location.reload();
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};

revertirGes = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'Esta gestión será revertida a su estado anterior',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((res) => {
        if (res.isConfirmed) {
            const request = new XMLHttpRequest();
            request.open('put', url);
            request.setRequestHeader('X-CSRF-TOKEN', token);
            request.onload = () => {
                if (request.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Gestión revertida'
                    }).then(() => {
                        location.reload();
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};

ejecutarGes = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'Esta gestión será ejecutada',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((res) => {
        if (res.isConfirmed) {
            const request = new XMLHttpRequest();
            request.open('put', url);
            request.setRequestHeader('X-CSRF-TOKEN', token);
            request.onload = () => {
                if (request.status == 200) {
                    e.closest('tr').remove();
                    Swal.fire({
                        icon: 'success',
                        text: 'Gestión en ejecucción'
                    }).then(() => {
                        location.reload();
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};

finalizarGes = function (e) {
    let url = e.getAttribute('url');
    let token = e.getAttribute('token');
    Swal.fire({
        icon: 'question',
        title: '¿Desea continuar?',
        text: 'Esta gestión será finalizada',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((res) => {
        if (res.isConfirmed) {
            const request = new XMLHttpRequest();
            request.open('put', url);
            request.setRequestHeader('X-CSRF-TOKEN', token);
            request.onload = () => {
                if (request.status == 200) {
                    e.closest('tr').remove();
                    Swal.fire({
                        icon: 'success',
                        text: 'Gestión finalizada'
                    }).then(() => {
                        location.reload();
                    });
                }
            };
            request.onerror = err => reject(err);
            request.send();
        }
    });
};