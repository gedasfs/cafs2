/* Parašykite NodeJS programą, kuri iš komandinės eilutės priims 2 parametrus:
1) failo pavadinimas
2) failo turinys
O tada sukur tokį failą ir įdės ten turinį.

P.S.
https://nodejs.org/en/knowledge/command-line/how-to-parse-command-line-arguments/
*/

const fs = require('fs');

const myArgs = process.argv.slice(2);
const fileName = myArgs[0];
const fileContent = myArgs[1];

if (fileName && fileContent) {
    fs.appendFile(fileName, fileContent, (err) => {
        if (err) {
            console.log(err);
        }
        console.log('The file has been saved.');
    });
} else {
    console.log('Missing parameters.', myArgs)
}