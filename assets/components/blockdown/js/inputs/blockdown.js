// Wrap your stuff in this module pattern for dependency injection
(function ($, ContentBlocks) {
    // Add your custom input to the fieldTypes object as a function
    // The dom variable contains the injected field (from the template)
    // and the data variable contains field information, properties etc.
    ContentBlocks.fieldTypes.blockdown = function(dom, data) {
        var input = {
            // Some optional variables can be defined here
        };
        
        // Do something when the input is being loaded
        input.init = function() {
            setTimeout(function(){
                var theme = {editor:undefined, preview:undefined};
                if(data.properties.theme_editor) theme.editor = data.properties.theme_editor;
                if(data.properties.theme_preview) theme.preview = data.properties.theme_preview;
                var editor = new EpicEditor({
                    container:data.generated_id + '_epiceditor',
                    textarea:data.generated_id + '_textarea',
                    basePath:ContentBlocksBlockDown.assetsUrl + 'js/vendor/epiceditor/',
                    theme:theme,
                    focusOnLoad:true,
                    autoSave:false,
                    localStorageName:data.generated_id
                }).load(function(){
                    $(document.getElementById(data.generated_id + '_textarea')).hide();
                });
            },1); // #janky, no idea why this delay is necessary
        }
        
        // Get the data from this input, it has to be a simple object.
        input.getData = function() {
            return {
                value: $(document.getElementById(data.generated_id + '_textarea')).val()
            }
        }
        
        // Always return the input variable.
        return input;
    }
})(vcJquery, ContentBlocks);