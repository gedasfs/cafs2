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
                resolve(response);      // -> await
            } else {
                reject(response);       // -> await -> catch
            }

            console.log('networkRequestUserCreate after resolve');
        }, seconds * 1000);
    });
};

document.querySelector('#btn-click-me')?.addEventListener('click', async function() {
    try {
        let returnedPromise = await networkRequestUserCreate('Gedas', 'gedas@gedas.lt');

        console.log('success await: ', returnedPromise);
    } catch (error) {
        console.warn('error await: ', error);
    }
    
});

