// 3 routes: os, cpu, ram

const express = require('express');
const app = express();
const os = require('node:os');

app
.get('/', function(req, res) {
    let routeStack = app._router.stack;
    let resContent = '';

    for (const key in routeStack) {
        if (routeStack[key].route && routeStack[key].route.path) {
            let path = routeStack[key].route.path;
            
            resContent += `<p><a href="${path}">${path}</a></p>`;
        }
    }

    res.send(resContent);
})
.get('/cpu', function(req, res) {
    let cpu = {
        model: os.cpus()[0].model,
        cores: os.cpus().length,
    };

    res.send(JSON.stringify(cpu));
})
.get('/ram', function(req, res) {
    let ram = {
        bytes: os.totalmem(),
        GB: os.totalmem() / (1E9),
    };

    res.send(JSON.stringify(ram));
})
.get('/os', function(req, res) {
    let opSys = {
        platform: os.platform(),
        release: os.release(),
    };

    res.send(JSON.stringify(opSys));
});

app.listen(3000, () => console.log('Server started on port 3000.'));