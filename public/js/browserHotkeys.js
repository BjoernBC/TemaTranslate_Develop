function browserHotkeys() {
    var i = 0;
    $(window).keydown(
        function(e){
            // Save with ctrl + S
            if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
                e.preventDefault();
            }
            Mousetrap.bind('ctrl+s', function() {
                $('#save').click();
            });
            // Skip with ctrl + J
            if(e.ctrlKey && e.keyCode == 'J'.charCodeAt(0)){
                e.preventDefault();
            }
            Mousetrap.bind('ctrl+j', function() {
                $('#skip')[0].click();
            });

            // Loop with tab
            var inputs = $('.mousetrap');

            if(e.which == 9){
                e.preventDefault();
            }

            Mousetrap.bind('tab', function() {
                if (i >= inputs.length - 1) {
                    i = 0;
                } else {
                    i = i + 1;
                }
                inputs[i].focus();
            });

            // Reverse
            if(e.shiftKey && e.which == 9){
                e.preventDefault();
            }
            Mousetrap.bind('shift+tab', function() {
                if (i < 1) {
                    i = inputs.length - 1;
                } else {
                    i = i - 1;
                }
                inputs[i].focus();
            });
        }
    );
}
