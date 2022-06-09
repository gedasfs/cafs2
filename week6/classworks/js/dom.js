
const input = document.querySelector('input');

function clickEventHandler(event) {
    // console.log('clickEventHandler', event.srcElement.nodeName, event);
    console.log(input.value);
}

const btn = document.querySelector('button');


if (btn) {
    // btn.addEventListener('click', function(event) {
    //     console.log('anonymous function: ', event);
    // });

    // btn.addEventListener('click', (event) => {
    //     console.log('anonymous arrow function: ', event);
    // });

    // const clickEventHandlerAsVariable =  function(event) {
    //     console.log('clickEventHandlerAsVariable', event);
    // };

    // btn.addEventListener('click', clickEventHandlerAsVariable);

    btn.addEventListener('click', clickEventHandler);
}

document.querySelector('button:last-of-type')?.addEventListener('click', clickEventHandler);

// on focus
// input?.addEventListener('focus', (event) => {
//     console.log(event);
// });

// on focus out
// input?.addEventListener('blur', (event) => {
//     console.log(event);
// });

// when inner value is changed and defocused (can be entered many characters)
input?.addEventListener('change', (event) => {
    console.log('change', event.target.value);
});

// when every char is inputed, deleted
input?.addEventListener('input', (event) => {
    console.log('input ',event.target.value);
});