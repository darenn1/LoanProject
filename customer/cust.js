document.addEventListener('DOMContentLoaded', () => {
    const username = localStorage.getItem('username'); // Or sessionStorage
    document.getElementById('welcomeMessage').textContent = `Welcome ${username}`;
});
