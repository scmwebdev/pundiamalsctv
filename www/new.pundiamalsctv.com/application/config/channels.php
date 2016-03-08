<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['channels'] = array(
    'news' => array(
                'id' => 1,
                'cat'=> array(
                    'politik' => array('id'=>1, 'limit_m'=>3, 'limit'=>3, 'title'=>'Politik'),
                    'internasional' => array('id'=>9, 'limit_m'=>3, 'limit'=>3, 'title'=>'Internasional'),
                    'peristiwa' => array('id'=>163, 'limit_m'=>3, 'limit'=>3, 'title'=>'Peristiwa'),
                    'citizen6' => array('id'=>171, 'limit_m'=>3, 'limit'=>3, 'title'=>'Citizen6'),
                ),
            ),

    'bisnis' => array (
                'id' => 14,
                'cat'=> array(
                    'ekonomi' => array('id'=>173, 'limit_m'=>3, 'limit'=>3, 'title'=>'Ekonomi'),
                    'bank' => array('id'=>174, 'limit_m'=>3, 'limit'=>3, 'title'=>'Bank'),
                    'saham' => array('id'=>175, 'limit_m'=>3, 'limit'=>3, 'title'=>'Saham'),
                    'energi-tambang' => array('id'=>176, 'limit_m'=>3, 'limit'=>3, 'title'=>'Energi & Tambang'),
                ),
            ),

    'bola' => array (
                'id' => 7,
                'cat'=> array(
                    'corner' => array('id'=>55, 'limit_m'=>3, 'limit'=>3, 'title'=>'Corner'),
                    'bintang' => array('id'=>56, 'limit_m'=>3, 'limit'=>3, 'title'=>'Bintang'),
                    'wawancara' => array('id'=>57, 'limit_m'=>3, 'limit'=>3, 'title'=>'Wawancara'),
                    'prediksi' => array('id'=>58, 'limit_m'=>3, 'limit'=>3, 'title'=>'Prediksi'),

                    'liga-inggris' => array('id'=>60, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Inggris'),
                    'liga-italia' => array('id'=>61, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Italia'),
                    'liga-spanyol' => array('id'=>62, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Spanyol'),
                    'liga-jerman' => array('id'=>63, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Jerman'),
                    'liga-belanda' => array('id'=>64, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Belanda'),
                    'liga-perancis' => array('id'=>65, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Perancis'),
                    'liga-eropa' => array('id'=>66, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Eropa'),
                    'piala-dunia' => array('id'=>67, 'limit_m'=>0, 'limit'=>0, 'title'=>'Piala Dunia'),
                    'liga-nasional' => array('id'=>69, 'limit_m'=>0, 'limit'=>0, 'title'=>'Liga Nasional'),

                ),
            ),

    'showbiz' => array (
                'id' => 5,
                'cat'=> array(
                    'movie'  => array('id'=>48, 'limit_m'=>3, 'limit'=>3, 'title'=>'Movie'),
                    'celeb'  => array('id'=>49, 'limit_m'=>3, 'limit'=>3, 'title'=>'Celeb'),
                    'musik' => array('id'=>158, 'limit_m'=>3, 'limit'=>3, 'title'=>'Musik'),
                    'k-pop' => array('id'=>172, 'limit_m'=>3, 'limit'=>3, 'title'=>'K-Pop'),
                ),
            ),

    'health' => array (
                'id' => 9,
                'cat'=> array(
                    'info' => array('id'=>72, 'limit_m'=>3, 'limit'=>3, 'title'=>'Info'),
                    'seks' => array('id'=>137, 'limit_m'=>3, 'limit'=>3, 'title'=>'Seks'),
                    'diet' => array('id'=>140, 'limit_m'=>3, 'limit'=>3, 'title'=>'Diet'),
                    'fit' => array('id'=>143, 'limit_m'=>3, 'limit'=>3, 'title'=>'Fit'),
                ),
            ),

    'tekno' => array (
                'id' => 10,
                'cat'=> array(
                    'gadget' => array('id'=>146, 'limit_m'=>3, 'limit'=>3, 'title'=>'Gadget'),
                    'internet' => array('id'=>149, 'limit_m'=>3, 'limit'=>3, 'title'=>'Internet'),
                    'game' => array('id'=>152, 'limit_m'=>3, 'limit'=>3, 'title'=>'Game'),
                    'telko' => array('id'=>155, 'limit_m'=>3, 'limit'=>3, 'title'=>'Telko'),
                ),
            ),

    'video' => array (
                'id' => 0,
                'cat'=> array(
                    'news' => array('id'=>1, 'limit_m'=>3, 'limit'=>3, 'title'=>'News'),
                    'bisnis' => array('id'=>4, 'limit_m'=>3, 'limit'=>3, 'title'=>'Bisnis'),
                    'bola' => array('id'=>13, 'limit_m'=>3, 'limit'=>3, 'title'=>'Bola'),
                    'showbiz' => array('id'=>array(8,10), 'limit_m'=>3, 'limit'=>3, 'title'=>'Showbiz'),
                    'tekno' => array('id'=>12, 'limit_m'=>3, 'limit'=>3, 'title'=>'Tekno'),
                    'health' => array('id'=>11, 'limit_m'=>3, 'limit'=>3, 'title'=>'Health'),
                ),
            ),
    'foto' => array (
                'id' => array(3,5),
                'cat'=> array(
                    'showbiz' => array('id'=>3, 'limit_m'=>3, 'limit'=>3, 'title'=>'Foto Showbiz'),
                    'bola' => array('id'=>5, 'limit_m'=>3, 'limit'=>3, 'title'=>'Foto Bola'),
                ),
            ),
);
