<?php
include '../../includes/functions.php';
include '../../includes/functions_exchange.php';
require("../../includes/db.php");
require("../../includes/constants.php");

?>

<!DOCTYPE html>
<html lang="en">
<?php $sitename="Pulwar Group"; ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo($sitename); ?></title>

    <!-- Bootstrap Core CSS -->
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js//html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->





</head>




<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top"><?php echo($sitename); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">Services</a>
                </li>
                <li>
                    <a class="page-scroll" href="#portfolio">Portfolio</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="#team">Team</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
                <li>
                    <a class="page-scroll" href="../login.php">Log In</a>
                </li>
                <li>
                    <a class="page-scroll" href="../register.php">Register</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Invest with Excellence</div>
            <div class="intro-heading">Welcome!</div>
            <a href="#services" class="page-scroll btn btn-xl">Tell Me More</a>
        </div>
    </div>
</header>

<!-- Services Section -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Services</h2>
                <h3 class="section-subheading text-muted">Solution Oriented</h3>
            </div>
        </div>
        <div class="row text-center">



            <!-- COMMERCE -->
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">Buy</h4>
                <p class="text-muted">Low fees</p>
            </div>

            <!-- INVESTING -->
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-area-chart fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">Invest</h4>
                <p class="text-muted">Transparent markets</p>
            </div>

            <!-- TRADING -->
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-refresh fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">Trade</h4>
                <p class="text-muted">Liquid assets</p>
            </div>

            <!-- SECURITY -->
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">Security</h4>
                <p class="text-muted">Cryptographically protected</p>
            </div>

            <!-- SERVICES -->
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-cog fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">Service</h4>
                <p class="text-muted">Investment advisory</p>
            </div>

            <!-- TRANSFER -->
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-share-alt fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">Transfer</h4>
                <p class="text-muted">Instant and seamless</p>
            </div>




        </div>
    </div>
</section>

<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Asset Portfolio</h2>
                <h3 class="section-subheading text-muted">Convert and transact seamlessly.</h3>
            </div>
        </div>
        <div class="row">


            <?php
            $modaldir="card/real/";

            $assets =	query("SELECT symbol FROM assets ORDER BY symbol ASC");
            foreach ($assets as $asset)		// for each of user's stocks
            {
                $assetQ =	query("SELECT symbol, name, date, issued, type, url, description FROM assets WHERE symbol =?", $asset["symbol"]);	  // query user's portfolio
                $symbol = $assetQ[0]["symbol"];
                $name = $assetQ[0]["name"];
                $type = $assetQ[0]["type"];
                $modalimage = $modaldir . strtolower($symbol) . '.jpg';

                ?>
                <!-- Portfolio Modal -->
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal<?php echo($symbol); ?>" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/<?php echo($modalimage); ?>" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4><?php echo($symbol  . " - " . $name); ?></h4>
                        <p class="text-muted"><?php echo(ucfirst($type)); ?></p>
                    </div>
                </div>

            <?php }

            //UNITS
            $symbol = $unittype;
            $name = $unitdescription;
            $type = $unittype2;
            $modalimage = $modaldir . strtolower($symbol) . '.jpg';
            ?>
            <!-- Portfolio (UNITS) Modal -->
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="#portfolioModal<?php echo($symbol); ?>" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/<?php echo($modalimage); ?>" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4><?php echo($symbol  . " - " . $name); ?></h4>
                    <p class="text-muted"><?php echo(ucfirst($type)); ?></p>
                </div>
            </div>





        </div>
    </div>
</section>

<!-- About Section -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">About</h2>
                <h3 class="section-subheading text-muted">Who we are</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2009-2011</h4>
                                <h4 class="subheading">Phase One</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Our start</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2011</h4>
                                <h4 class="subheading">Phase Two</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">International Expansion</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2012</h4>
                                <h4 class="subheading">Phase Three</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Innovative Technology</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>July 2014</h4>
                                <h4 class="subheading">Phase Four</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Giving Back</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>





<!-- Team Section -->
<section id="portfolio" class="bg-light-gray">

    <!--<section id="team" class="bg-light-gray">-->
    <div class="container">


        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Board of Directors</h2>
                <h3 class="section-subheading text-muted">Visionaries</h3>
            </div>
        </div>

        <div class="row">



