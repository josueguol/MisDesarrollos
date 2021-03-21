const mongose = require('mongoose');
const Schema = mongose.Schema;

let ProductSchema = new Schema({
    name: { type: String, required: true, max: 100 },
    price: { type: Number, required: true }
});

module.exports = mongose.model('Product', ProductSchema);