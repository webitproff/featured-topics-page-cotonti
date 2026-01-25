<?php
/* ====================
[BEGIN_COT_EXT]
Code=featuredtopicspage
Name=Featured Topics from Forums in Item article of Article PRO 
Category=
Description=Allows attaching featured forum topics to a page article and displaying them on the article page.
Version=2.7.8
Date=Jan 25Th, 2026
Author=webitproff
Copyright=(c) webitproff 2026 | https://github.com/webitproff
Notes=
Auth_guests=R
Lock_guests=WA
Auth_members=RW
Lock_members=A
Requires_modules=page,forums
Requires_plugins=
Recommends_modules=
Recommends_plugins=attacher
[END_COT_EXT]
[BEGIN_COT_EXT_CONFIG]
maxitems_page_rft=01:select:1,2,3,5,8:3:Количество рекомендуемых тем
max_select_itemslist_page_rft=02:select:10,50,75,100,150,200,300:100:Тем в выпадающем списке
desc_length_page_rft=03:select:0,50,75,100,150,200,300:100:Длина текста описания
nonimage_page_rft=04:string::plugins/featuredtopicspage/img/image.webp:Картинка-заглушка
[END_COT_EXT_CONFIG]
==================== */
/**
 * featuredtopicspage.setup.php - Register data in $db_core and $db_config. Setup & Config File for the Plugin Featured and Recommended and Featured Topics from Forums in Item article of Article PRO 
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredtopicspage.setup.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL.');