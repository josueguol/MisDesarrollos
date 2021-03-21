const mongoose = require('mongoose');
const Schema = mongoose.Schema;

let Element = {
    etiqueta: {type: String, required: true, max: 64 },
    longitud: {type: Number, required: true, default: 0 },
    obligatorio: {type: Boolean, required: true, default: false },
    visible: {type: Boolean, required: true, default: true },
    control: {type: String, required: true, max: 128 },
    validacion: {type: String, required: true, max: 254 },
    llave: {type: String, required: true, default: false }
};

let DocumentSchema = new Schema({
    nombre: { type: String, required: true, max: 150 },
    alias: { type: String, required: true , max: 64 },
    visible: { type: Boolean, required: true, default: false },
    elementos: [Element]
});

module.exports = mongoose.model('Document', DocumentSchema);