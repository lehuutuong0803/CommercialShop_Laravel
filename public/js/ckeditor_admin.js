function Editing(){}

Editing.prototype.init = function (){
    this.addCkeditor();
}
Editing.prototype.addCkeditor = function (){
    $('.ckeditor-box').each(function (index, item){
         CKEDITOR.replace($(item).attr('id'));
        // CKFinder.setupCKEditor(editor);
    })
}

window.EditingController = new Editing();
EditingController.init();