<?php
            $i = 0;

            $i++;
            $team[$i]['link'] = 'Chairman';
            $team[$i]['name'] = 'Ben Bernanke';
            $team[$i]['title'] = 'Chairman of Board';
            $team[$i]['description'] = 'Leads the board of directors and chairs board meetings. Presiding officer of the corporate Board of directors. The Chairman influences the board of directors, which in turn elects and removes the officers of a corporation and oversees the human, financial, environmental and technical operations of a corporation.';
            $team[$i]['img'] = '1';


            $i++;
            $team[$i]['link'] = 'Secretary';
            $team[$i]['name'] = 'Jamie Dimon';
            $team[$i]['title'] = 'Secretary of Board';
            $team[$i]['description'] = 'Responsible to record the proceedings of the meetings of the stockholders and directors in a book to be kept for that purpose. Legally recognized "titled" corporate officer who reports to the Board of Directors and is responsible for keeping the records of the Board and the company. This title is often concurrently held by the treasurer in a dual position called secretary-treasurer; both positions may be concurrently held by the CFO. Note, however, that the Secretary has a reporting line to the Board of Directors, regardless of any other reporting lines conferred by concurrent titles.';
            $team[$i]['img'] = '2';

            $i++;
            $team[$i]['link'] = 'Board';
            $team[$i]['name'] = 'Michael Corbat';
            $team[$i]['title'] = 'Board Member';
            $team[$i]['description'] = '';
            $team[$i]['img'] = '3';

            $i++;
            $team[$i]['link'] = "CEO";
            $team[$i]['name'] = "John Stumpf";
            $team[$i]['title'] = 'Chief Executive Officer';
            $team[$i]['description'] = 'Full responsibility for the activities of the company. Responsible for external relations and long-term strategy. The CEO signs major contracts, stock certificates and other legal documents, as required. The CEO acts under the direction of the board. For substantial actions to be taken, the CEO will act on behalf of the corporation by corporate resolution. The CEO of a corporation is the highest ranking management officer of a corporation and has final decisions over human, financial, environmental, technical operations of the corporation. The CEO is also a visionary, often leaving day-to-day operations to the President, COO or division heads. Other corporate officers such as the COO, CFO, CIO, and  division heads report to the CEO. The CEO is also often the Chairman of the Board, especially in closely held corporations and also often in public corporations. Recently, though, many public companies have separated the roles of Chairman and CEO (This is long-standing normal practice under the British System), resulting in a non-executive chairman, in order to improve corporate governance. President and CEO is a popular combination if there is a non-executive chairman.';
            $team[$i]['img'] = '4';

            $i++;
            $team[$i]['link'] = 'President';
            $team[$i]['name'] = 'Lloyd Blankfein';
            $team[$i]['title'] = 'President';
            $team[$i]['description'] = 'Responsible for internal management and focuses on day-to-day operations. Legally recognized highest "titled" corporate officer outside of the CEO (who ranks highest). The President works directly for the Board of Directors and usually a member of the Board of Directors. The office of President can be limited by the Chairman/CEO to represent only one division within a corporation, such as the President of Sales. In the event there is no CEO, the President is the highest ranking officer but is not normally the Chairperson. There is much variation; often the CEO also holds the title of President, while a Chairman and CEO\'s deputy is often the President and COO. The President is often considered to be more focused upon daily operations compared to the CEO which is supposed to be the visionary.';
            $team[$i]['img'] = '5';


            $i++;
            $team[$i]['link'] = 'CFO';
            $team[$i]['name'] = 'Brian Moynihan';
            $team[$i]['title'] = 'Treasurer/Chief Financial Officer';
            $team[$i]['description'] =
            $team[$i]['img'] = '6';
            //CFO
            '<strong>CFO</strong><br>High level corporate officer with oversight of corporate finances; reports to the CEO. May concurrently hold the title of Treasurer or oversee such a position; it must be noted that Finance deals with accounting and audits, while Treasurer deals with company funds. <br><br>' .
            //Treasurer
            '<strong>Treasurer</strong><br>Responsible for the financial matters of the corporation. The treasurer is responsible for maintaining the financial corporate records and for preparing and presenting financial reports to the board, officers and shareholders. Legally recognized corporate officer entrusted with the fiduciary responsibility of caring for company funds. Often this title is held concurrently with that of Secretary in a dual role called secretary-treasurer. It can also be held concurrently with the title of CFO or fall under the jurisdiction of one, though the CFO tends to oversee the Finance Department instead, which deals with accounting and audits, while the Treasurer deals directly with company funds. Note, however, that the Treasurer has a reporting line to the Board of Directors, regardless of any other reporting lines conferred by concurrent titles.';
?>
            <?php
            $n=0;
            foreach ($team as $t)
            {
            $n++;
            ?>


            <div class="col-sm-4">
                <div class="team-member">
                    <a href="#teamModal<?php echo($team[$n]['link']); ?>" class="portfolio-link" data-toggle="modal">
                        <img src="img/team/<?php echo($team[$n]['img']); ?>.jpg" class="img-responsive img-circle" alt="">
                    </a>
                    <h4><?php echo($team[$n]['name']); ?></h4>
                    <p class="text-muted"><?php echo($team[$n]['title']); ?></p>
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php } ?>





        </div><!--row-->










    </div>
</section>

<!-- Clients Aside -->
<aside class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="#">
                    <img src="img/logos/usa.jpg" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="#">
                    <img src="img/logos/logo.jpg" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="#">
                    <img src="img/logos/dt.jpg" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="#">
                    <img src="img/logos/fed.jpg" class="img-responsive img-centered" alt="">
                </a>
            </div>
        </div><!--row-->
    </div>
</aside>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading text-muted">How can we help?</h3>
            </div>
        </div><!--row-->
        <div class="row">
            <div class="col-lg-12">
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-xl">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--row-->
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; <?php echo($sitename); ?> 2014</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>










<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->





<?php
$modaldir="card/real/";

