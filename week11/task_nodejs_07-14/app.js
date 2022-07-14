/* Parašykite NodeJS programą, kuri iš komandinės eilutės priims 2 parametrus:
1) failo pavadinimas
2) failo turinys
O tada sukur tokį failą ir įdės ten turinį.

P.S.
https://nodejs.org/en/knowledge/command-line/how-to-parse-command-line-arguments/
*/

const fs = require('node:fs');
const yargs = require('yargs');

const argv = yargs
    .usage('$0 <command> [options]')
    .example('$0 cf -f filename.js -c "file content"')
    .example('$0 cf --filename filename.js --content "file content"')
    .command('cf', 'Creates a file with given name and file content.')
    .alias('v', 'version')
    .alias('h', 'help')
    .alias('f', 'filename')
    .alias('c', 'content')
    .describe('f', 'File name (i.e. name.js)')
    .describe('c', 'The content to write to file')
    .demandOption(['f','c'])
    .help().argv;
    


if (argv._.includes('cf')) {
    const fileName = argv.filename;
    const fileContent = argv.content;
    
    fs.writeFile(fileName, fileContent, (err) => {
        if (err) {
            throw err;
        }
        console.log('The file has been saved.');
    });
}

console.log(argv);

