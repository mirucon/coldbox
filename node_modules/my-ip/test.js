myIP = require('./');
console.dir(myIP());// return external IPv4
console.dir(myIP('IPv6'));// return external IPv6
console.dir(myIP(null,true));// return internal IPv4
console.dir(myIP('IPv6',true));// return internal IPv6