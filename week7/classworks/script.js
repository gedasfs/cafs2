window.addEventListener('DOMContentLoaded', e => {

    // window.addEventListener('keydown', e => {
    //     console.log(e.type, e.key);
    // });

    let div = document.createElement('div');
    let divContent = document.createTextNode('Hi there...');
    console.log(div);

    div.appendChild(divContent);

    document.body.prepend(div);
    
});