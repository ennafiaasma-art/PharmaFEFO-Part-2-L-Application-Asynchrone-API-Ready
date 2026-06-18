document.getElementById('adduser').addEventListener('submit', function(e) {
    e.preventDefault(); 
    const url ='http://localhost/webapp/api/src/controller/web/AdminController.php';
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(data) 
    })
    .then(response => response.json())
    .then(res => {
        if (res.status === 'success') {
            sessionStorage.setItem('flash_success', res.message);
            this.reset();
            if(document.querySelector('.btnCloseModal')) {
                document.querySelector('.btnCloseModal').click();
            }
            window.location.href = '/../../src/templates/admin.DashboardAdmin.php?data_succ'; 
        } else {
            Swal.fire({ icon: 'error', title: 'Erreur...', text: res.message });
        }
    })
    .catch(error => console.error('Erreur:', error));
});
document.addEventListener('DOMContentLoaded', function() {   
    loadUsers(); 
    const successMsg = sessionStorage.getItem('flash_success');
    if (successMsg) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
        Toast.fire({
            icon: 'success',
            title: successMsg,
            background: '#f0fdf4',
            iconColor: '#16a34a'
        });
        sessionStorage.removeItem('flash_success'); 
    }
});