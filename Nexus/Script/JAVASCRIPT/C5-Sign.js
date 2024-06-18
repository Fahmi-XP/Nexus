document.addEventListener('DOMContentLoaded', () => {
    const roleField = document.getElementById('role');
    const card2 = document.getElementById('card2');
    const card3 = document.getElementById('card3');

    roleField.addEventListener('change', () => {
        const role = roleField.value;
        
        if (role === 'user') {
            card2.classList.add('active');
            card3.classList.remove('active');
        } else if (role === 'admin') {
            card2.classList.add('active');
            card3.classList.add('active');
        } else {
            card2.classList.remove('active');
            card3.classList.remove('active');
        }
    });
});