const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const document = require('./routes/document.route');
const content = require('./routes/content.route');
const template = require('./routes/template.route');

const app = express();

let db_url = 'mongodb://127.0.0.1:27017/mcms';
let mongoDB = process.env.MONGODB_URI || db_url;
mongoose.connect(mongoDB);
mongoose.Promise = global.Promise;
let db = mongoose.connection;
db.on('error', console.error.bind(console, 'MongoDB connection error:'));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(
    '/documentos', document,
    '/contenido', content,
    '/plantillas', template
    );

let port = 1721;

app.listen(port, () => {
    console.log('Servidor corriendo en el puerto ' + port);
});