## Usage

```javascript
myIP = require('my-ip');
console.dir(myIP());// return external IPv4
console.dir(myIP('IPv6'));// return external IPv6
console.dir(myIP(null,true));// return internal IPv4
console.dir(myIP('IPv6',true));// return internal IPv6
```

or

```
node my-ip
node my-ip -v6
node my-ip -i
node my-ip -v6 -i
```