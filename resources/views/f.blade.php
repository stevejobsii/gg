
<style type="text/css">
	#header {
    background: #c2c2c2;
    height: 50px;
}

#wrapper {
    position: relative;
    width: 500px;
}

#left {
    background: #d7d7d7;
    position: absolute; /* IMPORTANT! */
    width: 150px;
    height: 100%;
}

#right {
    position: relative;
    width: 350px;
    float: right;
}

#sidebar {
    background: #0096d7;
    width: 150px;
    color: #fff;
}

.clear {
    clear: both;
}

#footer {
    background: #c2c2c2;
}
</style>
<div id="header">Header</div>

<div id="wrapper">

	<div id="left">

		<div id="sidebar">

			Sidebar Content

		</div>

	</div>

	<div id="right">

		This is the text of the main part of the page.

	</div>

	<div class="clear"></div>

</div>

<div id="footer">Footer</div>
<script src="/js/all.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

    var length = $('#left').height() - $('#sidebar').height() + $('#left').offset().top;

    $(window).scroll(function () {

        var scroll = $(this).scrollTop();
        var height = $('#sidebar').height() + 'px';

        if (scroll < $('#left').offset().top) {

            $('#sidebar').css({
                'position': 'absolute',
                'top': '0'
            });

        } else if (scroll > length) {

            $('#sidebar').css({
                'position': 'absolute',
                'bottom': '0',
                'top': 'auto'
            });

        } else {

            $('#sidebar').css({
                'position': 'fixed',
                'top': '0',
                'height': height
            });
        }
    });
});
</script>


