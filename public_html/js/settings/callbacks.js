
function edit_profile(isClicked = false) {
  if (_isReady(this)) {
    document.getElementById("right_panel")
      .innerHTML = this.responseText;
  }
  
	if (isClicked) {
		setBtnInfo(0);
    return "/profile_edit_view";
  }
}

function edit_preference(isClicked = false) {
  if (_isReady(this)) {
    document.getElementById("right_panel")
      .innerHTML = this.responseText;
  }
  
  if (isClicked) {
		setBtnInfo(1);
    return "/profile_preference_view";
  }
}

function get_support(isClicked = false) {
  if (_isReady(this)) {
    document.getElementById("right_panel")
      .innerHTML = this.responseText;
  }
  
  if (isClicked) {
		setBtnInfo(2);
    return "/get_support_view";
  }
}

function _isReady(doc) {
  return doc.readyState === 4 && doc.status === 200;
}

const setting_item = document.getElementsByClassName("setting-item");

function setBtnInfo(buttonIndex) {
	for (const item in setting_item) {
		try {
			setting_item[item].classList.remove("btn-info");
		} catch (error) {
			
		}
		if (item == buttonIndex) {
			setting_item[item].classList.add("btn-info");
		}
	}
}
