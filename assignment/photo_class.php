<?php 

class photo {
    private $rating = 0, $id = 0;
    private $owner = null, $date = 0, $cover = null, $comment = null;
    
    public function __construct($id, $owner, $cover, $rating, $comment, $date) {
        $this->id = $id;
        $this->date = $date;
        $this->owner = $owner;
        $this->rating = $rating;
        $this->cover = $cover;
        $this->comment = $comment;
    }
    
    public function getComment() {
        return $this->comment;
    }
    
    public function getRating() {
        return $this->rating;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getOwner() {
        return $this->owner;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function getCover() {
        return $this->cover;
    }
    
}

?>