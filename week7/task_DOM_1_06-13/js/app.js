const outputH1 = document.querySelector('h1');
let x0 = window.innerWidth;
let y0 = window.innerHeight;

if (outputH1) {
	outputH1.textContent = `x: ${x0}, y: ${y0}`;
	window.addEventListener('resize', function () {
		outputH1.textContent = 'x: ' + window.innerWidth + ', y: ' + window.innerHeight;
	});
}

