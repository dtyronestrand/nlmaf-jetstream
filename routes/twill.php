<?php

use A17\Twill\Facades\TwillRoutes;

// Register Twill routes here eg.
// TwillRoutes::module('posts');

TwillRoutes::singleton('pageHome');
TwillRoutes::module('menuLinks');
TwillRoutes::module('pages');
TwillRoutes::module('programs');
TwillRoutes::module('news');