// скрипт-посредник, кот. обрабатывает файлы в rotes.json

var routes = require('./routes');

///route('home', ['1'])
export default function() {
    var args = Array.prototype.slice.call(arguments);
    var name = args.shift();

    if(routes[name] === undefined) {
        console.log('Error');
    }
    else {
        // return '/' + 
        //     routes[name]
        //     .split('/')
        //     .map(function(str) {
        //         if(str[0] == '{') {
        //             return args.shift();
        //         }
        //         else {
        //             return str;
        //         }
        //     })
        //     .join('/');

        // лучше использовать стрелочную ф-цию
        return '/' + 
            routes[name]
            .split('/')
            .map(str => str[0] == '{' ? args.shift() : str)
            .join('/');
    }
}