// EXTERNAL API
const JSONPLACEHOLDER_URI = 'https://jsonplaceholder.typicode.com/posts?limit=10';

// *** Variables ***
//-- buttons
const btnGetTextFile = document.getElementById('btn1');
const btnGetUser = document.getElementById('btn2');
const btnGetUsers = document.getElementById('btn3');
const btnGetPosts = document.getElementById('btn4');
const btnSendPost = document.getElementById('btn5');
//-- output
const textOutput = document.querySelector('#text');
const userOutput = document.querySelector('#user');
const usersOutput = document.querySelector('#users');
const postsOutput = document.querySelector('#posts');

// *** Functions ***
//OLD Version AJAX (XMLHttpRequest())
//-- Load Text File Information

function getDataFrom(source) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', source);

    xhr.addEventListener('load', () => {
      if (xhr.status === 200) {
        console.log(xhr);

        if (xhr.getResponseHeader('Content-Type') === 'application/json') {
          resolve(JSON.parse(xhr.response));
        }

        resolve(xhr.response);
      } else {
        reject(xhr.responseText);
      }
    });

    xhr.addEventListener('error', () => {
      reject(xhr.responseText);
    });

    xhr.send();
  });
}

function loadTextFileXHR() {
  getDataFrom('http://localhost:8080/data/sample.txt')
    .then(response => {
      textOutput.textContent = response;
    })
    .catch(error => {
      console.warn(error);
      textOutput.textContent = error;
    });
}

//-- Load User Information
function loadUserXHR() {
  getDataFrom('http://localhost:8080/data/user.json')
    .then(data => {
      userOutput.textContent = `${data.name}, ${data.email}`;
    })
    .catch(error => {
      console.warn(error);
      userOutput.textContent = error;
    });
}

//-- Load Users information
function loadUsersXHR() {
  getDataFrom('http://localhost:8080/data/users.json')
    .then(dataArr => {
      dataArr.forEach(data => {
        usersOutput.innerHTML += `<p>${data.name}, ${data.email}</p>`;
      })
    })
    .catch(error => {
      console.warn(error);
      usersOutput.textContent = error; 
    });
}

//-- Load Users information
function loadPostsXHR() {
  return;
}

//NEW VERSION AJAX (fetch())
// -- Getting data
function loadPostsFETCH() {
  return;
}

// -- Sending data
function sendPostFETCH() {
  return;
}
// *** Events ***
btnGetTextFile.addEventListener('click', loadTextFileXHR);
btnGetUser.addEventListener('click', loadUserXHR);
btnGetUsers.addEventListener('click', loadUsersXHR);
btnGetPosts.addEventListener('click', loadPostsXHR);
btnGetPosts.addEventListener('click', loadPostsFETCH);
btnSendPost.addEventListener('click', sendPostFETCH);

/*
    readyState Values:
    0: request not initialized
    1: server connection established
    2: request received
    3: processing request
    4: request finished and response is ready
    More: https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/readyState

    HTTP Statuses
    200: "OK"
    403: "Forbidden"
    404: "Not Found"
    More: https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
*/
