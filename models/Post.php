<?php

class Post
{
  // DB Stuff
  private $conn;
  private $table = 'posts';

  // Post properties
  // public $id;
  // public $category_id;
  // public $category_name;
  // public $title;
  // public $body;
  // public $author;
  // public $created_at;
  public $name;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get all products
  public function read()
  {
    // Ctreate Query
    $query = 'SELECT *
              FROM products';

    // prepare Statment
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get products by name
  public function get_single_post($param)
  {
    // $param = "חלב";
    // Ctreate Query
    $stmt = $this->conn->prepare("SELECT * FROM products WHERE name LIKE :searchTerm");
    $stmt->bindValue(":searchTerm", "%$param%", PDO::PARAM_STR);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Create Post
  public function create_post()
  {
    $query = 'INSERT INTO posts (title, body, author, category_id) 
              VALUES (:title, :body, :author, :category_id)';

    // prepare Statment
    $stmt = $this->conn->prepare($query);

    // Clean data
    // $this->title = htmlspecialchars(strip_tags($this->title));
    // $this->body = htmlspecialchars(strip_tags($this->body));
    // $this->author = htmlspecialchars(strip_tags($this->author));
    // $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    // Bind data
    // $stmt->bindParam(':title', $this->title);
    // $stmt->bindParam(':body', $this->body);
    // $stmt->bindParam(':author', $this->author);
    // $stmt->bindParam(':category_id', $this->category_id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }
    // Print error
    printf("Error: %s.\n", $stmt->error);
    return false;
  }
}
