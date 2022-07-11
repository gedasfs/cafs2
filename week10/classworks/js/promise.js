function randomIntFromInterval(min, max) {
	return Math.floor(Math.random() * (max - min + 1) + min)
}

const networkRequestUserCreate = (name, email) => {
    const seconds = randomIntFromInterval(2, 5);

    console.log('Network request started.');

    return new Promise(function(resolve, reject) {
        setTimeout(() => {
            const status = Math.random() < 0.5;

            const response = {
                status: status ? 201 : 500,
                msg: status ? 'User created successfuly' : 'Failed to create user',
                timestamp: (new Date).toISOString().replace('T', ' '),
            };

            console.log('networkRequestUserCreate before resolve');

            if (status) {
                resolve(response);      // -> then
            } else {
                reject(response);       // -> catch
            }

            console.log('networkRequestUserCreate after resolve');
        }, seconds * 1000);
    });
};

document.querySelector('#btn-click-me')?.addEventListener('click', function() {
    networkRequestUserCreate('Gedas', 'gedas@gedas.lt').then(response => {
        if (response.status == 201) {
            console.log('success in then: ', response.msg, response);
        } else {
            console.log('failed in then: ', response.msg, response);
        }
    }).catch(response => {
        console.warn('catch => ', response);
    }).finally(response => {
        console.log('finally => ', response);
    });
});
