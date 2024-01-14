function showResult() {
  const inputSearch = document.getElementById("inputSearch");
  const livesearch = document.getElementById("livesearch");
  
  const linkTarget = window.location.href.concat("/search");
  
  if (inputSearch.value.length === 0) {
    // TODO need something default to show
    inputSearch.value = "";
    livesearch.innerHTML = "<li><a class=\"dropdown-item\" href=\"\">No Suggestion</a></li>";
    livesearch.style.border = "1px solid #A5ACB2";
    return;
  }

  const xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      livesearch.innerHTML = this.responseText;
      livesearch.style.border = "1px solid #A5ACB2";
    }
  }

  xmlhttp.open("GET",linkTarget+"?room_name="+inputSearch.value,true);
  xmlhttp.send();
}