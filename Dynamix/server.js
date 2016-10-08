/* Load HTTP library */
var http = require("http");

/* Create HTTP server to handle responses */
http.createServer(function(request, response) {
	response.writeHead(200, {"Content-Type": "text/plain"});
	response.write("Online.");
	response.end();
}).listen(8888);