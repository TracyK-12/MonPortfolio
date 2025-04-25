<?php 

$accessList = [
    'home'=>[],
    'login'=>[],
    'logout'=>[],
    'get_all_prods'=>[],
    'add_prod'=>['user', 'admin'],
    'add_cat'=>['admin'],
    'add_user'=>['admin'],
    'update_user'=>['admin'],
    'update_prod'=>['user', 'admin'],
    'get_all_cats'=>['user', 'admin'],
    'get_all_users'=>['admin'],
    'show_cart'=>[],
    'add_to_cart'=>[],
    'reduce_article'=>[],
    'remove_from_cart'=>[],
    'clear_cart'=>[],
    'view_prod'=>[],
    // 'increase_article'=>[],
    'categorie_form'=>['user', 'admin'],
]
?>