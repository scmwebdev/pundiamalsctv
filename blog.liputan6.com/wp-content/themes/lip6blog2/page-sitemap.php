<?php
$charset = 'UTF-8';
header('Content-type: text/xml', true);
echo "<?xml version=\"1.0\" encoding=\"$charset\"?> \n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" > \n";
// Home
echo " <url>\n";
echo " <loc>".home_url()."</loc>\n";
echo " <priority>1</priority> \n";
echo " </url>\n\n";
// End Home
// Start Pages
$pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND comment_status ='open' ORDER BY post_date DESC LIMIT 0,250");
foreach ($pages as $page) {
echo " <url>\n";
echo " <loc>".get_permalink($page-> ID)."</loc>\n";
echo " <lastmod>";
echo get_the_time('c', $page-> ID);
echo "</lastmod>\n";
// echo ' <changefreq> daily</changefreq> \n';
echo " <priority>0.8</priority> ";
echo "\n";
echo " </url>\n\n";
}
///* End Pages */
/* Start Archive */
$settingarchive = array(
'format' => 'custom',
'before' => '
<url>
',
'after' => '
</url>',
'echo' => 0 );
$archive = wp_get_archives($settingarchive);
/* replace */
$from = array (
" 2000", " 2001", " 2002", " 2003", " 2004", " 2005", " 2006", " 2007", " 2008", " 2009", " 2010", " 2011", " 2012", " 2013", " 2014", " 2015", " 2016", " 2017", " 2018", " 2019", " 2020", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "'>", "' title='", "<a href='", "</a>");
$to = array (
"", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", " <loc>", "</loc>
<priority>0.4</priority> ");
echo str_replace($from, $to, $archive);
echo "</urlset> <!-- End urlset --> \n<!-- This sitemap for wordpress by : \n http://www.indaam.com \n--> ";
// End Sitemap
?>
