var os = require('os');
function getMyIP(version,internal){
  version = version || 'IPv4';
  internal = internal || false;
  var interfaces = os.networkInterfaces();
  for(var key in interfaces){
    var addresses = interfaces[key];
    for(var i = 0; i < addresses.length; i++){
      var address = addresses[i];
      if(address.internal === internal && address.family === version){
        return address.address;
      };
    };
  };
  return 'localhost'
};

if(!module.parent){
  version = 'IPv4';
  internal = false;
  var argv = process.argv;
  var length = argv.length;
  if(length >= 3){
    for(var i = 2; i < length; i++){
      switch(argv[i]){
        case '--version6':
        case '-v6':
          version = 'IPv6'
          break;
        case '--internal':
        case '-i':
          internal = true;
          break;
      };
    };
  };
  console.log(getMyIP(version,internal));
}else{
  module.exports = getMyIP;
};
