document.querySelector('.toggle-btn').addEventListener('click', function() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main_content');
    sidebar.classList.toggle('hidden');
    mainContent.classList.toggle('shifted');
});