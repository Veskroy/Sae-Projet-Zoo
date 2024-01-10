const allDropdownDiv = document.querySelectorAll('.settings-action');

for (const div of allDropdownDiv) {
    const iconSettings = div.querySelector('.settings-action__dropdown-btn');
    iconSettings.addEventListener('click', function () {
        div.classList.toggle('visible');
    });
}
