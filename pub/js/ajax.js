const select = document.querySelector("[data-select-query]")
const content = document.querySelector("[data-content]")

const ajax = (res) => {
	const xhr = new XMLHttpRequest();
	const url = res ?? select.value.toLowerCase();
	xhr.open("GET", "/index/" + url);
	xhr.onreadystatechange = () => {
		if (xhr.readyState == 4 && xhr.status == 200) {
			content.innerHTML = xhr.responseText;
		}
		window.history.pushState("html", "pageTitle", url);
	}
	xhr.send()
}

select.onchange = () => ajax();
ajax(window.location.pathname.slice(1));
