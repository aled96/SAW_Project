<!-- FOOTER -->
<script>
function fb(){
	document.getElementById("fb").style.color = "cornflowerblue";
}

function twitter(){
	document.getElementById("tw").style.color = "darkturquoise";
}

function link(){
	document.getElementById("li").style.color = "deepskyblue";
}
function email(){
	document.getElementById("em").style.color = "goldenrod";
}

function exit(id){
	document.getElementById(id).style.color = "white";
}
</script>

    <section id="footer">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-xs-6 copyright">© 2018 Lapolla Marco, De Luca Alessio - Rights Reserved </div>
                        <div class="col-xs-6 footer-icon">
                            <i class="fa fa-2x fa-facebook-square" id="fb" onmouseover="fb();" onmouseout="exit('fb');"></i>
                            <i class="fa fa-2x fa-twitter-square" id="tw" onmouseover="twitter();" onmouseout="exit('tw');"></i>
                            <i class="fa fa-2x fa-linkedin-square" id="li" onmouseover="link();" onmouseout="exit('li');"></i>
                            <i class="fa fa-2x fa-envelope-o" id="em" onmouseover="email();" onmouseout="exit('em');"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
	if(isset($conn) and mysqli_ping($conn))
		$conn->close();
?>