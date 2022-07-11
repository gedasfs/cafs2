function randomIntFromInterval(min, max) {
	return Math.floor(Math.random() * (max - min + 1) + min)
}

const networkRequestUserCreate = (name, mail, callback) => {
    const seconds = randomIntFromInterval(2, 5);

    console.log('Network request started');

    // imitating request to server, when arrival of response is unknown
    setTimeout(() => {

        const status = Math.random() < 0.5;

        const response = {
            status: status ? 201 : 500,
            msg: status ? 'User created successfully.' : 'Failed to create user.',
            timestamp: (new Date).toISOString().replace('T', ' '),
        };
        console.log('Network request ended', {seconds});
        callback(response);
    }, seconds * 1000);
};

document.querySelector('#btn-click-me')?.addEventListener('click', function() {
    let userCreatePromise = new Promise(function(resolve, reject) {
        
        networkRequestUserCreate('Gedas', 'gedas@gedas.lt', function(response) {
            console.log('response inside promise: ', response);

            if (response.status == 201) {
                resolve(response);
            } else {
                reject(new Error('Error message inside reject()'));
            }
        });
    });

    userCreatePromise.then(response => {
        console.log('response in then: ', response);
    }).catch(err => {
        console.warn('catch => ', err.message);
    });
});

console.log('console.log() at the end of code');