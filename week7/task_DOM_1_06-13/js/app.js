const outputH1 = document.querySelector('h1');
const x0 = window.innerWidth;
const y0 = window.innerHeight;

function getMsgWithXY(x, y) {
	let msg = `x: ${x}, y: ${y}`;

	return msg;
}

if (outputH1) {
	outputH1.textContent = getMsgWithXY(x0, y0);

	window.addEventListener('resize', function () {
		outputH1.textContent = getMsgWithXY(window.innerWidth, window.innerHeight);
	});
}

