<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location:http://shop.test/not_found_page.php'));
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Fotter</title>
    <style>
        ul li {
            color: gray;
        }

        .comeback-top {
            width: auto;
            border: solid gray 1px;
            border-radius: 5px;
            padding: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .acounts i {
            font-size: 30px;
            color: gray;
        }

        #data {
            max-height: 50px;
            /* initial height of the p tag */
            overflow: hidden;
            /* hide overflow content */
            transition: max-height 0.5s ease-in-out;
            /* animate the transition */
        }

        .toggle-btn {
            /* green background */
            border: solid gray 1px;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px 0;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            /* animate the transition */
            border-radius: 5px;
            background-color: #EE4055;
            color: white;
            outline: none;
        }
    </style>
</head>

<body>
    <hr>
    <div class="footer">
        <div class="container-fluid" style="width: 90%;">

            <div class="row" style="margin-top: 25px;">
                <div class="logo" style="float: left;">

                </div>

                <div class="comeback-top" style="color:gray;">
                    Top <i class='bx bxs-arrow-to-top'></i>
                </div>




            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="col"><img src="./images/express-delivery.svg" alt="">
                    <div style="font-size: 15px;">Express delivery</div>
                </div>

                <div class="col"> <img src="./images/support.svg" alt="">
                    <div style="font-size: 15px;">Support</div>
                </div>

                <div class="col"> <img src="./images/days-return.svg" alt="">
                    <div style="font-size: 15px;">7 day return </div>
                </div>

                <div class="col"> <img src="./images/cash-on-delivery.svg" alt="">
                    <div style="font-size: 15px;">Cas-on-delivery</div>
                </div>

                <div class="col"> <img src="./images/original-products.svg" alt="">
                    <div style="font-size: 15px;">Original-products</div>
                </div>

            </div>

            <br>
            <br>


            <div class="row" style="margin-top: 20px;">
                <div class="col">
                    <h3>With shopie</h3>
                    <ul>
                        <li>News</li>
                        <li>Return</li>
                        <li>Sell products </li>
                        <li> break law report </li>
                        <li> Call </li>
                        <li> About us </li>

                    </ul>
                </div>
                <div class="col">
                    <h3>Services</h3>
                    <ul>
                        <li>Answer to Questions </li>
                        <li>Return policy </li>
                        <li>Private</li>
                        <li>Report bug </li>
                        <li>Use rules </li>



                    </ul>
                </div>
                <div class="col">
                    <h3>Price rules</h3>
                    <ul>
                        <li>How to buy </li>
                        <li>How to pay </li>
                        <li>How is the send method </li>
                    </ul>
                </div>
                <div class="col">
                    <h3>Be with Us ! </h3>
                    <div class="row mt-3  acounts">
                        <div class="col"><i class='bx bxl-instagram'></i></div>
                        <div class="col"><i class='bx bxl-twitter'></i></div>
                        <div class="col"><i class='bx bxl-linkedin'></i></div>
                        <div class="col"><i class='bx bxl-meta'></i></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <hr>

    <div class="discuss container-fluid" style="width:90%">
        <div class="row">

            <h3>Revolutionize Your Shopping Experience </h3>
            <div id="container">

                <p id="data" style="padding: 10px;">
                    Your eCommerce website is a platform where customers can easily purchase products online. It offers a wide range of products in different categories, from clothing and accessories to home appliances and electronics. The website has a user-friendly interface that allows customers to browse products, compare prices, and make purchases with ease.
                    One of the key features of your eCommerce website is its secure payment system. Customers can make payments using various payment methods, including credit cards, debit cards, and online payment platforms. The website uses the latest encryption technology to protect customers' personal and financial information, ensuring safe and secure transactions.
                    Another great feature of your eCommerce website is its fast and reliable shipping. Customers can choose from different shipping options, including standard shipping, express shipping, and same-day delivery. The website also provides customers with real-time tracking information, so they can keep track of their orders every step of the way.
                    Your eCommerce website also offers excellent customer service. Customers can contact the website's support team via phone, email, or live chat, and receive quick and helpful responses to their queries. The website also has a comprehensive FAQ section that provides customers with answers to common questions.
                    In summary, your eCommerce website is a fantastic platform that offers a wide range of products, secure payment options, fast and reliable shipping, and excellent customer service. With all these great features, it's no wonder that your website is a popular choice among customers!
                    Certainly! In addition to the features I mentioned earlier, your eCommerce website has many other great features that make it stand out from the competition.
                    One of these features is its personalized shopping experience. Your website uses customer data and browsing history to recommend products that are tailored to each customer's unique interests and preferences. This feature helps to increase customer satisfaction and loyalty, as customers feel that the website understands their needs and is providing them with personalized recommendations.
                </p>
            </div>


        </div>
        <button id="toggle-btn" class="toggle-btn">Show More</button>

    </div>
    <hr>
    <br>

    <script src="./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script src="./bootstrap-4.3.1-dist//js/bootstrap.min.js"></script>
    <script>
        $(" .comeback-top").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
        })
    </script>

    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const data = document.getElementById('data');
        let isToggled = false;

        toggleBtn.addEventListener('click', function() {
            if (isToggled) {
                data.style.maxHeight = '50px'; /* reset the max-height to initial value */
                toggleBtn.textContent = 'Show More';
                isToggled = false;
            } else {
                const height = data.scrollHeight;
                data.style.maxHeight = height + 'px'; /* set the max-height to the height of the content */
                toggleBtn.textContent = 'Show Less';
                isToggled = true;
            }
        });
    </script>



</body>

</html>