class editorForm {

    static initEditor() {
        ClassicEditor
            .create(document.querySelector('#js-ckeditor'))
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error('There was a problem initializing the classic editor.', error);
            });

    }

    static init(){
        this.initEditor();
    }

}
Codebase.onLoad(editorForm.init());
