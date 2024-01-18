const body = document.body

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
		const currentTheme = getTheme();
		localStorage.setItem('theme', JSON.stringify(!currentTheme));
		body.setAttribute('data-bs-theme', getTheme()? 'light' : 'dark');
		document.getElementById('darkThemeRadio').checked = !getTheme();
		document.getElementById('lightThemeRadio').checked = getTheme();
	}
}

function initPreferences(){
	setTimeout(() => { 
		const lightBlock = document.getElementById('lightThemeBlock');
		const darkBlock = document.getElementById('darkThemeBlock');
		console.log(lightBlock)
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
		initChecked();
	}, 100);
	
}


function initChecked() {
	const theme_item = document.getElementsByName("themeRadio");
	console.log(theme_item)
	if (getTheme()) theme_item[0].checked = true;
	else theme_item[1].checked = true;	
}

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
		console.log("browser tidak mendukung preferences");
	}
});




