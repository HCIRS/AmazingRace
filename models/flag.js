var mysql = require('../models/mysql').getConnection()

var flag = {};

flag.getFlag = function(name, callback) {
	mysql.query('SELECT * FROM `flags` WHERE `name` = ?', name, callback);
}


module.exports = flag;
