const body = document.body;

function checkForStorage() {
	return typeof (Storage) !== 'undefined';
}

function getTheme(){
	if(checkForStorage){
		return JSON.parse(localStorage.getItem('theme'));
	}
}

function changeTheme(){
	if(checkForStorage){
		const currentTheme = JSON.parse(localStorage.getItem('theme'));
		localStorage.setItem('theme', JSON.stringify(!currentTheme));
		body.setAttribute('data-bs-theme', getTheme()? 'light' : 'dark');
		document.getElementById('darkThemeRadio').checked = !getTheme();
		document.getElementById('lightThemeRadio').checked = getTheme();
	}
}

const lightBlock = document.getElementById('lightThemeBlock');
const darkBlock = document.getElementById('darkThemeBlock');
lightBlock.addEventListener('click', () => {
	if (!getTheme()) {
		changeTheme();
	}
});
darkBlock.addEventListener('click', () => {
	if (getTheme()) {
		changeTheme();
	}
});

document.addEventListener('DOMContentLoaded', () => {
	if(checkForStorage){
		if (localStorage.getItem('theme') === null) {
			const theme = true;
			localStorage.setItem('theme', JSON.stringify(theme));
		}
		else {
			body.setAttribute('data-bs-theme', getTheme()? 'light' : 'dark');
		}
	}
	else {
		console.log("browser tidak mendukung preferences change theme");
	}
});
