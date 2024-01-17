function showResult(str_query) {
  const inputSearch = document.getElementById("inputSearch");
  const livesearch = document.getElementById("livesearch");
  let defaultResultDrop = document.getElementById("default-result-dropdown");
  
  const linkTarget = window.location.href.concat("/search");
  
  if (inputSearch.value.length === 0) {
    livesearch.innerHTML = defaultResultDrop.innerHTML;
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

  xmlhttp.open("GET",linkTarget+"?"+str_query+"="+inputSearch.value);
  xmlhttp.send();
}