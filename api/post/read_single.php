<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect to db
$database = new Database();
$db = $database->connect();

// Insantiate blog post object
$product = new Post($db);

// Get the product name
$param = $_GET['name'];

// Blog post query
$result = $product->get_single_post($param);
// Get row count
$num = $result->rowCount();

// Check if any post returned
if ($num > 0) {
  $posts_arr = array();
  // $posts_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Push to data array
    array_push($posts_arr, $row);
  }
  // Turn to json
  echo json_encode($posts_arr);
} else {
  // no posts
  echo json_encode(array('msg' => 'no post found'));
}
