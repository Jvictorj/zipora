document.addEventListener('DOMContentLoaded', function() {
    const iconDesktop = document.getElementById('iconemeusdados');
    const iconMobile = document.getElementById('iconemeusdados-mobile');

    function handleIconClick() {
        fetch('../../actions/icon-acesso.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.level === 'admin') {
                        window.location.href ='../../admin/log.php';
                    } else if (data.level === 'cliente') {
                        window.location.href = '../../pages/cliente/Dados_Pessoais.php';
                    }
                } else {
                    window.location.href = '../../pages/login.php';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.href = '../../pages/login.php';
            });
    }

    if (iconDesktop) {
        iconDesktop.addEventListener('click', handleIconClick);
    }

    if (iconMobile) {
        iconMobile.addEventListener('click', handleIconClick);
    }
});