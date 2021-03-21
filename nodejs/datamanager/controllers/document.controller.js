const Document = require('../models/document.model');

exports.document = function(req, res) {
    res.send('Greetings froms the Test Controller!');
};

exports.document_all = function (req, res) {
    Document.find(function (err, document) {
        if (err) return next(err);
        res.send(document);
    })
};

exports.document_details = function (req, res) {
    Document.findById(req.params.id, function (err, document) {
        if (err) return next(err);
        res.send(document);
    })
};

exports.document_create = function (req, res) {
    let document = new Document(
        {
            name: req.body.name,
            price: req.body.price
        }
    );

    document.save(function (err) {
        if (err) {
            return next(err);
        }
        res.send('Document Created successfully')
    })
};

exports.document_update = function (req, res) {
    Document.findByIdAndUpdate(req.params.id, {$set: req.body}, function (err, product) {
        if (err) return next(err);
        res.send('Document udpated.');
    });
};

exports.document_delete = function (req, res) {
    Document.findByIdAndRemove(req.params.id, function (err) {
        if (err) return next(err);
        res.send('document deleted successfully!');
    })
};