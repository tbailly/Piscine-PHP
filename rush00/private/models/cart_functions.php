<?php

function cart_creation(){
   if (!isset($_SESSION['cart']))
      $_SESSION['cart'] = array();
   if (!isset($_SESSION['cart']['ids']))
      $_SESSION['cart']['ids'] = array();
   if (!isset($_SESSION['cart']['quantities']))
      $_SESSION['cart']['quantities'] = array();
   return true;
}

function add_product($id, $quantity){
   if (cart_creation())
   {
      $pos = array_search($id, $_SESSION['cart']['ids']);

      if ($pos !== false)
      {
         $_SESSION['cart']['quantities'][$pos] += $quantity;
      }
      else
      {
         array_push($_SESSION['cart']['ids'], $id);
         array_push($_SESSION['cart']['quantities'], $quantity);
      }
   }
   else
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function update_product_quantity($ids, $quantities){
   var_dump("UP");
   cart_creation();
   if ($quantities > 0)
   {
      var_dump("down");
      $pos = array_search($ids,  $_SESSION['cart']['ids']);

      if ($pos !== false)
      {
         $_SESSION['cart']['quantities'][$pos] = $quantities ;
      }
      var_dump("here");
   }
   else
      delete_product($ids);
}

function delete_product($ids){
   if (cart_creation())
   {
      $tmp = array();
      $tmp['ids'] = array();
      $tmp['quantities'] = array();

      for($i = 0; $i < count($_SESSION['cart']['ids']); $i++)
      {
         if ($_SESSION['cart']['ids'][$i] !== $ids)
         {
            array_push( $tmp['ids'],$_SESSION['cart']['ids'][$i]);
            array_push( $tmp['quantities'],$_SESSION['cart']['quantities'][$i]);
         }

      }
      $_SESSION['cart'] =  $tmp;
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function total_price($all_products){
   if (isset($_SESSION['cart']) && isset($_SESSION['cart']['quantities']) && isset($_SESSION['cart']['ids']))
   {
      $total = 0;
      foreach ($_SESSION['cart']['ids'] as $key => $id) {
         if (isset($all_products[$id]))
            $total += $all_products[$id]["price"] * $_SESSION['cart']['quantities'][$key];
      };
      return ($total);
   }
   else
      return 0;
}

function supprimePanier(){
   unset($_SESSION['cart']);
}

function product_count()
{
   if (isset($_SESSION['cart']) && isset($_SESSION['cart']['quantities']))
   {
      $total_quantity = 0;
      foreach ($_SESSION['cart']['quantities'] as $key => $quantity_to_add) {
         $total_quantity += $quantity_to_add;
      };
      return ($total_quantity);
   }
   else
      return 0;
}

?>
