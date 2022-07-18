const fs = require('node:fs');
const http = require('node:http');

const generateFeedback = function(filePath, responseObj) {
    fs.readFile(filePath, (error, content) => {
        if (error) {
            console.log('Error reading file: ', error);
            responseObj.writeHead(404, setContentTypeByExt());
            responseObj.end(`Resource not found.`);
        } else {
            let ext = getFileExt(filePath);
            console.log(`File ${filePath} read ok.`);
            responseObj.writeHead(200, setContentTypeByExt(ext));
            responseObj.end(content);
        }
    });
    
}

const getFileExt = function(fileName) {
    return fileName.includes('.') ? fileName.split('.').pop() : '';
}

const setContentTypeByExt = function(ext = '') {
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
            contentType['Content-Type'] = 'text/plain'
            break;
        case '':
            contentType['Content-Type'] = 'text/plain'
            break;
    }

    return contentType;
}

http.createServer(function(request, response) {
    console.log(request.url);
    
    if (request.url === '/' || request.url === '/index.html' || request.url === '/index') {
        generateFeedback('index.html', response);
    }
    else if (request.url === '/script.js') {
        generateFeedback('script.js', response);
    }
    else if (request.url === '/sample') {
        generateFeedback('data/sample.txt', response);
    }
    else if (request.url === '/user') {
        generateFeedback('data/user.json', response);
    }
    else if (request.url === '/users') {
        generateFeedback('data/users.json', response);
    }
    else {
        response.writeHead(404, setContentTypeByExt());
        response.end('Page not found.');
    }    
}).listen(8080, () => console.log('Listening on port 8080.'));