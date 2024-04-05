
var socialMediaFooter = document.createElement("div");
        socialMediaFooter.className = "social-icons";
        socialMediaFooter.innerHTML = 
            '<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>' +
            '<li><a href="#"><i class="fab fa-twitter"></i></a></li>' +
            '<li><a href="#"><i class="fab fa-instagram"></i></a></li>' +
            '<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>';
        
        var footerElement = document.getElementById("Footer");
        footerElement.appendChild(socialMediaFooter);

        footerElement.innerHTML +=
            '<p>&copy; ' + new Date().getFullYear() + ' Our Website. All rights reserved.</p>' +
            '<p id="credits">Layout by our 3 person</p>' +
            '<p id="contact"><a href="mailto:you@you.com">Contact Us</a> / ' +
            '<a href="mailto:you@you.com">Report a problem.</a></p>' +
            '<div id="poll">' +
            '<p>Do you like our page?</p>' +
            '<form>' +
            'Yes: <input type="radio" name="vote" value="0" onclick="getVote(this.value)"><br>' +
            'No: <input type="radio" name="vote" value="1" onclick="getVote(this.value)">' +
            '</form>' +
            '</div>';
        