

//Отправка Ajax запросов к серверу
export async function SendRequest(method, url, body = null, debug = true) {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();
		xhr.open(method, url, true)
		xhr.responseType = 'json';
		xhr.withCredentials = true;
		xhr.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content)
		if (xhr.readyState == 1 && debug) {
			console.log('Отправка запроса ' + method + ' запроса на ' + url);
		}
		xhr.onload = () => {
			if (xhr.status >= 400) {
				reject(xhr.response);
			} else {
				resolve(xhr.response);
			}
		}
		xhr.onerror = () => {
			reject(xhr.response);
		}
		xhr.send(body);
	});
}


