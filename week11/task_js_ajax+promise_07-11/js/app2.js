const btnLoad = document.querySelector('#btn-load-data');
const userTable = document.querySelector('#data-table');
const tblBody = userTable.querySelector('tbody');

const baseURL = 'https://jsonplaceholder.typicode.com/';

const fillTableWithData = async function(dataArr) {
    for (let i = 0; i < dataArr.length; i++) {
        const row = document.createElement('tr');

        let user = await getData('users', dataArr[i].userId);

        row.innerHTML = 
            `<td>${user[0].name}</td>
            <td>${dataArr[i].title}</td>
            <td>${dataArr[i].body}</td>`;
        tblBody.appendChild(row);
    }
}

const showTable = function(table) {
    table.classList.remove('d-none');
    table.classList.add('d-block');
}

const showError = function(msg) {
    let divErr = document.createElement('div');
    divErr.classList.add('text-danger', 'mt-3');
    
    let textNode = document.createTextNode(msg);

    divErr.appendChild(textNode);
    document.querySelector('main')?.append(divErr);
}

const getData = function(dataName, id = null) {
    let callURL = baseURL + dataName;

    if (id) {
        callURL += `?id=${id}`;
    }

    return new Promise((resolve, reject) => {
        fetch(callURL)
        .then(response => response.json())
        .then(data => resolve(data))
        .catch(err => reject(err));
    });
}

btnLoad.addEventListener('click', async () => {
    try {
        let posts = await getData('posts');
        fillTableWithData(posts);
        showTable(userTable);
    } catch (err) {
        showError(err.message);
        console.warn(err);
    }
});