var mysql = require('../models/mysql').getConnection()

var participants = {};

participants.getByName = function(name, callback) {
	mysql.query('SELECT * FROM `participants` WHERE `name` = ?', name, callback);
}

participants.get = function(id, callback) {
	mysql.query('SELECT * FROM `participants` WHERE `id` = ?', id, callback);
}

module.exports = participants;