$assets =	query("SELECT symbol, name, date, issued, type, url, description FROM assets ORDER BY symbol ASC");
foreach ($assets as $asset)		// for each of user's stocks
{
    $symbol = $asset["symbol"];
    $name = $asset["name"];
    $date = $asset["date"];
    $issued = $asset["issued"];
    $type = $asset["type"];
    $url = $asset["url"];
    $description = $asset["description"];
    $modalimage = $modaldir . strtolower($symbol) . '.jpg';

    $rateQ =	query("SELECT price FROM trades WHERE symbol =? ORDER BY uid DESC LIMIT 0,1", $asset["symbol"]);	  // query user's portfolio
    if(!empty($rateQ)){$rate = getPrice($rateQ[0]["price"]);}
    else{$rate=0;}

    $askQ =	query("SELECT price FROM orderbook WHERE symbol=? AND side='a' ORDER BY price ASC LIMIT 0,1", $asset["symbol"]);	  // query user's portfolio
    if(!empty($askQ)){$ask = getPrice($askQ[0]["price"]);}
    else{$ask=0;}

    $bidQ =	query("SELECT price FROM orderbook WHERE symbol=? AND side='b' ORDER BY price DESC LIMIT 0,1", $asset["symbol"]);	  // query user's portfolio
    if(!empty($bidQ)){$bid = getPrice($bidQ[0]["price"]);}
    else{$bid=0;}




    ?>
    <!-- Portfolio Modal -->
    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo($symbol); ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">

                            <!-- Project Details Go Here -->
                            <h2><?php echo($name); ?></h2>
                            <p class="item-intro text-muted"><?php echo($symbol); ?></p>
                            <img class="img-responsive img-centered" src="img/portfolio/<?php echo($modaldir . 'LG' . strtolower($symbol) . '.jpg'); ?>" alt="">
                            <p><?php echo($description); ?></p>
                            <ul class="list-inline">
                                <li><strong>Price:</strong> <?php echo($unitsymbol . number_format($rate,$decimalplaces,".",",")); ?></li>
                                <li><strong>Bid:</strong> <?php echo($unitsymbol . number_format($bid,$decimalplaces,".",",")); ?></li>
                                <li><strong>Ask:</strong> <?php echo($unitsymbol . number_format($ask,$decimalplaces,".",",")); ?></li>
                                <li><strong>Registered:</strong> <?php echo($date); ?></li>
                                <li><strong>Type:</strong> <?php echo(ucfirst($type)); ?></li>
                                <li><strong>Issued:</strong> <?php echo(number_format($issued,0,".",",")); ?></li>
                                <li><strong>URL:</strong> <a href="<?php echo(htmlspecialchars($url)); ?>"><?php echo(htmlspecialchars($url)); ?></a></li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Asset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }



//UNITS
$symbol = $unittype;
$name = $unitdescription;
$date = 'N/A';
$locked = query("SELECT SUM(total) AS total FROM orderbook WHERE (side='b')");
$issued = query("SELECT SUM(units) AS total FROM accounts");
$issued = $issued[0]["total"] + $locked[0]["total"];
$type = $unittype2;
$url = 'N/A';
$description = $unitdescriptionlong;
$modalimage = $modaldir . strtolower($symbol) . '.jpg';
?>
<!-- Portfolio Modal -->
<div class="portfolio-modal modal fade" id="portfolioModal<?php echo($symbol); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">

                        <!-- Project Details Go Here -->
                        <h2><?php echo($name); ?></h2>
                        <p class="item-intro text-muted"><?php echo($symbol); ?></p>
                        <img class="img-responsive img-centered" src="img/portfolio/<?php echo($modaldir . 'LG' . strtolower($symbol) . '.jpg'); ?>" alt="">
                        <p><?php echo($description); ?></p>
                        <ul class="list-inline">
                            <li><strong>Price:</strong> <?php echo($unitsymbol . number_format(1,$decimalplaces,".",",")); ?></li>
                            <li><strong>Bid:</strong> <?php echo($unitsymbol . number_format(1,$decimalplaces,".",",")); ?></li>
                            <li><strong>Ask:</strong> <?php echo($unitsymbol . number_format(1,$decimalplaces,".",",")); ?></li>
                            <li><strong>Registered:</strong> N/A</li>
                            <li><strong>Type:</strong> <?php echo(ucfirst($type)); ?></li>
                            <li><strong>Issued:</strong> <?php echo(number_format($issued,0,".",",")); ?></li>
                            <li><strong>URL:</strong> <a href="<?php echo(htmlspecialchars($url)); ?>"><?php echo(htmlspecialchars($url)); ?></a></li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Asset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<!-- Team Modal -->
<?php
$n=0;
foreach ($team as $t)
{
    $n++;
    ?>

    <div class="portfolio-modal modal fade" id="teamModal<?php echo($team[$n]['link']); ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">

                            <!-- Project Details Go Here -->
                            <h2><?php echo($team[$n]['name']); ?></h2>
                            <p class="item-intro text-muted"><?php echo($team[$n]['title']); ?></p>
                            <p><?php echo($team[$n]['description']); ?></p>

                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/agency.js"></script>

</body>

</html>
