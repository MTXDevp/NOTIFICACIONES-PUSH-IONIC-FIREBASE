admin = require('firebase-admin');

module.exports = class pushService
{
	constructor(mobileTokens, titulo, body)
	{
	var serviceAccount = require("./ionicpushnotifire-firebase-adminsdk-qrag1-c708400f16.json");
	//posiblemente sea necesario sepàrar ,la conexion a un script aparte
	admin.initializeApp({
	credential : admin.credential.cert(serviceAccount),
	});

		var message   = {
			notification : {
			title : titulo,
			body : body},
			token : mobileTokens
			};//final mensaje

		admin.messaging().send(message)
  		.then((response) => {
  		console.log('Notificacion enviada con exito:', response);
  		}).catch((error) => {
  		console.log('ERROR:', error);
  		})
	}//final constructor
}
