document.addEventListener('DOMContentLoaded', () => {
    const username = localStorage.getItem('username'); // Or sessionStorage
    document.getElementById('welcomeMessage').textContent = `Welcome ${username}!`;
});
document.addEventListener('DOMContentLoaded', () => {
  const usernum = localStorage.getItem('usernum'); // Or sessionStorage
  document.getElementById('currNum').textContent = `${usernum}`;
});
