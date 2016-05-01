var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'infocommsociety.com',
  user     : 'ar2016',
  password : 'ar2016',
  database : 'ar2016'
});

var mysqldb = {};

mysqldb.connect = function() {
	connection.connect();
}

mysqldb.getConnection = function() {
	return connection;
}

module.exports = mysqldb;
