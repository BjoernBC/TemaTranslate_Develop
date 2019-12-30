function browserHotkeys() {
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

            });
        }
    );
}
