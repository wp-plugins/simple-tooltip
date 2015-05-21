(function() {
    tinymce.PluginManager.add('wptp_simple_tooltip_button', function(editor, url) {
        editor.addButton('wptp_simple_tooltip_button', {
            text:  'Simple Tooltip',
            title: 'Add simple tooltip shortcode',
            icon: false,
            onclick: function() {
                editor.insertContent('[simple_tooltip text="" tooltip="" url="" background="" color=""]');
            }
        });
    });
})();