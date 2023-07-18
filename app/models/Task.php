<?php 
Class Task {

    public string $author;
    public string $name;
    public string $description;
    public string $status;
    public string $startDate;
    public ?string $endDate;

public function __construct(string $author, string $name, ?string $description = null, string $status = "Pending", ?string $startDate = null, ?string $endDate = null)
{
    $this->author = $author;
    $this->name = $name;
    $this->description = $description;
    $this->status = $status;
    $this->startDate = $startDate ?: date('Y-m-d'); //Set the current date if not provided
        
        if ($status === "Finished") {
            $this->endDate = date('Y-m-d');
        } else {
            $this->endDate = $endDate;
        }
}    
    // Get the value of $author

     public function getAuthor() : string
     {
        return $this->author;
     }
     
     // Set the value of $author
     
     public function setAuthor(string $author): self
     {
         $this->$author = $author;
         
         return $this;
     }

    //Get the value of name
    
    public function getName(): string
    {
        return $this->name;
    }

    //Set the value of name
     
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

     //Get the value of description
     
    public function getDescription(): string
    {
        return $this->description;
    }

    // Set the value of description
    
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    //Get the value of status

    public function getStatus(): string
    {
        return $this->status;
    }

    // Set the value of status

    // TODO: Hacer algo como un ENUM para los estados, o quizá ya puede venir directo de un select de formulario
    
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    // Get the value of startDate
    
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    // Set the value of startDate

    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    // Get the value of endDate

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    // Set the value of endDate
    
    public function setEndDate(string $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}
?>