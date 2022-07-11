const btnLoad = document.querySelector('#btn-load-data');
const userTable = document.querySelector('#data-table');

const url = 'https://jsonplaceholder.typicode.com/posts';

const fillTableWithData = function(dataArr) {
    const tblBody = userTable.querySelector('tbody');
    
    for (let i = 0; i < dataArr.length; i++) {
        const row = document.createElement('tr');
        row.innerHTML = 
            `<td id="${dataArr[i].id}">${i+1}</td>
            <td>${dataArr[i].title}</td>
            <td>${dataArr[i].body}</td>`;
        tblBody.appendChild(row);
    }
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
            userTable.classList.remove('d-none');
            userTable.classList.add('d-block');
        })
        .catch(err => {
            console.warn(err);
        });
};

btnLoad.addEventListener('click', getPosts);