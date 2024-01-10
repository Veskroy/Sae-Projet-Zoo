const allDropdownDiv = document.querySelectorAll('.settings-action');

for (const div of allDropdownDiv) {
    console.log('btn', div);
    //const dropdownMenu = button.querySelector('.dropdown-menu');
    //console.log(dropdownMenu);
    const iconSettings = div.querySelector('.settings-action__dropdown-btn');
    console.log(iconSettings);
    iconSettings.addEventListener('click', function () {
        console.log('click');
        //dropdownMenu.classList.toggle('visible');
        div.classList.toggle('visible');
    });
}
