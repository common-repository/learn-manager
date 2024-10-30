(function() {
    tinymce.PluginManager.add('jslm_gavickpro_tc_button', function( editor, url ) {
        editor.addButton( 'jslm_gavickpro_tc_button', {
            text: 'My test button',
            icon: false,
            onclick: function() {
                editor.insertContent('Hello World!');
            }
        });
    });
})();