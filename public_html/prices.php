<?php
// Include the library
require('simple_html_dom.php');

// Retrieve the DOM from a given URL
$html = file_get_html('http://www.kitco.com/mobile/');

// Extract all text from a given cell
$gold["bid"] = $html->find('td[align="center"]', 4)->plaintext.'<br><hr>'; 
$gold["ask"] = $html->find('td[align="center"]', 5)->plaintext.'<br><hr>'; 
$gold["change"] = $html->find('td[align="center"]', 7)->plaintext.'<br><hr>'; 
$silver["bid"] = $html->find('td[align="center"]', 9)->plaintext.'<br><hr>'; 
$silver["ask"] = $html->find('td[align="center"]', 10)->plaintext.'<br><hr>';
$silver["change"] = $html->find('td[align="center"]', 12)->plaintext.'<br><hr>'; 
$platinum["bid"] = $html->find('td[align="center"]', 14)->plaintext.'<br><hr>'; 
$platinum["ask"] = $html->find('td[align="center"]', 15)->plaintext.'<br><hr>'; 
$platinum["change"] = $html->find('td[align="center"]', 17)->plaintext.'<br><hr>';
$palladium["bid"] = $html->find('td[align="center"]', 19)->plaintext.'<br><hr>'; 
$palladium["ask"] = $html->find('td[align="center"]', 20)->plaintext.'<br><hr>';
$palladium["change"] = $html->find('td[align="center"]', 22)->plaintext.'<br><hr>';
$rhodium["bid"] = $html->find('td[align="center"]', 24)->plaintext.'<br><hr>'; 
$rhodium["ask"] = $html->find('td[align="center"]', 25)->plaintext.'<br><hr>';  
$rhodium["change"] = $html->find('td[align="center"]', 27)->plaintext.'<br><hr>';

/*
//To prove it works.
var_dump($gold); 
var_dump($silver); 
var_dump($platinum); 
var_dump($palladium); 
var_dump($rhodium);
*/
?>

<style>
 table {
     border-collapse: collapse;
 }
 table, td, th {
     border: 1px solid black;
 }
</style>

<table>
<thead>
 <tr>
  <th>Element</th>
  <th>Bid</th>
  <th>Ask</th>
  <th>Change</th>
 </tr>
