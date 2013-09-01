<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$autoload['model'] = array(
    '_news/news',
    '_audiciones/audicion',
    '_audiciones/audiciones_aplicacion',
    '_clasificados/clasificado',
    '_clasificados/clasificados_categoria',
    '_bands/band',
    '_bands/bands_instruments_user',
    '_bands/bands_instrument',
    '_bands/musical_gender',
    '_directorio/directorio',
    '_users/users_directorio',
    '_users/intelligence',
    '_users/users_photo',
    '_users/users_follow',
    '_users/intelligences_comment',
    '_bands/page',
    '_bands/pages_photo',
    '_users/statu',
    '_users/users_show',
    '_users/users_song',
    '_users/users_video'
);


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */
