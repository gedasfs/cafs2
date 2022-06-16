function createAppendTextNode (parent, text) {
    const textNode = document.createTextNode(text);
    parent.appendChild(textNode);
}

function createParagr(child, parent) {

}

window.addEventListener('DOMContentLoaded', () => {
    const divMain = document.querySelector('#main');
    
    const header = document.createElement('h2');
    createAppendTextNode(header, 'Header text');
    divMain.appendChild(header);

    // const header = document.createElement('h2');
    // const textHeader = document.createTextNode('Header text');
    // header.appendChild(textHeader);
    // divMain.appendChild(header);
    


    const pFirst = document.createElement('p');
    createAppendTextNode(pFirst, 'Paragraph text');
    divMain.appendChild(pFirst);

    // const pFirst = document.createElement('p');
    // const textPFirst = document.createTextNode('Paragraph text');
    // pFirst.appendChild(textPFirst);
    // divMain.appendChild(pFirst);
   


    const listUl = document.createElement('ul');
    const listLi = document.createElement('li');
    createAppendTextNode(listLi, 'Li element text');
    listUl.appendChild(listLi);
    divMain.appendChild(listUl);

    // const listUl = document.createElement('ul');
    // const listLi = document.createElement('li');
    // const textLi = document.createTextNode('Li element text');
    // listUl.appendChild(listLi);
    // listLi.appendChild(textLi);
    // divMain.appendChild(listUl);


    const pSecond = document.createElement('p');
    createAppendTextNode(pSecond, 'Paragraph text second');
    divMain.appendChild(pSecond);
    
    // const pSecond = document.createElement('p');
    // const textPSecond = document.createTextNode('Paragraph text second');
    // psecond.appendChild(textPSecond);
    // divMain.appendChild(psecond);

    // console.log(divMain);
});