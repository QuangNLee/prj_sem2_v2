    </div>
    <div class="footer">
        <div class="wrap">
            <div class="section group">
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Customer Service</a></li>
                        <li><a href="#">Advanced Search</a></li>
                        <li><a href="delivery.html">Orders and Returns</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Why buy from us</h4>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Customer Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="contact.html">Site Map</a></li>
                        <li><a href="#">Search Terms</a></li>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>My account</h4>
                    <ul>
                        <li><a href="contact.html">Sign In</a></li>
                        <li><a href="index.php">View Cart</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="contact.html">Help</a></li>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Contact</h4>
                    <ul>
                        <li><span>+91-123-456789</span></li>
                        <li><span>+00-123-000000</span></li>
                    </ul>
                    <div class="social-icons">
                        <h4>Follow Us</h4>
                        <ul>
                            <li><a href="#" target="_blank"><img src="images/facebook.png" alt="" /></a></li>
                            <li><a href="#" target="_blank"><img src="images/twitter.png" alt="" /></a></li>
                            <li><a href="#" target="_blank"><img src="images/skype.png" alt="" /> </a></li>
                            <li><a href="#" target="_blank"> <img src="images/dribbble.png" alt="" /></a></li>
                            <li><a href="#" target="_blank"> <img src="images/linkedin.png" alt="" /></a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy_right">
            <p>&copy; 2022 Online Store BD. All rights reserved</p>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });

        });
    </script>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
    <script defer src="js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(function () {
            SyntaxHighlighter.all();
        });
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function (slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
    <script src="https://www.paypal.com/sdk/js?client-id=AZEw-eMCu_sL-u54VXzexgK5zHVbh0tPLwIApSjYZ_Y17zAHVu5qD5Xcfa5iLxgtXswb9fabnj708P1S&currency=USD"></script>
    <script>
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color: 'blue',
                shape: 'rect',
                label: 'paypal'
            },
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                $priceGTotal = document.getElementById('priceUSD').value;
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: $priceGTotal // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    window.location.replace('http://localhost:8088/prj_sem2/onlinePaymentBill.php?onlinepayment=success&gate=paypal');
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            },
            onCancel:function (data) {
                window.location.replace('http://localhost:8088/prj_sem2/onlinepayment.php');
            }
        }).render('#paypal-button-container');
    </script>
    <script type="text/javascript" src="js/modal.js"></script>
</body>
</html>

