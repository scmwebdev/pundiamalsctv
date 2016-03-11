<?php
class YahooNewsFeed
{

    var $text = '';
    var $tag_allowed = '<strong><em><br><br/><br />';

    function __construct($text1)
    {

        $text1 = html_entity_decode ($text1);
        $text1 = str_replace('&lt;', '<', $text1);
        $text1 = str_replace('&gt;', '>', $text1);
        $text1 = strip_tags ($text1, $this->tag_allowed);

        $text1 = str_replace ("\r\n", '<br />', $text1);	// replace new carriage return with the <br/> element

        // avoid showing unrecognized character
        $text1 = str_replace ("<br>", "<br />", $text1);
        $text1 = str_replace ("<br/>", "<br />", $text1);
        $text1 = str_replace ("&lsquo;", "'", $text1);
        $text1 = str_replace ("&rsquo;", "'", $text1);
        $text1 = str_replace ("&ldquo;", "'", $text1);
        $text1 = str_replace ("&rdquo;", "'", $text1);
        $text1 = str_replace ("&rdquo;", "'", $text1);
        $text1 = str_replace ("'", "", $text1);
        $text1 = str_replace ("?", "", $text1);

        $text1 = str_replace ("&bull;", "•", $text1);
        $text1 = str_replace ("é", "e", $text1);
        $text1 = str_replace (" & ", " &amp; ", $text1);

        $text1 = str_replace ("<strong></strong>", '', $text1);	// empty value for <strong> tag is not allowed
        $text1 = str_replace ("<em></em>", '', $text1);	// empty value for <em> tag is not allowed

        // unique condition
        $text1 = $this->validTag($text1, '<strong>');
        $text1 = $this->validTag($text1, '<em>');
        $text1 = $this->formatBreak($text1);

        $this->text = $text1;

    }

    function formatBreak($text1)
    {

        $text1 = str_replace ('<br /><br /><br /><br />', '<br />', $text1) ;
        $text1 = str_replace ('<br /><br /><br />', '<br />', $text1) ;
        $text1 = str_replace ('<br /><br />', '<br />', $text1) ;
        $text1 = str_replace ('<br />', '</p><p>', $text1) ;

        if (substr($text1,0,6)=="<br />") $text1 = substr($text1,6);
        if (substr($text1,-6)=="<br />") $text1 = substr($text1,0,-6);

        return "<p>".$text1."</p>";

    }

    function validTag($text0, $tag)
    {

        $text1 = $text0;
        $text2 = '';
        $text3 = '';
        $tag1 = $tag;
        $tag2 = substr ($tag, 0, 1).'/'.substr ($tag, 1);

        for ( $i = 0; $i < strlen ($text1); $i++ )
        {
            if ( substr ($text1, 0, strlen ($tag1)) == $tag1 )
            {
                $pos1 = strpos ($text1, $tag1);
                $pos2 = strpos ($text1, $tag2);
                $text2 = substr ($text1, 0, ($pos2 + strlen ($tag2)));
                $text3 .= strip_tags ($text2, $tag1);
                $text1 = substr ($text1, ($pos2 + strlen ($tag2)), strlen ($text1));
            }
            else
            {
                $pos1 = strpos ($text1, $tag1);
                if ( $pos1 != 0 )
                {
                    $text2 = substr ($text1, 0, $pos1);
                    $text3 .= $text2;
                    $text1 = substr ($text1, $pos1, strlen ($text1));
                }
                else
                {
                    $text2 = substr ($text1, 0, strlen ($text1));
                    $text3 .= $text2;
                    $text1 = '';
                }
            }
            if ( $text1 == '' ) break ;
        }

        $text = $text3;

        return $text;

    }

    function validTitle($text1)
    {

        $text1 = html_entity_decode ($text1);
        $text1 = strip_tags ($text1, '<strong><em>');

        return $text1;

    }

}
?>
