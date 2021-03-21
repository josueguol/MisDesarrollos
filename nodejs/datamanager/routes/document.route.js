const express = require('express');
const router = express.Router();
const document_controller = require('../controllers/document.controller');


router.get('/documents', document_controller.document_all);
router.get('/document/:id', document_controller.document_details);
router.post('/create', document_controller.document_create);
router.put('/update/:id', document_controller.document_update);
router.delete('/delete/:id', document_controller.document_delete);

module.exports = router;