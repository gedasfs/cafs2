const btnLoad = document.querySelector('#btn-load-data');
const userTable = document.querySelector('#data-table');
const tblBody = userTable.querySelector('tbody');

const url = 'https://jsonplaceholder.typicode.com/posts';

const fillTableWithData = function(dataArr) {
    for (let i = 0; i < dataArr.length; i++) {
        const row = document.createElement('tr');
        row.innerHTML = 
            `<td id="${dataArr[i].id}">${i+1}</td>
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

const getPosts = function() {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Problems with network response.');
            }
            return response;
        })
        .then(response => response.json())
        .then(data => {
            if (!data.length) {
                throw new Error('Empty data array.');
            }
            fillTableWithData(data);
            showTable(userTable);
        })
        .catch(err => {
            console.warn(err);
            showError('Error: ' + err.message);
        });
};

btnLoad.addEventListener('click', getPosts);