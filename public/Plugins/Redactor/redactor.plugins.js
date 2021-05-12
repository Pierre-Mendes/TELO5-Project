if (!RedactorPlugins) var RedactorPlugins = {};
 
// Botões : Undo e Redo
RedactorPlugins.bufferbuttons = function()
{
    return {
        init: function()
        {
            var undo = this.button.addFirst('undo', 'Undo');
            var redo = this.button.addAfter('undo', 'redo', 'Redo');
 
            this.button.addCallback(undo, this.buffer.undo);
            this.button.addCallback(redo, this.buffer.redo);
        }
    };
};


// Botões : Sub e Sup
RedactorPlugins.scriptbuttons = function()
{
    return {
        init: function()
        {
            var sup = this.button.add('superscript', 'Superscript');
            var sub = this.button.add('subscript', 'Subscript');
 
            // make your added buttons as Font Awesome's icon
            this.button.setAwesome('superscript', 'fa-superscript');
            this.button.setAwesome('subscript', 'fa-subscript');
 
            this.button.addCallback(sup, this.scriptbuttons.formatSup);
            this.button.addCallback(sub, this.scriptbuttons.formatSub);
        },
        formatSup: function()
        {
            this.inline.format('sup');
        },
        formatSub: function()
        {
            this.inline.format('sub');
        }
    };
};