document.getElementById('adduser').addEventListener('submit', function(e) {
    e.preventDefault(); 
    
const url = 'http://localhost/webapp/api/src/controller/web/MedicaleController.php';    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch(url, {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json', 
            'Accept': 'application/json' 
        },
        body: JSON.stringify(data) 
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau أو مشكلة في السيرفر');
        }
        return response.json();
    })
    .then(res => {
        if (res.status === 'success') {
            // 1. حفظ رسالة النجاح
            sessionStorage.setItem('flash_success', res.message);
            
            // 2. تفريغ الفورم
            this.reset();
            
            // 3. إغلاق المودال باستخدام الدالة المعرفة في الـ HTML
            if (typeof toggleUserModal === "function") {
                toggleUserModal(false);
            }
            
            // 4. إعادة تحديث الصفحة الحالية لإظهار الـ Toast والـ User الجديد في الجدول
            window.location.reload(); 
            
        } else {
            Swal.fire({ 
                icon: 'error', 
                title: 'Erreur...', 
                text: res.message || 'Une erreur est survenue' 
            });
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        Swal.fire({ 
            icon: 'error', 
            title: 'Erreur...', 
            text: 'Impossible de contacter le serveur.' 
        });
    });
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