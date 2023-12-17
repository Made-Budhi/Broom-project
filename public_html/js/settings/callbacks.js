function edit_profile(isClicked = false) {
  if (_isReady(this)) {
    document.getElementById("right_panel")
      .innerHTML = this.responseText;
  }
  
  if (isClicked) {
    return "/profile_edit_view";
  }
}

function edit_preference(isClicked = false) {
  if (_isReady(this)) {
    document.getElementById("right_panel")
      .innerHTML = this.responseText;
  }
  
  if (isClicked) {
    return "/profile_preference_view";
  }
}

function get_support(isClicked = false) {
  if (_isReady(this)) {
    document.getElementById("right_panel")
      .innerHTML = this.responseText;
  }
  
  if (isClicked) {
    return "/get_support_view";
  }
}

function _isReady(doc) {
  return doc.readyState === 4 && doc.status === 200;
}