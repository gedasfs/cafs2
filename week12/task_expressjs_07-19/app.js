// 3 routes: os, cpu, ram

const express = require('express');
const app = express();
const os = require('node:os');

app
.get('/cpu', function(req, res) {
    let cpu = {
        model: os.cpus()[0].model,
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
        version: os.release(),
    };
    res.send(JSON.stringify(opSys));
});

app.listen(3000, () => console.log('Server started on port 3000.'));