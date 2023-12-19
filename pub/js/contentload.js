const select = document.querySelector("[data-select-query]")
const content = document.querySelector("[data-content]")

const ajax = (res) => {
    const xhr = new XMLHttpRequest();
    let url = (res || select.value.toLowerCase()) + window.location.search;
    xhr.open("GET", "/index/" + url);
    xhr.onreadystatechange = () => {
	if (xhr.readyState == 4 && xhr.status == 200) {
	    content.innerHTML = xhr.responseText;
	    let script = content.querySelector("script")
	    if (script) setTimeout(eval(script.innerHTML));
	}
	window.history.pushState("html", "pageTitle", url); // idk
    }
    xhr.send()
}

const initVal = window.location.pathname.slice(1);
if (initVal) select.value = initVal;
ajax(initVal);

select.onchange = () => ajax();
