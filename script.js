document.addEventListener('DOMContentLoaded', () => {
    const daySelect = document.getElementById('day');
    const monthSelect = document.getElementById('month');
    const yearSelect = document.getElementById('year');

    const currentDay = new Date().getDate();
    for (let i = 1; i <= 31; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        daySelect.appendChild(option);
    }
    daySelect.value = currentDay;

    const currentYear = new Date().getFullYear();
    for (let i = 1940; i <= currentYear; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        yearSelect.appendChild(option);
    }

    const currentMonth = new Date().getMonth() + 1;
    monthSelect.value = currentMonth;
});

function verifyAge() {
    const day = document.getElementById('day').value;
    const month = document.getElementById('month').value;
    const year = document.getElementById('year').value;

    const birthDate = new Date(year, month - 1, day);
    const today = new Date();
    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    const dayDiff = today.getDate() - birthDate.getDate();

    let isOfAge = age > 18 || (age === 18 && (monthDiff > 0 || (monthDiff === 0 && dayDiff >= 0)));
    
     if (localStorage.getItem('attemptedUnderage') === 'true') {
        alert('Ya has intentado ingresar anteriormente y no cumples con la mayoría de edad. Lamentamos las molestias.');
        return;
    }

    if (isOfAge) {
        localStorage.setItem('ageVerified', 'true');
        window.location.href = 'index.php';
    } else {
        alert('No puedes ingresar, no cumples con la mayoría de edad.');
        localStorage.setItem('attemptedUnderage', 'true');
    }
}
