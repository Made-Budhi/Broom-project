function loadDoc(func_callback) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = func_callback;
  xhttp.open("POST",
    window.location.href.concat(func_callback(true)));
  
  xhttp.send();
}

function changeProfileEditFormDisabledStatus() {
  let elements = document.getElementsByClassName("profile_edit_form");
  let elementsArray = Array.from(elements);
  
  elementsArray.forEach((element) => {
    let currentDisabled = element.disabled;
    element.disabled = !currentDisabled;
  });
}

function changeProfileFormButton() {
  let element = document.getElementById("form_button");
  let currentType = element.getAttribute("type");
  
  if (currentType === "submit") {
    element.setAttribute("type", "button");
    element.setAttribute("value", "Edit");
  } else {
    element.setAttribute("type", "submit");
    element.setAttribute("value", "Simpan");
  }
}