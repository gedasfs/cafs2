const fs = require('fs');
const yargs = require('yargs');

const argv = yargs
    .usage('$0 <command> [options]')
    .example('$0 cf -f filename.js -c "file content"')
    .example('$0 cf --filename filename.js --content "file content"')
    .command('cf', 'Creates a file with given name and file content.')
    .option('filename', {
        alias: 'f',
        describe: 'File name (i.e. name.js)'
    })
    .option('content', {
        alias: 'c',
        describe: 'The content to write to file'
    })
    .alias('v', 'version')
    .alias('h', 'help')
    .demandOption(['f','c'])
    .help()
    .version(false)
    .argv;
    


if (argv._.includes('cf')) {
    const fileName = argv.filename;
    const fileContent = argv.content;
    
    fs.appendFile(fileName, fileContent, (err) => {
        if (err) {
            throw err;
        }
        console.log('The file has been saved.');
    });
}

console.log(argv);