const fs = require('node:fs');
const http = require('node:http');
const path = require('node:path');

const generateFeedback = function(filePath, responseObj) {
    fs.readFile(filePath, (error, content) => {
        if (error) {
            console.log('Error reading file: ', error);
            responseObj.writeHead(404, getContentType());
            responseObj.end('Resource not found.');
        } else {
            console.log(`File ${filePath} read ok.`);
            responseObj.writeHead(200, getContentType(filePath));
            responseObj.end(content);
        }
    });
    
}

const getContentType = function(fileName = '') {
    let ext = fileName.includes('.') ? fileName.split('.').pop() : '';
    let contentType = {'Content-Type': 'text/html',};
    
    switch (ext) {
        case 'css':
            contentType['Content-Type'] = 'text/css'
            break;
        case 'js':
            contentType['Content-Type'] = 'application/javascript'
            break;    
        case 'json':
            contentType['Content-Type'] = 'application/json'
            break;
        case 'txt':
        case '':
            contentType['Content-Type'] = 'text/plain'
            break;
    }

    return contentType;
}

http.createServer(function(request, response) {
    console.log(request.url);
    
    let file = null;

    if (request.url === '/' || request.url === '/index.html' || request.url === '/index') {
        file = 'index.html';
    }
    else {
        file = request.url.slice(1);
    }

    const filePath = path.join('./public', path.normalize(file));
    generateFeedback(filePath, response);
}).listen(8080, () => console.log('Listening on port 8080.'));