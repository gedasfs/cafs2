const btnLoad = document.querySelector('#btn-load-data');
const userTable = document.querySelector('#data-table');
const tblBody = userTable.querySelector('tbody');
const spinnerDiv = document.querySelector('#spinner');

const baseURL = 'https://jsonplaceholder.typicode.com/';

const fillTableWithData = async function(postsArr, usersArr) {
    checkIfArray(postsArr);
    checkIfArray(postsArr);
    
    for (let i = 0; i < postsArr.length; i++) {
        // let user = await getData('users', postsArr[i].userId);
        // checkIfArray(user);

        let user = usersArr.find(userToCheck => postsArr[i].userId === userToCheck.id);


        const row = document.createElement('tr');

        // ${user[0].name}
        row.innerHTML = 
            `<td>${user?.name}</td>
            <td>${postsArr[i].title}</td>
            <td>${postsArr[i].body}</td>`;
        tblBody.appendChild(row);
    }
}

const checkIfArray = function(arr) {
    if (!Array.isArray(arr) || !arr.length === 0) {
        throw new Error('Array is empty or passed not an array');
    }
}

const showElement = function(el) {
    el.classList.remove('d-none');
    el.classList.add('d-block');
}

const hideElement = function(el) {
    el.classList.add('d-none');
    el.classList.remove('d-block');
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
        showElement(spinner);
        let posts = await getData('posts');
        let users = await getData('users');
        await fillTableWithData(posts, users);
        showElement(userTable);
        hideElement(spinner);
    } catch (err) {
        hideElement(spinner);
        showError(err.message);
        console.warn(err);
    }
});