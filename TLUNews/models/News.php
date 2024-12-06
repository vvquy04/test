<?php

class News {
    private $conn;
    private $table_name = 'news';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllNews() {
        $query = "SELECT n.*, c.name as category_name 
                  FROM " . $this->table_name . " n 
                  JOIN categories c ON n.category_id = c.id 
                  ORDER BY n.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        $query = "SELECT n.*, c.name as category_name 
                  FROM " . $this->table_name . " n 
                  JOIN categories c ON n.category_id = c.id 
                  WHERE n.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addNews($title, $content, $image, $category_id) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, content, image, category_id, created_at) 
                  VALUES (:title, :content, :image, :category_id, NOW())";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        
        try {
            return $stmt->execute();
        } catch(PDOException $e) {
            // Ghi log lỗi nếu cần
            return false;
        }
    }

    public function updateNews($id, $title, $content, $image, $category_id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, 
                      content = :content, 
                      image = :image, 
                      category_id = :category_id 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        
        try {
            return $stmt->execute();
        } catch(PDOException $e) {
            // Ghi log lỗi nếu cần
            return false;
        }
    }

    public function deleteNews($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        try {
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }
    
    public function searchNews($keyword) {
        $query = "SELECT n.*, c.name as category_name 
                  FROM " . $this->table_name . " n 
                  JOIN categories c ON n.category_id = c.id 
                  WHERE n.title LIKE :keyword
                  ORDER BY n.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>