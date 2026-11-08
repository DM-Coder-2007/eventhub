<?php
session_start();
include("config/db.php");

// If the user is not logged in, redirect them to the public landing page
if(!isset($_SESSION['user_id'])){
    header("Location: first.php");
    exit();
}

if (isset($_POST['contact_btn'])) {

    $name = htmlspecialchars($_POST['user_name']);
    $email = htmlspecialchars($_POST['user_email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // write an INSERT query to save this to your database.

    echo "<script>alert('Thank you, $name! Your message regarding \"$subject\" has been received.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manage</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav id="nav">
        <div class="calendar-icon-wrapper">
            <!-- Calendar -->
            <svg class="calendar-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <h3 id="hne">EventHub</h3>
        <h3 id="hn1" class="text-gradient1" onclick="window.location.href='index.php'">Home</h3>
        <h3 id="hn2" onclick="window.location.href='eventcat.php'">Event Catalog</h3>
        <h3 id="hn3" onclick="window.location.href='eventbook.php'">Event Booking</h3>
        <h3 id="hn5" onclick="window.location.href='mybook.php'">My bookings</h3>
        <h3 id="hn4" onclick="document.getElementById('Contact').scrollIntoView({behavior:'smooth'})">Contact Us</h3>
    </nav>
    <!-- Pg1 -->
    <div id="pg1">
        <div id="d">
            <h4 id="hp1">DISCOVER FEATURED LIVE AND VIRTUAL EVENTS</h4>
        </div>
        <h1 id="h1">Discover, Experience & Book<br />Unforgettable <span class="text-gradient">Live Events</span></h1>
        <h3 id="h1_1">Your single platform for tech summits, music festivals, design masterclasses, and startup
            pitch<br />nights. Streamline your scheduling, attendee check-ins, and ticketing sales.</h3>
        <div id="d1">
            <input type="text" id="in1" placeholder="Search event,title,venue or keyword...">
            <button id="btn1" onclick="window.location.href='eventcat.php'">
                Explore Catalog</button>
            <i class="fa-solid fa-arrow-right" style="position: relative;top:23px;left:-17px;margin-left: -2px;"></i>
        </div>
        <div id="d1_1">
            <button id="btn1_1" onclick="window.location.href='eventcat.php'">All Events</button>
            <button id="btn1_2" onclick="window.location.href='eventcat.php'">Technology</button>
            <button id="btn1_3" onclick="window.location.href='eventcat.php'">Music & Concerts</button>
            <button id="btn1_4" onclick="window.location.href='eventcat.php'">Design & Craft</button>
            <button id="btn1_5" onclick="window.location.href='eventcat.php'">Business</button>
            <button id="btn1_6" onclick="window.location.href='eventcat.php'">Food & Beverage</button>
        </div>
    </div>

    <!-- Page 2 -->
    <div id="pg2">
        <div id="d2">
            <div id="d2_1">
                <h1 id="h2">500+</h1>
                <h3 id="h2_1">Events hosted annualy</h3>
            </div>
            <div id="d2_1">
                <h1 id="h2">120K+</h1>
                <h3 id="h2_1">Happy Attendees</h3>
            </div>
            <div id="d2_1">
                <h1 id="h2">99.8%</h1>
                <h3 id="h2_1">Instant QR Ticket Generation</h3>
            </div>
            <div id="d2_1">
                <h1 id="h2">4.9/5</h1>
                <h3 id="h2_1">Organizer Rating</h3>
            </div>
        </div>
    </div>

    <!-- Page 3 -->
    <div id="pg3">
        <h4 id="h3">TRENDING & UPCOMING</h4>
        <h1 id="h3_1">Featured Event Listing Layout</h1>
        <h4 id="h3_2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h4>
        <button id="btn3" onclick="window.location.href='eventcat.php'">Browse all events <i
                class="fa-solid fa-arrow-right" style="position: relative;left:2px"></i></button>

        <div id="d3">
            <div id="d3_1">
                <div id="d3_2">
                    <img src="media/img1.png" alt="" id="img3">
                    <div id="d33">
                        <h3 id="h3_3">Technology</h3>
                    </div>
                </div>
                <h4 id="h3_5"><i class="fa-regular fa-calendar" style="color:oklch(67.3% 0.182 276.935)"></i> <span
                        id="sp3">August 24,2026 </span> • <i class="fa-regular fa-clock"></i> 06:00 PM</h4>
                <h3 id="h3_6">Future Tech & AI Summit 2026</h3>
                <h4 id="h3_7">Join top leaders, AI engineers, and visionary<br /> tech entrepreneurs as we explore
                    Next-Gen Generative AI,...</h4>
                <div id="d3_4"></div>
                <h4 id="h3_8">&#xf3c5; San Francisco, CA <span id="sp3_1">0 seats left</span></h4>
                <button id="btnn" onclick="window.location.href='eventcat.php'">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                        </path>
                    </svg>
                    <span id="spb">Book Ticket & Details</span></button>
            </div>

            <div id="d3_1">
                <div id="d3_2">
                    <img src="media/business.png" alt="" id="img3">
                    <div id="d33">
                        <h3 id="h3_3">Technology</h3>
                    </div>
                </div>
                <h4 id="h3_5"><i class="fa-regular fa-calendar" style="color:oklch(67.3% 0.182 276.935)"></i> <span
                        id="sp3">Novembeer 18,2026 </span> • <i class="fa-regular fa-clock"></i> 06:00 PM</h4>
                <h3 id="h3_6">Startup Pitch & Founder Investment...</h3>
                <h4 id="h3_7">Watch 12 promising early-stage startups pitch live to top <br />seed venture capitalists
                    and angel investor networks.</h4>
                <div id="d3_4"></div>
                <h4 id="h3_8">&#xf3c5; Boston,MA <span id="sp3_1">0 seats left</span></h4>
                <button id="btnn" onclick="window.location.href='eventcat.php'">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                        </path>
                    </svg>
                    <span id="spb">Book Ticket & Details</span></button>
            </div>

            <div id="d3_1">
                <div id="d3_2">
                    <img src="media/concert.png" alt="" id="img3">
                    <div id="d33">
                        <h3 id="h3_3">Technology</h3>
                    </div>
                </div>
                <h4 id="h3_5"><i class="fa-regular fa-calendar" style="color:oklch(67.3% 0.182 276.935)"></i> <span
                        id="sp3">Novembeer 18,2026 </span> • <i class="fa-regular fa-clock"></i> 06:00 PM</h4>
                <h3 id="h3_6">Startup Pitch & Founder Investment...</h3>
                <h4 id="h3_7">Watch 12 promising early-stage startups pitch live to top <br />seed venture capitalists
                    and angel investor networks.</h4>
                <div id="d3_4"></div>
                <h4 id="h3_8">&#xf3c5; Boston,MA <span id="sp3_1">0 seats left</span></h4>
                <button id="btnn" onclick="window.location.href='eventcat.php'">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                        </path>
                    </svg>
                    <span id="spb">Book Ticket & Details</span></button>
            </div>
        </div>

        <div id="d34">
            <div id="d3_1">
                <div id="d3_2">
                    <img src="media/design.png" alt="" id="img3">
                    <div id="d33">
                        <h3 id="h3_3">Technology</h3>
                    </div>
                </div>
                <h4 id="h3_5"><i class="fa-regular fa-calendar" style="color:oklch(67.3% 0.182 276.935)"></i> <span
                        id="sp3">Novembeer 18,2026 </span> • <i class="fa-regular fa-clock"></i> 06:00 PM</h4>
                <h3 id="h3_6">Startup Pitch & Founder Investment...</h3>
                <h4 id="h3_7">Watch 12 promising early-stage startups pitch live to top <br />seed venture capitalists
                    and angel investor networks.</h4>
                <div id="d3_4"></div>
                <h4 id="h3_8">&#xf3c5; Boston,MA <span id="sp3_1">0 seats left</span></h4>
                <button id="btnn" onclick="window.location.href='eventcat.php'">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                        </path>
                    </svg>
                    <span id="spb">Book Ticket & Details</span></button>
            </div>

            <div id="d3_1">
                <div id="d3_2">
                    <img src="media/food.png" alt="" id="img3">
                    <div id="d33">
                        <h3 id="h3_3">Technology</h3>
                    </div>
                </div>
                <h4 id="h3_5"><i class="fa-regular fa-calendar" style="color:oklch(67.3% 0.182 276.935)"></i> <span
                        id="sp3">Novembeer 18,2026 </span> • <i class="fa-regular fa-clock"></i> 06:00 PM</h4>
                <h3 id="h3_6">Startup Pitch & Founder Investment...</h3>
                <h4 id="h3_7">Watch 12 promising early-stage startups pitch live to top <br />seed venture capitalists
                    and angel investor networks.</h4>
                <div id="d3_4"></div>
                <h4 id="h3_8">&#xf3c5; Boston,MA <span id="sp3_1">0 seats left</span></h4>
                <button id="btnn" onclick="window.location.href='eventcat.php'">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                        </path>
                    </svg>
                    <span id="spb">Book Ticket & Details</span></button>
            </div>

            <div id="d3_1">
                <div id="d3_2">
                    <img src="media/cyber.png" alt="" id="img3">
                    <div id="d33">
                        <h3 id="h3_3">Technology</h3>
                    </div>
                </div>
                <h4 id="h3_5"><i class="fa-regular fa-calendar" style="color:oklch(67.3% 0.182 276.935)"></i> <span
                        id="sp3">Novembeer 18,2026 </span> • <i class="fa-regular fa-clock"></i> 06:00 PM</h4>
                <h3 id="h3_6">Startup Pitch & Founder Investment...</h3>
                <h4 id="h3_7">Watch 12 promising early-stage startups pitch live to top <br />seed venture capitalists
                    and angel investor networks.</h4>
                <div id="d3_4"></div>
                <h4 id="h3_8">&#xf3c5; Boston,MA <span id="sp3_1">0 seats left</span></h4>
                <button id="btnn" onclick="window.location.href='eventcat.php'">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15 5.25h1.5a2.25 2.25 0 012.25 2.25v2.062c0 .546.33 1.033.829 1.229l.17.067a1.5 1.5 0 010 2.796l-.17.067a1.353 1.353 0 00-.829 1.229v2.062a2.25 2.25 0 01-2.25 2.25H15M9 5.25H7.5a2.25 2.25 0 00-2.25 2.25v2.062c0 .546-.33 1.033-.829 1.229l-.17.067a1.5 1.5 0 000 2.796l.17.067c.498.196.829.683.829 1.229v2.062a2.25 2.25 0 002.25 2.25H9m-3-12h12m-12 12h12m-6-10.5v9">
                        </path>
                    </svg>
                    <span id="spb">Book Ticket & Details</span></button>
            </div>
        </div>
    </div>

    <!-- SYSTEM FEATURES OVERVIEW SECTION -->
    <div id="features-section">
        <div class="features-header">
            <h2>Platform Features & Capabilities</h2>
            <p>A seamless, end-to-end event management and ticketing experience</p>
        </div>

        <div class="features-grid">

            <div class="feature-card">
                <div class="feature-icon icon-blue">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h3>Dynamic Event Discovery</h3>
                <p>Browse our live catalog and instantly filter upcoming events by category to find your perfect
                    experience without reloading the page.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-green">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h3>Real-Time Seat Booking</h3>
                <p>Secure your spot instantly with live database inventory tracking that prevents double-booking and
                    guarantees your reservation.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-yellow">
                    <i class="fa-solid fa-ticket-simple"></i>
                </div>
                <h3>Smart Ticket Management</h3>
                <p>Access your personalized dashboard to view active bookings, check unique booking codes, or process
                    instant one-click cancellations.</p>
            </div>

        </div>
    </div>

    <!-- Contact Us -->
    <div id="Contact">
        <h1 id="hc">CONTACT US</h1>
        <div id="dc1">
            <div id="dc2">
                <div class="map-container">
                    <iframe style="border: 0;
                        border-radius: 0px;
                        filter: invert(90%) hue-rotate(180deg) brightness(85%) contrast(90%);"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.097728345112!2d-122.39997268468205!3d37.78775467975764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808580649520ce4b%3A0x60959fcb0c410659!2sSalesforce%20Tower!5e0!3m2!1sen!2sus!4v1689255845199!5m2!1sen!2sus"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <form action="" id="fc" method="post">
                <input type="text" name="user_name" id="inc" placeholder="Your Name" required>
                <input type="email" name="user_email" id="inc1" placeholder="Your Email" required><br>
                <input type="text" name="subject" id="inc2" placeholder="Subject" required><br>
                <textarea name="message" id="tc1" placeholder="Message" required></textarea><br>
                <input type="submit" value="Send Message" name="contact_btn" id="btnc">
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer">
        <h4 id="hf1">© 2026 EventHub Event Management System Page</h4>
    </div>



    <script src="js/script.js"></script>
</body>

</html>