</thead>
<tbody>
 <tr>
  <td>Gold</td>
  <td><?php echo(number_format($gold["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($gold["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($gold["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Silver</td>
  <td><?php echo(number_format($silver["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($silver["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($silver["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Platinum</td>
  <td><?php echo(number_format($platinum["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($platinum["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($platinum["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Palladium</td>
  <td><?php echo(number_format($palladium["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($palladium["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($palladium["change"],2,".","")); ?></td>
 </tr>
 <tr>
  <td>Rhodium</td>
  <td><?php echo(number_format($rhodium["bid"],2,".","")); ?></td>
  <td><?php echo(number_format($rhodium["ask"],2,".","")); ?></td>
  <td><?php echo(number_format($rhodium["change"],2,".","")); ?></td>
 </tr>
</tbody> 
</table>

<br>
<br>
Gold/Silver Ratio (GSR): <?php echo(number_format(($gold["bid"]/$silver["bid"]),2,".",",")); ?>
<br>
<br>

<?php $silverprice=$silver["bid"]; ?>


<table>
<thead>
<tr>
<th>Size</th>
<th>#</th>
<th>Note</th>
</tr>
</thead>
<tbody>
<tr>
 <td>Silver Fat Man</td>
 <td>$<?php echo(number_format(($silverprice*3224.74),2,".",",")); ?></td>
 <td>Fat Adult Male = 221.12lbs = 3,224.74 troy ounces</td>
</tr>

<tr>
 <td>Silver Man</td>
 <td>$<?php echo(number_format(($silverprice*2668.75),2,".",",")); ?></td>
 <td>Average Adult Male = 183lbs = 2,668.75 troy ounces</td>
</tr>
<tr>
 <td>Silver Kilogram</td>
 <td>$<?php echo(number_format(($silverprice*32.1507466),2,".",",")); ?></td>
 <td>1 Kilogram = 32.1507466  troy ounces</td>
</tr>
<tr>
 <td>Silver Pound</td>
 <td>$<?php echo(number_format(($silverprice*14.5833333),2,".",",")); ?></td>
 <td>1 pound = 14.5833333 troy ounces</td>
</tr>
<tr>
 <td>Silver Ounce</td>
 <td>$<?php echo(number_format(($silverprice*1),2,".",",")); ?></td>
 <td>1 Troy Ounce</td>
</tr>
 <td>Silver Gram</td>
 <td>$<?php echo(number_format(($silverprice/31.1034768),2,".",",")); ?></td>
 <td>31.1034768 = 1 troy ounce</td>
</tr>
<tr>
 <td>Silver Grain</td>
 <td>$<?php echo(number_format(($silverprice/480),2,".",",")); ?></td>
 <td>480 grain = 1 troy ounce</td>
</tr>
</tbody>
</table>

 
 <br>
$1 Face Value, New (0.723 ozt): <?php echo(number_format(($silverprice*.723),2,".",",")); ?>x
 <br>
$1 Face Value, Worn (0.715 ozt): <?php echo(number_format(($silverprice*.715),2,".",",")); ?>x
 <br>
$1 Face Value, Morgan/Peace (0.7734 ozt): <?php echo(number_format(($silverprice*.7734),2,".",",")); ?>x
  <br>

 
 <table>
 <thead>
  <tr>
   <td>Type</td>
   <td>Value</td>
   <td>ASW*</td>
   <td>Note</td>
  </tr>
 </thead>
 
 <tbody>



  <tr>
  <td>Jefferson War Nickle (1942-1945)</td>
  <td>$<?php echo(number_format(($silverprice*.0563),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>56% Copper, 35% Silver, 9% Manganese</td>
 </tr>

  <tr>
  <td>Barber Dime (1892-1916)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Mercury Dime (1916-1945)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Roosevelt Dime (1946-1964)</td>
  <td>$<?php echo(number_format(($silverprice*.0723),2,".",",")); ?></td>
  <td>0.0723 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(10*.0723)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Barber Quarter (1892-1916)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Standing Liberty Quarter (1916-1930)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Washington Quarter (1932-1964)</td>
  <td>$<?php echo(number_format(($silverprice*.1808),2,".",",")); ?></td>
  <td>0.1808 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(4*.1808)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Barber Half Dollar (1892-1915)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Franklin Half Dollar (1948-1963)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>

  <tr>
  <td>Kennedy Half Dollar (1964)</td>
  <td>$<?php echo(number_format(($silverprice*.36169),2,".",",")); ?></td>
  <td>0.36169 ozt</td>
  <td>90% Silver; $1 Face: <?php echo(number_format(($silverprice*(2*.36169)),2,".",",")); ?></td>
 </tr>
  
  <tr>
  <td>Kennedy Half Dollar (1965-1970)</td>
  <td>$<?php echo(number_format(($silverprice*.1479),2,".",",")); ?></td>
  <td>0.1479 ozt</td>
  <td>40% Silver, 60% Copper; $1 Face: <?php echo(number_format(($silverprice*(2*.1479)),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Morgan Dollar (1878-1921)</td>
  <td>$<?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
  <td>0.7734 ozt</td>
  <td>90% Silver, Face: <?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Peace Dollar (1921-1935)</td>
  <td>$<?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
  <td>0.7734 ozt</td>
  <td>90% Silver, Face: <?php echo(number_format(($silverprice*.7734),2,".",",")); ?></td>
 </tr>
 
  <tr>
  <td>Eisenhower (1971-1978)</td>
  <td>$<?php echo(number_format(($silverprice*.3161),2,".",",")); ?></td>
  <td>0.3161 ozt</td>
  <td>60% Copper, 40% Silver</td>
 </tr>
 
  <tr>
  <td>American Silver Eagle (1986-Present)</td>
  <td>$<?php echo(number_format(($silverprice*1),2,".",",")); ?></td>
  <td>1 ozt</td>
  <td>99.93% Silver</td>
 </tr>
 
  <tr>
  <td>America the Beautiful 'Quarter' (2010-Present)</td>
  <td>$<?php echo(number_format(($silverprice*5),2,".",",")); ?></td>
  <td>5 ozt</td>
  <td>99.93% Silver</td>
 </tr>
 
 
 </tbody>
 </table>
 *Actual Silver Weight
 
 
 <br>
 <img src="http://www.kitco.com/images/live/silver.gif">
 
 
 
 <?php $silvergram=$silverprice/31.1034768; ?>
 
 
 <style type="text/css">
	table.tableizer-table {
	border: 1px solid #CCC; font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
} 
.tableizer-table td {
	padding: 4px;
	margin: 3px;
	border: 1px solid #ccc;
}
.tableizer-table th {
	background-color: #104E8B; 
	color: #FFF;
	font-weight: bold;
}
</style><table class="tableizer-table">
<tr class="tableizer-firstrow"><th>Authority</th><th>Denomination</th><th>Standard</th><th>Weight (g)</th><th>Spot $ USD</th><th>Notes</th></tr>
 <tr><td>AEGINA</td><td>didrachma</td><td>Aeginetic</td><td>12.2</td><td>$<?php echo(number_format(($silvergram*12.2),2,".",",")); ?></td><td>Cities minted a STATER or principal trade coin for large scale transactions. In Athens, the stater was a tetradrachma (17.2 g), while in Aegina the stater was a didrachma (12.2 g).</td></tr>
 <tr><td>AEGINA</td><td>drachma</td><td>Aeginetic</td><td>6.1</td><td>$<?php echo(number_format(($silvergram*6.1),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>ATHENS</td><td>Talent</td><td>Attic</td><td>25,950.00</td><td>$<?php echo(number_format(($silvergram*25950.00),2,".",",")); ?></td><td>6000 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Minae</td><td>Attic</td><td>432.50</td><td>$<?php echo(number_format(($silvergram*432.50),2,".",",")); ?></td><td>100 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Decadrachma</td><td>Attic</td><td>43.25</td><td>$<?php echo(number_format(($silvergram*43.25),2,".",",")); ?></td><td>10 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Tetradrachma</td><td>Attic</td><td>17.20</td><td>$<?php echo(number_format(($silvergram*17.20),2,".",",")); ?></td><td>4 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Tridrachma</td><td>Attic</td><td>12.90</td><td>$<?php echo(number_format(($silvergram*12.9),2,".",",")); ?></td><td>3 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Didrachma</td><td>Attic</td><td>8.60</td><td>$<?php echo(number_format(($silvergram*8.6),2,".",",")); ?></td><td>2 drachmae</td></tr>
 <tr><td>ATHENS</td><td>Drachma</td><td>Attic</td><td>4.30</td><td>$<?php echo(number_format(($silvergram*4.3),2,".",",")); ?></td><td>6 obols</td></tr>
 <tr><td>ATHENS</td><td>tetrobol</td><td>Attic</td><td>2.87</td><td>$<?php echo(number_format(($silvergram*2.87),2,".",",")); ?></td><td>4 obols</td></tr>
 <tr><td>ATHENS</td><td>tribobol*</td><td>Attic</td><td>2.15</td><td>$<?php echo(number_format(($silvergram*2.15),2,".",",")); ?></td><td>3 obols; *The triobol was also called a hemidrachma or half-drachma.</td></tr>
 <tr><td>ATHENS</td><td>diobol</td><td>Attic</td><td>1.43</td><td>$<?php echo(number_format(($silvergram*1.43),2,".",",")); ?></td><td>2 obols</td></tr>
 <tr><td>ATHENS</td><td>obol</td><td>Attic</td><td>0.72</td><td>$<?php echo(number_format(($silvergram*0.72),2,".",",")); ?></td><td>1 obol</td></tr>
 <tr><td>ATHENS</td><td>hemiobol</td><td>Attic</td><td>0.36</td><td>$<?php echo(number_format(($silvergram*0.36),2,".",",")); ?></td><td>1/2 obol</td></tr>
 <tr><td>CORINTH</td><td>didrachma</td><td>Attic</td><td>8.6</td><td>$<?php echo(number_format(($silvergram*8.6),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>CYZICUS</td><td>electrum stater</td><td>Phocaic</td><td>16.01</td><td>$<?php echo(number_format(($silvergram*16.01),2,".",",")); ?></td><td>ELECTRUM (an alloy of gold and silver)</td></tr>
 <tr><td>LYDIA</td><td>electrum stater</td><td>Persic</td><td>14.2</td><td>$<?php echo(number_format(($silvergram*14.2),2,".",",")); ?></td><td>ELECTRUM (an alloy of gold and silver)</td></tr>
 <tr><td>LYDIA</td><td>gold stater</td><td>Persic</td><td>10.9</td><td>$<?php echo(number_format(($silvergram*10.9),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>LYDIA</td><td>silver stater</td><td>Persic</td><td>5.55</td><td>$<?php echo(number_format(($silvergram*5.55),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>PERSIA</td><td>gold daric</td><td>Persic</td><td>8.35</td><td>$<?php echo(number_format(($silvergram*8.35),2,".",",")); ?></td><td>The Persian king minted a gold DARIC exchanged against 20 silver SIGLOI (and the equivalent of 25 Attic drachmae).</td></tr>
 <tr><td>PERSIA</td><td>Silver siglos</td><td>Persic</td><td>5.35</td><td>$<?php echo(number_format(($silvergram*5.35),2,".",",")); ?></td><td>The Persian king minted a gold DARIC exchanged against 20 silver SIGLOI (and the equivalent of 25 Attic drachmae).</td></tr>
 <tr><td>PHOENICIA</td><td>stater</td><td>Phoenician</td><td>13.9</td><td>$<?php echo(number_format(($silvergram*13.9),2,".",",")); ?></td><td>214.5 grains; double shekel use in Tyre: 1 stater=2 shekels</td></tr>
 <tr><td>PHOENICIA</td><td>shekel</td><td>Phoenician</td><td>7</td><td>$<?php echo(number_format(($silvergram*7),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>SYRACUSE</td><td>decadrachma</td><td>Attic</td><td>43.25</td><td>$<?php echo(number_format(($silvergram*43.25),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>SYRACUSE</td><td>tetradrachma</td><td>Attic</td><td>17.2</td><td>$<?php echo(number_format(($silvergram*17.2),2,".",",")); ?></td><td>&nbsp;</td></tr>
 <tr><td>SYRACUSE</td><td>drachma</td><td>Attic</td><td>4.3</td><td>$<?php echo(number_format(($silvergram*4.3),2,".",",")); ?></td><td></td></tr>
</table>

<br>
 *A roman talent was 32.3 kilograms, an Egyption talent was 27 kilograms, a Babylonian talent was 30.3 kilograms. The heavy common talent used in the New Testiment was 58.9 kilograms.
Cities premised their currency upon a drachma of varying weight so that coins were exchanged in the market according to their weight. The four crucial standards were the AEGINETIC (employed by the island polis Aegina and cities of the Peloponnesus and Central Greece), the ATTIC or EUBOIC (employed by Athens, Corinth, Sicilian colonies, and cities in the Aegean), the PERSIC, the standard of the Lydian kings (employed by the Great King of Persia and the Asian Greeks), and the Phoenician standard used in the Levant.



<br>
*An Attic Talent of silver was the value of nine man-years of skilled work in 377 BC (11.1 grams of silver per workday).
<br>
*During the Peloponnesian War, an Attic Talent was the amount of silver that would pay a months wages of a trireme crew of 200 rowers (4.3grams of silver per rower per day).
<br>
*Hellenistic mercenaries were commonly paid one drachma per day of military service. There were 6,000 drachme in an Attic Talent.
<br>
*The Babylonians, Sumerians, Hebrews, and Greek divided a Telent into 60 mina. Then 1 mina into 60 shekels. A Greek mina was 434(+/-3)g. A Roman Talent is 1.25 Greek Talents. 
<br>
*In 1800 a building craftsman in urban Europe got an average wage of 11.9 grams of silver a day.
<br>
*Ancient Babylon, workers earned 2.1 grams silver a day. Sheep ranged from 2.6g to 16g silver.
<br>
*Carpenter in Egypt in 709AD maid 16 nomismata annually. 1 nomismata=1 dinar = 3.9g pure gold = 58.5 grams of silver
<br>
*Average Roman Soldier
<br>

<br>
Ancient Prices
<br>
Before delving into the discussion of silver’s historical value, a few starting conditions are important to understand. First, it’s difficult to equate modern and ancient labor. A lot of labor in ancient times was performed by slaves and the translations of “laborer” or “craftsman” into modern terms is imprecise at best, as are concepts like the length of a normal workday. Likewise, prices can be skewed by the more primitive state of trade – modern conveniences like wine and spices seem quite expensive in medieval England, but part of that is clearly due to the fact that they weren’t produced in England and long trade routes and/or wars took their toll on prices.
Going back to ancient Babylon, we know that workers earned the equivalent of about 2.1 grams of silver per day (about 1/15 of an ounce or a little more than $2 in today’s silver prices). At that time, the price of a sheep ranged from 2.6 g to 16 g of silver (about $2 to $16 in today’s prices), which compares to recent prices of about $90 to $120.
Apparently it was better to be a laborer in ancient Greece, as typical wages were about 1 attic drachma (4.3 g of silver) in the fifth century and about 2.5 drachmai by 377. In the fifth century, a drachma would buy you approximately 3 kg of olive oil and three drachmai would buy you a medimnos of wheat (about 54 liters). While the price of that medimos climbed to 5 drachmai by the 4th century, it basically still worked out that a day’s labor would buy about two weeks worth of food for one person (if they lived on bread alone).
The Romans may have brought many valuable inventions to the world, but debasement and serious inflation are inventions that humanity probably could have done without. Although the Roman day wage of 1.2 denarii (4.2 g of silver) was pretty consistent with wages during the time of the Greeks, there was huge inflation and debasement from the time of Nero through Diocletian and beyond. As the Romans gutted the silver content of the denarius from 3.5 g of 98% silver to 3.4 g of 94% silver on down to 40% and then almost nothing, the price of a “measure” of wheat soared by about 15,000 times over about 250 years [see also Preparing For Economic Headwinds: Bill Gross’ Commodity Picks].
<br>
The Medieval Times
<br>
While the medieval period saw a pronounced increase in trade and the growth of cities, it was also marked by wars and plagues that significantly depopulated large swathes of Europe. In many cases, depopulation led to pressures for higher wages and the nobility often fought back with wage controls.
Around 1300 AD, a laborer in England could expect two earn about 2 pounds sterling in a year, or about 672 g of silver (about 2.1 g of silver per day, given the different workweek of medieval times). Likewise, we know a thatcher in 1261 could look to earn about 2 pennies a day or 2.8 g of silver. Thatchers’ pay increased to about 3 pence (approximately 4.2 g of silver) in 1341, 4 pence in 1381, and 6 pence in 1481. Along the way, a city “craftsman” could look to earn about 4 pence a day in the 1350s.
So what would those wages buy? In the early 14th century, wine cost between 3 pence and 10 pence per gallon in England, and two dozen eggs could be had for 1 pent. Some time later, an axe cost about 5 pence in mid-15thcentury England, while wheat cost about 0.2 g of silver per liter (not much different than the per-liter price in ancient Greece).
<br>
The Industrial Age
<br>
By the 18th and 19th centuries, the use of paper money was increasingly common alongside silver and gold coins. What’s more, the price of gold and silver were increasingly fixed and stable for long stretches of time. Sir Isaac Newton fixed the price of gold in 1717, and it pretty much stayed at that at the price (excluding the years of the Napoleonic Wars) until World War 1 [see also 3 Metals Outshining Gold].
Likewise, the price of silver more or less stayed at about $1.30/oz from the founding of the U.S. through the Civil War. Prices were exceptionally turbulent during the Civil War (rising to nearly $3/oz) and stayed above $1.30/oz until the late 1870s. Prices generally declined through the latter years of the 19th century, dipping below $0.60/oz in 1897, and mostly hovered in the $0.50s through to World War I. From a low of about $0.25/oz in 1932, silver generally climbed thereafter – moving above $0.70/oz after World War II, moving past $0.80/oz in 1950, and crossing $1/oz in 1960.
Silver jumped alongside gold throughout the 1970s, and spiked to $50 an ounce in January of 1980 as the Hunt brothers (Nelson Hunt and William Hunt) manipulated silver in an attempt to corner the market. Silver crashed shortly thereafter, hitting $8 in 1981, $6 in 1986, and dropping below $4 in the early 1990s. Silver has since rallied through the late ’90s and the first decade of the 21st century, and currently sits around $33 an ounce.
Tracing the path of wages, we have an average wage of about $1 per day in the latter part of the 19th century, or about 25 g of silver. When Henry Ford revolutionized the auto industry (and how companies viewed wages) in 1914 and offered $5/day (about 10oz of silver), the average daily wage was about $2.34 per day.
When federal minimum wages began in 1938, the nominal value of those wages were about $2/day (or more than 4.5 ounces). Those wages climbed to about $16 per day in 1974 (about 3.6 ounces of silver) to $58 today (or about 1.75 ounces of silver). Said differently, today’s minimum wage buys about 13 times the amount of silver that the average daily wage in ancient Greece bought.
<br>
The Future
<br>
Silver’s value throughout history has always been volatile, as the supply of labor, foodstuffs and consumer goods waxed and waned with wars, trade growth and technological innovation. Given how modern governments view monetary policy as something of a panacea, though, it seems like ongoing inflation is a pretty safe bet.
It is worth asking whether the price of silver stacks up as fair. For more than 2,000 years, somewhere between 1/10th and 1/15th of an ounce of silver would buy you a day’s labor; in today’s terms, that would suggest that silver should trade for $264, if U.S. wages should be seen as the global standard. By way of comparison, minimum wages in China’s Guangdong province (an area with extensive manufacturing activity) would work out to about $6/day on average or about 5.6 g of silver – about half the wages in 4th century Greece, so it really is a case of what you consider to be the representative global wage [see also Doomsday Special: 7 Hard Assets You Can Hold In Your Hand].
It is also interesting to see that the value of gold today is more than 50-times that of silver, even though the actual ratio of production and global reserves suggests that such a spread is at least 3-times wider than it should be. In any event, investors should continue to expect silver prices to be volatile and inconsistent, irrespective of whether governments start pursuing sounder monetary policy.
<br>


<br>
Average Wage
<br>
Building Craftsman (1850-1899)
<br>
Laborers (1850-1899)
<br>
Building Craftsman (1900-1913)
<br>
Laborers (1900-1913)
<br>
*1850 Comstock Lode Discovery
<br>
Wanlockhead in 1844
<br>
Miners 60p week
<br>
Smelters 70p week
<br>
Average wage in 1850 was 18 pence
<br>

<br>
"Drachma - equivalent to one day's wages for manual labor (1/8oz Ag)"
<br>
"1 silver stater = 4 drachma = approx. 3.5 denarii"
<br>
"...[A]n average Roman soldier was paid one denarius for each day of service. Each denarius was 1/10th of an ounce, or about $3.00 a day, which is comparable to the world’s average daily pay. That valuation lasted for hundreds of years for basic labor. So now when you hear, “brother can you spare a (silver) dime?” you know that it meant a day’s wages."
<br>
"Later, skilled craftsman pushed that wage to almost an ounce a day. Henry Ford pushed that wage to an unbelievable $5 a day or 3.6 ounces a day which was seen as excessive at the time. Today an average worker makes, let’s say, $100 a day. If there was some economic reality in the system, like real money, a 1/10th of an ounce would equal a day’s wages of $100. Therefore an ounce of silver should be about $1,000 an ounce, a far cry from today’s price of $30."
<br>
"Some other historical reference points include Jesus being sold out by Judas Iscariot for 30 shekels, or ~12 ounces of silver. Can you imagine selling out your friend, much less Jesus Christ, for $350 bucks? What if we had $1,000 ounce silver? For $12,000, there are a lot of people who would do the deed. (Isn’t that close to the price hit men charge, in movies?)"
<br>
"It is also interesting to note that was the same value for a slave at the time."
<br>
"In the Bible, plots of land were bought, anywhere from 50 ounces to 200 ounces of silver. Good luck finding average properties for $1,250 to $5,000 a piece. But again, what if silver was $1,000 an ounce? Finding properties from $50,000 to $200,000 is a snap. So the purpose of this exercise is to see the ratio between a known silver amount and a known asset. When you take away the manipulated measuring stick of the dollar, the only way to compare an assets value is to compare assets to other assets. So, right now, it may cost you 2,000 to 8,000 ounces of silver to buy a plot of land. If we have a reversion to the mean, and our debt/money system collapses, you should be able to pick up land for 50 to 200 ounces. I really think that even this is too high...."
<br>
"Shekel; weighs about 12 grams; about 0.4 troy ounce. As of Jan, 2012, with silver at $30/oz, that would be about $6 per shekel"
<br>
"30 shekels, the amount Judas was paid to betray Jesus, would have been about 11 troy ounces of silver..."
<br>
 
 
 
 
 
 
<?php
//echo(var_dump(get_defined_vars()));
/*
//START EXAMPLE
// Include the library
include('simple_html_dom.php');
 
// Retrieve the DOM from a given URL
$html = file_get_html('http://davidwalsh.name/');

// Find all "A" tags and print their HREFs
foreach($html->find('a') as $e) 
    echo $e->href . '<br>';

// Retrieve all images and print their SRCs
foreach($html->find('img') as $e)
    echo $e->src . '<br>';

// Find all images, print their text with the "<>" included
foreach($html->find('img') as $e)
    echo $e->outertext . '<br>';

// Find the DIV tag with an id of "myId"
foreach($html->find('div#myId') as $e)
    echo $e->innertext . '<br>';

// Find all SPAN tags that have a class of "myClass"
foreach($html->find('span.myClass') as $e)
    echo $e->outertext . '<br>';

// Find all TD tags with "align=center"
foreach($html->find('td[align=center]') as $e)
    echo $e->innertext . '<br>';
    
// Extract all text from a given cell
echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

//END EXAMPLE
*/

?>
